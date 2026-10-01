<?php
require_once __DIR__ . '/../includes/auth.php';
$role = 'teacher';
$ur = require_login($role);

$subjects = db_all(
	'SELECT * FROM subject WHERE department_id = ? AND teacher_id = ? ORDER BY year, id',
	array($ur['department_id'], $ur['id'])
);

$page_title = 'Attendence Details';
$active = 'index.php';
include(__DIR__ . '/../includes/layout/portal_top.php');
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Details</strong> For Attendence
                                    </div>
<?php if (count($subjects) === 0) { ?>
                                    <div class="card-body">
                                        <div class="empty-state">
                                            <i class="fa fa-book"></i>
                                            No subject is assigned to you yet. Please ask your HOD to assign you a subject.
                                        </div>
                                    </div>
<?php } else { ?>
                                    <form action="mark_attendence.php" method="post" class="form-horizontal">
                                        <div class="card-body card-block" id="class_details">
                                            <div class="row form-group">
                                                <div class="col-12 col-md-6">
                                                    <label for="subject" class="form-control-label">Subject</label>
                                                    <select class="form-control" id="subject" name="subject" required>
                                                        <option value="">Select Subject</option>
<?php foreach ($subjects as $row1) { ?>
                                                        <option value="<?php echo e($row1['id']); ?>"><?php echo e($row1['name'] . ' - ' . year_label($row1['year']) . ($row1['type'] == 1 ? ' (Practical)' : ' (Theory)')); ?></option>
<?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="date" class="form-control-label">Date</label>
                                                    <input type="date" id="date" name="date" class="form-control" required>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="time" class="form-control-label">Time</label>
                                                    <input type="time" id="time" name="time" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="start_button" class="card-footer">
                                            <button type="submit" name="Submit" class="btn btn-info">Start Attendence</button>
                                        </div>
                                    </form>
<?php } ?>
                                </div>
                            </div>
                        </div>
<?php include(__DIR__ . '/../includes/layout/portal_bottom.php'); ?>
    <script>
        $('#date').val(App.today());
        $('#time').val(App.now());
    </script>

</body>

</html>
<!-- end document-->
