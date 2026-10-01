<?php
// Spreadsheet (CSV) export of the attendance report shown by attn_display.php.
require_once __DIR__ . '/../includes/attendance_report.php';
$role = 'teacher';
$ur = require_login($role);

$f_date = isset($_GET['f_date']) ? (string) $_GET['f_date'] : '';
$t_date = isset($_GET['t_date']) ? (string) $_GET['t_date'] : '';
$year = isset($_GET['year']) ? (string) $_GET['year'] : '';

if (!is_valid_date($f_date) || !is_valid_date($t_date) || !in_array($year, array('1', '2', '3'), true)) {
	header('Location: attn_report.php');
	exit;
}

$report = attendance_report($ur, $year, $f_date, $t_date);

// A cell starting with = + - @ would be run as a formula by spreadsheet programs.
function csv_text($value)
{
	$value = (string) $value;
	return preg_match('/^[=+\-@\t\r]/', $value) ? "'" . $value : $value;
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=report_' . $f_date . '_to_' . $t_date . '.csv');

$out = fopen('php://output', 'w');
fwrite($out, "\xEF\xBB\xBF");

$heading = array('Roll', 'Enroll', 'Name');
foreach ($report['theory'] as $roow) {
	$heading[] = csv_text($roow['name']);
}
$heading[] = 'Theory';
foreach ($report['practical'] as $roow) {
	$heading[] = csv_text($roow['name']);
}
$heading[] = 'Practical';
$heading[] = 'Total';
fputcsv($out, $heading, ',', '"', '');

foreach ($report['rows'] as $row) {
	$line = array(csv_text($row['student']['roll']), csv_text($row['student']['enroll']), csv_text($row['student']['name']));
	// "present | held" rather than "present / held", which spreadsheets would read as a date.
	foreach ($row['theory'] as $count) {
		$line[] = $count['present'] . ' | ' . $count['total'];
	}
	$line[] = format_percent($row['theory_percent']);
	foreach ($row['practical'] as $count) {
		$line[] = $count['present'] . ' | ' . $count['total'];
	}
	$line[] = format_percent($row['practical_percent']);
	$line[] = format_percent($row['total_percent']);
	fputcsv($out, $line, ',', '"', '');
}
fclose($out);
