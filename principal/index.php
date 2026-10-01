<?php
require_once __DIR__ . '/../includes/auth.php';
$role = 'principal';
$ur = require_login($role);

$hod = db_value('SELECT COUNT(*) FROM hod_reg');
$teacher = db_value('SELECT COUNT(*) FROM teacher_reg');
$student = db_value('SELECT COUNT(*) FROM student');
$departments = db_all(
	'SELECT d.id, d.name, d.status, h.first_name, h.last_name
	 FROM department d
	 LEFT JOIN hod_reg h ON h.id = (SELECT MIN(id) FROM hod_reg WHERE department_id = d.id)
	 ORDER BY d.id'
);

$page_title = 'Add Department';
$active = 'index.php';
include(__DIR__ . '/../includes/layout/portal_top.php');
?>
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="stat-card">
                                    <div class="stat-card__icon"><i class="fa fa-building"></i></div>
                                    <div>
                                        <div class="stat-card__value"><?php echo count($departments); ?></div>
                                        <div class="stat-card__label">Departments</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="stat-card">
                                    <div class="stat-card__icon"><i class="fa fa-user"></i></div>
                                    <div>
                                        <div class="stat-card__value"><?php echo (int) $hod; ?></div>
                                        <div class="stat-card__label">HODs</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="stat-card">
                                    <div class="stat-card__icon"><i class="fa fa-users"></i></div>
                                    <div>
                                        <div class="stat-card__value"><?php echo (int) $teacher; ?></div>
                                        <div class="stat-card__label">Teachers</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="stat-card">
                                    <div class="stat-card__icon"><i class="fa fa-graduation-cap"></i></div>
                                    <div>
                                        <div class="stat-card__value"><?php echo (int) $student; ?></div>
                                        <div class="stat-card__label">Students</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Add Department in the system</h3>
                                        </div>
                                        <hr>
                                        <form id="dept-form" method="post" novalidate="novalidate">
                                            <div class="form-group">
                                                <label for="dept" class="control-label mb-1">Department Name</label>
                                                <input id="dept" name="dept" type="text" maxlength="100" class="form-control" aria-required="true" placeholder="Enter Name for department">
                                            </div>
                                            <div>
                                                <button id="dept-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-plus fa-lg"></i>&nbsp;
                                                    <span>Add Department</span>
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
                                                <th>HOD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$idd = 1;
foreach ($departments as $row) {
?>
                                            <tr>
                                                <td><?php echo $idd; ?></td>
                                                <td><?php echo e($row['name']); ?></td>
<?php if ($row['first_name'] !== null) { ?>
                                                <td><?php echo e($row['first_name'] . ' ' . $row['last_name']); ?></td>
<?php } else { ?>
                                                <td class="denied">Not Assigned yet</td>
<?php } ?>
                                            </tr>
<?php
	$idd++;
}
if (count($departments) === 0) {
?>
                                            <tr>
                                                <td colspan="3" class="text-center">No departments added yet.</td>
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
        $('#dept-form').on('submit', function (event) {
            event.preventDefault();
            var dept = $('#dept').val().trim();
            if (dept == "") {
                $('#dept').focus();
                return;
            }
            var button = $('#dept-button').prop('disabled', true);
            App.post('../sqloperations/insert_dept.php', { dept: dept }).then(function (response) {
                if (!response.ok) {
                    button.prop('disabled', false);
                    App.notify(response.message, 'error');
                    return;
                }
                App.notifyThenGo('Department added successfully', 'index.php');
            });
        });
    </script>

</body>

</html>
<!-- end document-->
