<?php
require_once __DIR__ . '/../includes/auth.php';
$role = 'hod';
$ur = require_login($role);

$subjects = db_all(
	'SELECT s.*, t.first_name, t.last_name
	 FROM subject s LEFT JOIN teacher_reg t ON t.id = s.teacher_id
	 WHERE s.department_id = ? ORDER BY s.year, s.id',
	array($ur['department_id'])
);
$teachers = db_all(
	'SELECT id, first_name, last_name FROM teacher_reg WHERE department_id = ? ORDER BY first_name',
	array($ur['department_id'])
);

$page_title = 'Add Subject';
$active = 'subject_add.php';
include(__DIR__ . '/../includes/layout/portal_top.php');
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Add Subject in the system</h3>
                                        </div>
                                        <hr>
                                        <form id="subject-form" method="post" novalidate="novalidate">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name" class="control-label mb-1">Subject Name</label>
                                                    <input id="name" name="name" type="text" maxlength="100" class="form-control" aria-required="true" placeholder="Enter name of subject">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="code" class="control-label mb-1">Subject Code</label>
                                                    <input id="code" name="code" type="text" maxlength="20" class="form-control" aria-required="true" placeholder="Enter subject code">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="type" class="control-label mb-1">Type</label>
                                                    <select class="form-control" id="type" name="type">
                                                        <option value="none">Select type</option>
                                                        <option value="0">Theory</option>
                                                        <option value="1">Practical</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="year" class="control-label mb-1">Year</label>
                                                    <select class="form-control" id="year" name="year">
                                                        <option value="none">Select Year</option>
                                                        <option value="1">First Year</option>
                                                        <option value="2">Second Year</option>
                                                        <option value="3">Third Year</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <button id="subject-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-plus fa-lg"></i>&nbsp;
                                                    <span>Add Subject</span>
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
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Year</th>
                                                <th>Type</th>
                                                <th>Teacher</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$idd = 1;
foreach ($subjects as $row) {
?>
                                            <tr>
                                                <td><?php echo $idd; ?></td>
                                                <td><?php echo e($row['name']); ?></td>
                                                <td><?php echo e($row['code']); ?></td>
                                                <td><?php echo $row['year'] > 0 ? e(year_label($row['year'])) : '-'; ?></td>
                                                <td><?php echo $row['type'] == 1 ? 'Practical' : 'Theory'; ?></td>
<?php if ($row['teacher_id'] == '0') { ?>
                                                <td>
                                                    <div class="assign-form">
                                                        <select class="form-control" aria-label="Teacher for <?php echo e($row['name']); ?>">
                                                            <option value="none">Select Teacher to be assigned</option>
<?php foreach ($teachers as $row1) { ?>
                                                            <option value="<?php echo e($row1['id']); ?>"><?php echo e($row1['first_name'] . ' ' . $row1['last_name']); ?></option>
<?php } ?>
                                                        </select>
                                                        <button type="button" class="btn btn-sm btn-warning js-assign-teacher" data-subject-id="<?php echo e($row['id']); ?>">
                                                            Assign Teacher
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
if (count($subjects) === 0) {
?>
                                            <tr>
                                                <td colspan="6" class="text-center">No subjects added yet.</td>
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
        $('#subject-form').on('submit', function (event) {
            event.preventDefault();
            var name = $('#name').val().trim();
            var code = $('#code').val().trim();
            var type = $('#type').val();
            var year = $('#year').val();
            if (name == "" || code == "" || type == "none" || year == "none") {
                App.notify('Please fill in the subject name, code, type and year.', 'error');
                return;
            }
            var button = $('#subject-button').prop('disabled', true);
            App.post('../sqloperations/insert_subject.php', {
                name: name,
                code: code,
                year: year,
                type: type
            }).then(function (response) {
                if (!response.ok) {
                    button.prop('disabled', false);
                    App.notify(response.message, 'error');
                    return;
                }
                App.notifyThenGo('Subject added successfully', 'subject_add.php');
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
            App.post('../sqloperations/add_subject_tech.php', {
                teacher_id: select.val(),
                subject_id: button.data('subject-id')
            }).then(function (response) {
                if (!response.ok) {
                    button.prop('disabled', false);
                    App.notify(response.message, 'error');
                    return;
                }
                App.notifyThenGo('Teacher assigned successfully', 'subject_add.php');
            });
        });
    </script>

</body>

</html>
<!-- end document-->
