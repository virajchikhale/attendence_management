<?php
require_once __DIR__ . '/../includes/auth.php';
$role = 'hod';
$ur = require_login($role);

$classes = db_all(
	'SELECT c.id, c.year, c.divi, c.teacher_id, t.first_name, t.last_name
	 FROM class c LEFT JOIN teacher_reg t ON t.id = c.teacher_id
	 WHERE c.department_id = ? ORDER BY c.year, c.id',
	array($ur['department_id'])
);
// Older data can hold several divisions of one year; name the division only then.
$per_year = array_count_values(array_column($classes, 'year'));
foreach ($classes as $key => $row) {
	$classes[$key]['label'] = year_label($row['year']) . ($per_year[$row['year']] > 1 ? ' - ' . $row['divi'] : '');
}
// Teachers of this department who are not a class teacher yet.
$free_teachers = db_all(
	'SELECT id, first_name, last_name FROM teacher_reg WHERE status = 0 AND department_id = ? ORDER BY first_name',
	array($ur['department_id'])
);
$department = db_value('SELECT name FROM department WHERE id = ?', array($ur['department_id']));
$subject = db_value('SELECT COUNT(*) FROM subject WHERE department_id = ?', array($ur['department_id']));
$teacher = db_value('SELECT COUNT(*) FROM teacher_reg WHERE department_id = ?', array($ur['department_id']));

$page_title = 'Add Class';
$active = 'index.php';
include(__DIR__ . '/../includes/layout/portal_top.php');
?>
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="stat-card">
                                    <div class="stat-card__icon"><i class="fa fa-building"></i></div>
                                    <div>
                                        <div class="stat-card__value" style="font-size:18px"><?php echo e($department); ?></div>
                                        <div class="stat-card__label">Department</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="stat-card">
                                    <div class="stat-card__icon"><i class="fa fa-users"></i></div>
                                    <div>
                                        <div class="stat-card__value"><?php echo count($classes); ?></div>
                                        <div class="stat-card__label">Classes</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="stat-card">
                                    <div class="stat-card__icon"><i class="fa fa-book"></i></div>
                                    <div>
                                        <div class="stat-card__value"><?php echo (int) $subject; ?></div>
                                        <div class="stat-card__label">Subjects</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="stat-card">
                                    <div class="stat-card__icon"><i class="fa fa-user"></i></div>
                                    <div>
                                        <div class="stat-card__value"><?php echo (int) $teacher; ?></div>
                                        <div class="stat-card__label">Teachers</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Add Class in the system</h3>
                                        </div>
                                        <hr>
                                        <form id="class-form" method="post" novalidate="novalidate">
                                            <div class="form-group">
                                                <label for="year">Year</label>
                                                <select class="form-control" id="year" name="year">
                                                    <option value="none">Select Year</option>
                                                    <option value="1">First Year</option>
                                                    <option value="2">Second Year</option>
                                                    <option value="3">Third Year</option>
                                                </select>
                                            </div>
                                            <div>
                                                <button id="class-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-plus fa-lg"></i>&nbsp;
                                                    <span>Add Class</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Year</th>
                                                <th>Class Teacher</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$idd = 1;
foreach ($classes as $row) {
?>
                                            <tr>
                                                <td><?php echo $idd; ?></td>
                                                <td><?php echo e($row['label']); ?></td>
<?php if ($row['teacher_id'] == '0') { ?>
                                                <td>
                                                    <div class="assign-form">
                                                        <select class="form-control" aria-label="Class teacher for <?php echo e($row['label']); ?>">
                                                            <option value="none">Select Teacher to be assigned</option>
<?php foreach ($free_teachers as $row1) { ?>
                                                            <option value="<?php echo e($row1['id']); ?>"><?php echo e($row1['first_name'] . ' ' . $row1['last_name']); ?></option>
<?php } ?>
                                                        </select>
                                                        <button type="button" class="btn btn-sm btn-warning js-assign-teacher" data-class-id="<?php echo e($row['id']); ?>">
                                                            Assign Class Teacher
                                                        </button>
                                                    </div>
                                                </td>
<?php } else { ?>
                                                <td><?php echo e($row['first_name'] . ' ' . $row['last_name']); ?></td>
<?php } ?>
                                            </tr>
<?php
	$idd++;
}
if (count($classes) === 0) {
?>
                                            <tr>
                                                <td colspan="3" class="text-center">No classes added yet.</td>
                                            </tr>
<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
<?php include(__DIR__ . '/../includes/layout/portal_bottom.php'); ?>
    <script>
        $('#class-form').on('submit', function (event) {
            event.preventDefault();
            var year = $('#year').val();
            if (year == "none") {
                App.notify('Please select a year.', 'error');
                $('#year').focus();
                return;
            }
            var button = $('#class-button').prop('disabled', true);
            App.post('../sqloperations/insert_class.php', { year: year }).then(function (response) {
                if (!response.ok) {
                    button.prop('disabled', false);
                    App.notify(response.message, 'error');
                    return;
                }
                App.notifyThenGo('Class added successfully', 'index.php');
            });
        });

        $('.js-assign-teacher').on('click', function () {
            var button = $(this);
            var select = button.closest('.assign-form').find('select');
            if (select.val() == "none") {
                App.notify('Please select a teacher to be assigned.', 'error');
                select.focus();
                return;
            }
            button.prop('disabled', true);
            App.post('../sqloperations/add_class_tech.php', {
                teacher_id: select.val(),
                class_id: button.data('class-id')
            }).then(function (response) {
                if (!response.ok) {
                    button.prop('disabled', false);
                    App.notify(response.message, 'error');
                    return;
                }
                App.notifyThenGo('Teacher assigned successfully', 'index.php');
            });
        });
    </script>

</body>

</html>
<!-- end document-->
