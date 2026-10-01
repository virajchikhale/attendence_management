<?php
require_once __DIR__ . '/../includes/auth.php';
$role = 'teacher';
$ur = require_login($role);

$date = post('date');
$time = post('time');
$subject = db_row('SELECT * FROM subject WHERE id = ? AND teacher_id = ?', array(post_id('subject'), $ur['id']));

// Opened directly, or with details that do not belong to this teacher: start over.
if ($subject === null || !is_valid_date($date) || !preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $time)) {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		flash_set('Please select a subject, date and time.', 'error');
	}
	header('Location: index.php');
	exit;
}

$students = array();
foreach (students_for($subject['department_id'], $subject['year']) as $row) {
	$students[] = array('roll' => $row['roll'], 'enroll' => $row['enroll'], 'name' => $row['name']);
}

$page_title = 'Mark Attendence';
$active = 'index.php';
include(__DIR__ . '/../includes/layout/portal_top.php');
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header card-header--split">
                                        <span><strong>Marking</strong> Attendence</span>
                                        <span class="attn-progress">
                                            <?php echo e($subject['name']); ?> &middot; <?php echo e(year_label($subject['year'])); ?> &middot; <?php echo e($date); ?> &middot; <?php echo e($time); ?>
                                        </span>
                                    </div>
<?php if (count($students) === 0) { ?>
                                    <div class="card-body">
                                        <div class="empty-state">
                                            <i class="fa fa-users"></i>
                                            There are no students in the <?php echo e(year_label($subject['year'])); ?> class yet.
                                        </div>
                                    </div>
<?php } else { ?>
                                    <div id="start_button" class="card-footer">
                                        <button id="start" type="button" class="btn btn-info">Start Attendence</button>
                                        <span class="attn-hint ml-2"><?php echo count($students); ?> students in this class</span>
                                    </div>
<?php } ?>
                                </div>

                                <div id="student_card" class="card attn-card" hidden>
                                    <div class="card-header card-header--split">
                                        <div class="card-title mb-0">Roll NO. : <b id="student_roll"></b></div>
                                        <span class="attn-progress" id="student_progress"></span>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block text-center">
                                            <h3 class="attn-name" id="student_name"></h3>
                                            <div class="location">
                                                <i class="fa fa-id-card-o mr-1"></i><span id="student_enroll"></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="attn-actions text-center">
                                            <button id="present" type="button" class="btn btn-success">Present</button>
                                            <button id="absent" type="button" class="btn btn-danger">Absent</button>
                                        </div>
                                        <hr>
                                        <div class="attn-hint text-center">
                                            <kbd>Space</kbd> marks the student <b>Present</b> &nbsp;&middot;&nbsp; <kbd>Enter</kbd> marks the student <b>Absent</b>
                                        </div>
                                    </div>
                                </div>

                                <div id="success_msg" class="alert alert-success" role="alert" hidden>
                                    <h4 class="alert-heading">Well done!</h4>
                                    <hr>
                                    <p>Your attendence were marked successfully</p>
                                </div>
                            </div>
                        </div>
<?php include(__DIR__ . '/../includes/layout/portal_bottom.php'); ?>
    <script>
        var students = <?php echo js_value($students); ?>;
        var lecture = <?php echo js_value(array('subject' => $subject['id'], 'date' => $date, 'time' => $time)); ?>;
        var sheetId = null;   // attendance sheet opened by start()
        var i = 0;            // index of the student on screen
        var busy = false;     // a mark is being saved

        function showStudent() {
            $('#student_roll').text(students[i].roll);
            $('#student_name').text(students[i].name);
            $('#student_enroll').text(students[i].enroll);
            $('#student_progress').text('Student ' + (i + 1) + ' of ' + students.length);
        }

        function start() {
            var button = $('#start').prop('disabled', true);
            App.post('../sqloperations/mark_attendence.php', {
                date: lecture.date,
                time: lecture.time,
                subject: lecture.subject,
                type: 'fill'
            }).then(function (response) {
                if (!response.ok) {
                    button.prop('disabled', false);
                    App.notify(response.message, 'error');
                    return;
                }
                sheetId = response.id;
                $('#start_button').prop('hidden', true);
                showStudent();
                $('#student_card').prop('hidden', false);
            });
        }

        // Saves the mark for the student on screen, then moves to the next one.
        function mark(value) {
            if (sheetId === null || busy || i >= students.length) {
                return;
            }
            busy = true;
            $('#present, #absent').prop('disabled', true);
            App.post('../sqloperations/mark_attendence.php', {
                id: sheetId,
                roll: students[i].enroll,
                value: value,
                type: 'attn'
            }).then(function (response) {
                busy = false;
                $('#present, #absent').prop('disabled', false);
                if (!response.ok) {
                    App.notify(response.message, 'error');
                    return;
                }
                i = i + 1;
                if (i < students.length) {
                    showStudent();
                } else {
                    $('#student_card').prop('hidden', true);
                    $('#success_msg').prop('hidden', false);
                    setTimeout(function () { window.location = "attn_report.php"; }, 2000);
                }
            });
        }

        $('#start').on('click', start);
        $('#present').on('click', function () { this.blur(); mark('1'); });
        $('#absent').on('click', function () { this.blur(); mark('0'); });

        // Space = present, Enter = absent. The default action is cancelled so a focused
        // button is not also "clicked" by the same key press.
        $(document).on('keydown keyup', function (event) {
            if (sheetId === null || i >= students.length || $('#logoutModal').hasClass('show')) {
                return;
            }
            if (event.code !== 'Space' && event.code !== 'Enter' && event.code !== 'NumpadEnter') {
                return;
            }
            event.preventDefault();
            if (event.type === 'keyup') {
                mark(event.code === 'Space' ? '1' : '0');
            }
        });
    </script>

</body>

</html>
<!-- end document-->
