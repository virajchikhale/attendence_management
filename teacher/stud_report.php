<?php
require_once __DIR__ . '/../includes/auth.php';
$role = 'teacher';
$ur = require_login($role);

// Students belong to the class this teacher is class teacher of.
$class = db_row('SELECT * FROM class WHERE teacher_id = ? ORDER BY id LIMIT 1', array($ur['id']));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $class !== null) {
	// Only a student of this teacher's own class can be changed.
	$student = db_row('SELECT * FROM student WHERE id = ? AND class_id = ?', array(post('id'), $class['id']));

	if ($student === null) {
		flash_set('This student was not found in your class.', 'error');
	} else if (isset($_POST['delete'])) {
		db_query('DELETE FROM student WHERE id = ?', array($student['id']));
		flash_set('Deleted Successfully....');
	} else if (isset($_POST['update'])) {
		$roll = post('roll');
		$name = post('name');
		$phone = post('phone');
		$email = post('email');

		if ($roll === '' || strlen($roll) > 10) {
			flash_set('Please enter the roll number (up to 10 characters).', 'error');
		} else if ($name === '' || strlen($name) > 100) {
			flash_set('Please enter the name of the student (up to 100 characters).', 'error');
		} else if (!preg_match('/^[0-9]{10}$/', $phone)) {
			flash_set('Please enter a 10 digit phone number.', 'error');
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
			flash_set('Please enter a valid email address.', 'error');
		} else if (db_value('SELECT COUNT(*) FROM student WHERE class_id = ? AND roll = ? AND id <> ?', array($class['id'], $roll, $student['id'])) > 0) {
			flash_set('This roll number already exists in your class', 'error');
		} else {
			// The enrollment number is not editable: it names the student's attendance column.
			db_query(
				'UPDATE student SET roll = ?, name = ?, phone = ?, email = ? WHERE id = ?',
				array($roll, $name, $phone, $email, $student['id'])
			);
			flash_set('Updated Successfully....');
		}
	}
	header('Location: stud_report.php');
	exit;
}

$students = $class === null ? array() : db_all('SELECT * FROM student WHERE class_id = ? ORDER BY id', array($class['id']));

$page_title = 'Student Report';
$active = 'stud_report.php';
include(__DIR__ . '/../includes/layout/portal_top.php');
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
<?php if ($class === null) { ?>
                                    <div class="card-body">
                                        <div class="empty-state">
                                            <i class="fa fa-lock"></i>
                                            Only a class teacher can manage students. Please ask your HOD to assign you a class.
                                        </div>
                                    </div>
<?php } else { ?>
                                    <div class="card-header card-header--split">
                                        <span><strong><?php echo e(year_label($class['year'])); ?></strong> class students</span>
                                        <a href="stud_add.php" class="btn btn-info btn-sm"><i class="fa fa-plus mr-1"></i>Add Student</a>
                                    </div>
<?php if (count($students) === 0) { ?>
                                    <div class="card-body">
                                        <div class="empty-state">
                                            <i class="fa fa-users"></i>
                                            No students added yet.
                                        </div>
                                    </div>
<?php } else { ?>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-report mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Edit</th>
                                                        <th>Roll</th>
                                                        <th>Enroll</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php foreach ($students as $row) { ?>
                                                    <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-primary btn-icon js-edit" aria-label="Edit <?php echo e($row['name']); ?>"
                                                                data-id="<?php echo e($row['id']); ?>" data-roll="<?php echo e($row['roll']); ?>" data-enroll="<?php echo e($row['enroll']); ?>"
                                                                data-name="<?php echo e($row['name']); ?>" data-phone="<?php echo e($row['phone']); ?>" data-email="<?php echo e($row['email']); ?>">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        </td>
                                                        <td><?php echo e($row['roll']); ?></td>
                                                        <td><?php echo e($row['enroll']); ?></td>
                                                        <td><?php echo e($row['name']); ?></td>
                                                        <td><?php echo e($row['phone']); ?></td>
                                                        <td><?php echo e($row['email']); ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-danger btn-icon js-delete" aria-label="Delete <?php echo e($row['name']); ?>"
                                                                data-id="<?php echo e($row['id']); ?>" data-name="<?php echo e($row['name']); ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
<?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <p class="table-summary">Number of Students added <?php echo count($students); ?></p>
                                    </div>
<?php } ?>
<?php } ?>
                                </div>
                            </div>
                        </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">Update Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group">
                        <label for="edit_enroll">Enrollment No.</label>
                        <input type="text" id="edit_enroll" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_roll">Roll No.</label>
                        <input type="text" name="roll" id="edit_roll" maxlength="10" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" name="name" id="edit_name" maxlength="100" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_phone">Phone Number</label>
                        <input type="text" name="phone" id="edit_phone" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" class="form-control" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="edit_email">Email</label>
                        <input type="email" name="email" id="edit_email" maxlength="100" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" value="1" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="deleteModalTitle">Delete Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="delete_id">
                    <p>Are you sure you want to delete <b id="delete_name"></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="delete" value="1" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
<?php include(__DIR__ . '/../includes/layout/portal_bottom.php'); ?>
    <script>
        $('.js-edit').on('click', function () {
            var button = $(this);
            $('#edit_id').val(button.data('id'));
            $('#edit_enroll').val(button.data('enroll'));
            $('#edit_roll').val(button.data('roll'));
            $('#edit_name').val(button.data('name'));
            $('#edit_phone').val(button.data('phone'));
            $('#edit_email').val(button.data('email'));
            $('#editModal').modal('show');
        });

        $('.js-delete').on('click', function () {
            var button = $(this);
            $('#delete_id').val(button.data('id'));
            $('#delete_name').text(button.data('name'));
            $('#deleteModal').modal('show');
        });
    </script>

</body>

</html>
<!-- end document-->
