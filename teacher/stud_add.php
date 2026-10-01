<?php
require_once __DIR__ . '/../includes/auth.php';
$role = 'teacher';
$ur = require_login($role);

// Students belong to the class this teacher is class teacher of.
$class = db_row('SELECT * FROM class WHERE teacher_id = ? ORDER BY id LIMIT 1', array($ur['id']));

$page_title = 'Add Student';
$active = 'stud_add.php';
include(__DIR__ . '/../includes/layout/portal_top.php');
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
<?php if ($class === null) { ?>
                                        <div class="empty-state">
                                            <i class="fa fa-lock"></i>
                                            Only a class teacher can add students. Please ask your HOD to assign you a class.
                                        </div>
<?php } else { ?>
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Add Student in the system</h3>
                                            <p class="text-center text-muted mb-0"><?php echo e(year_label($class['year'])); ?> class</p>
                                        </div>
                                        <hr>
                                        <form id="student-form" method="post" novalidate="novalidate">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="roll" class="control-label mb-1">Roll No.</label>
                                                    <input id="roll" name="roll" type="text" maxlength="10" class="form-control" aria-required="true" placeholder="Enter Roll No. of Student">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="enroll" class="control-label mb-1">En. Roll No.</label>
                                                    <input id="enroll" name="enroll" type="text" maxlength="10" class="form-control" aria-required="true" placeholder="Enter Enrollment No. of Student">
                                                    <small class="form-text text-muted">Letters and digits only, up to 10 characters.</small>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Full Name</label>
                                                <input id="name" name="name" type="text" maxlength="100" class="form-control" aria-required="true" placeholder="Name of Student">
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="phone" class="control-label mb-1">Phone No.</label>
                                                    <input id="phone" name="phone" type="text" inputmode="numeric" maxlength="10" class="form-control" aria-required="true" placeholder="Enter 10 digit phone No. of student">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email" class="control-label mb-1">Email</label>
                                                    <input id="email" name="email" type="email" maxlength="100" class="form-control" aria-required="true" placeholder="Enter Email of Student">
                                                </div>
                                            </div>
                                            <div>
                                                <button id="student-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-plus fa-lg"></i>&nbsp;
                                                    <span>Add Student</span>
                                                </button>
                                            </div>
                                        </form>
<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php include(__DIR__ . '/../includes/layout/portal_bottom.php'); ?>
    <script>
        $('#phone').on('change', function () {
            var field = $(this);
            if (field.val().trim() == '') {
                return;
            }
            App.post('../validation/checkmob.php', { phone: field.val().trim(), table: 'student' }).then(function (response) {
                if (!response.ok) {
                    App.notify(response.message, 'error');
                    field.val('').focus();
                }
            });
        });

        $('#email').on('change', function () {
            var field = $(this);
            if (field.val().trim() == '') {
                return;
            }
            App.post('../validation/emailvalid.php', { email: field.val().trim(), type: 'reg', table: 'student' }).then(function (response) {
                if (!response.ok) {
                    App.notify(response.message, 'error');
                    field.val('').focus();
                }
            });
        });

        $('#student-form').on('submit', function (event) {
            event.preventDefault();
            var button = $('#student-button').prop('disabled', true);
            App.post('../sqloperations/insert_student.php', {
                roll: $('#roll').val().trim(),
                enroll: $('#enroll').val().trim(),
                name: $('#name').val().trim(),
                phone: $('#phone').val().trim(),
                email: $('#email').val().trim()
            }).then(function (response) {
                if (!response.ok) {
                    button.prop('disabled', false);
                    App.notify(response.message, 'error');
                    return;
                }
                App.notifyThenGo('Student added successfully', 'stud_add.php');
            });
        });
    </script>

</body>

</html>
<!-- end document-->
