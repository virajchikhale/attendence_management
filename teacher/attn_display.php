<?php
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
if ($f_date > $t_date) {
	flash_set('The From date must not be after the To date.', 'error');
	header('Location: attn_report.php');
	exit;
}

$report = attendance_report($ur, $year, $f_date, $t_date);
$subject_count = count($report['theory']) + count($report['practical']);
$export_query = http_build_query(array('f_date' => $f_date, 't_date' => $t_date, 'year' => $year));

$page_title = 'Display Report';
$active = 'attn_report.php';
include(__DIR__ . '/../includes/layout/portal_top.php');
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header card-header--split">
                                        <span><strong><?php echo e(year_label($year)); ?></strong> &middot; <?php echo e($f_date); ?> to <?php echo e($t_date); ?></span>
                                        <span>
                                            <a href="attn_report.php" class="btn btn-outline-secondary btn-sm">Change</a>
<?php if (count($report['rows']) > 0 && $subject_count > 0) { ?>
                                            <a href="attn_table.php?<?php echo e($export_query); ?>" class="btn btn-success btn-sm"><i class="fa fa-download mr-1"></i>Export to Excel Sheet</a>
<?php } ?>
                                        </span>
                                    </div>
<?php if ($subject_count === 0) { ?>
                                    <div class="card-body">
                                        <div class="empty-state">
                                            <i class="fa fa-book"></i>
                                            You have no subjects in <?php echo e(year_label($year)); ?>.
                                        </div>
                                    </div>
<?php } else if (count($report['rows']) === 0) { ?>
                                    <div class="card-body">
                                        <div class="empty-state">
                                            <i class="fa fa-users"></i>
                                            There are no students in the <?php echo e(year_label($year)); ?> class yet.
                                        </div>
                                    </div>
<?php } else { ?>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-report mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Roll</th>
                                                        <th>Enroll</th>
                                                        <th>Name</th>
<?php foreach ($report['theory'] as $roow) { ?>
                                                        <th><?php echo e($roow['name']); ?></th>
<?php } ?>
                                                        <th>Theory</th>
<?php foreach ($report['practical'] as $roow) { ?>
                                                        <th><?php echo e($roow['name']); ?></th>
<?php } ?>
                                                        <th>Practical</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php foreach ($report['rows'] as $row) { ?>
                                                    <tr>
                                                        <td><?php echo e($row['student']['roll']); ?></td>
                                                        <td><?php echo e($row['student']['enroll']); ?></td>
                                                        <td><?php echo e($row['student']['name']); ?></td>
<?php foreach ($row['theory'] as $count) { ?>
                                                        <td><?php echo $count['present']; ?> / <?php echo $count['total']; ?></td>
<?php } ?>
                                                        <td><?php echo format_percent($row['theory_percent']); ?></td>
<?php foreach ($row['practical'] as $count) { ?>
                                                        <td><?php echo $count['present']; ?> / <?php echo $count['total']; ?></td>
<?php } ?>
                                                        <td><?php echo format_percent($row['practical_percent']); ?></td>
                                                        <td><b><?php echo format_percent($row['total_percent']); ?></b></td>
                                                    </tr>
<?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <p class="table-summary">Number of Students: <?php echo count($report['rows']); ?> &middot; each subject shows lectures attended / lectures held</p>
                                    </div>
<?php } ?>
                                </div>
                            </div>
                        </div>
<?php include(__DIR__ . '/../includes/layout/portal_bottom.php'); ?>

</body>

</html>
<!-- end document-->
