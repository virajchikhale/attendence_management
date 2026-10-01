<?php
// Attendance summary shared by the on-screen report and the spreadsheet export.

require_once __DIR__ . '/auth.php';

// Percentage of lectures attended, or null when no lecture was held.
function attendance_percent($present, $total)
{
	return $total > 0 ? ($present / $total) * 100 : null;
}

function format_percent($percent)
{
	return $percent === null ? '-' : number_format((float) $percent, 2, '.', '') . '%';
}

// Builds the report for one year of the teacher's department between two dates.
// A class teacher sees every subject of that year; other teachers only their own.
function attendance_report(array $ur, $year, $f_date, $t_date)
{
	$report = array('theory' => array(), 'practical' => array(), 'rows' => array());

	$sql = 'SELECT * FROM subject WHERE department_id = ? AND year = ?';
	$params = array($ur['department_id'], $year);
	if ($ur['status'] != 1) {
		$sql .= ' AND teacher_id = ?';
		$params[] = $ur['id'];
	}
	foreach (db_all($sql . ' ORDER BY id', $params) as $subject) {
		$report[$subject['type'] == 1 ? 'practical' : 'theory'][] = $subject;
	}

	// One query per subject; each row is a lecture with a column per student.
	$lectures = array();
	foreach (array_merge($report['theory'], $report['practical']) as $subject) {
		$lectures[$subject['id']] = db_all(
			'SELECT * FROM attendence WHERE subject = ? AND date BETWEEN ? AND ?',
			array($subject['id'], $f_date, $t_date)
		);
	}

	foreach (students_for($ur['department_id'], $year) as $student) {
		$rol = attendance_column($student['enroll']);
		$row = array('student' => $student);

		foreach (array('theory', 'practical') as $kind) {
			$sum = 0;
			$total_lecture = 0;
			$row[$kind] = array();
			foreach ($report[$kind] as $subject) {
				$no_of_present = 0;
				$no_of_absent = 0;
				foreach ($lectures[$subject['id']] as $lecture) {
					if (!isset($lecture[$rol])) {
						continue;
					}
					if ($lecture[$rol] == 1) {
						$no_of_present++;
					} else if ($lecture[$rol] == 0) {
						$no_of_absent++;
					}
				}
				$row[$kind][] = array('present' => $no_of_present, 'total' => $no_of_present + $no_of_absent);
				$sum += $no_of_present;
				$total_lecture += $no_of_present + $no_of_absent;
			}
			$row[$kind . '_percent'] = attendance_percent($sum, $total_lecture);
		}

		// Overall figure is the average of the theory and practical percentages that exist.
		$parts = array_filter(
			array($row['theory_percent'], $row['practical_percent']),
			function ($percent) { return $percent !== null; }
		);
		$row['total_percent'] = count($parts) > 0 ? array_sum($parts) / count($parts) : null;

		$report['rows'][] = $row;
	}

	return $report;
}
