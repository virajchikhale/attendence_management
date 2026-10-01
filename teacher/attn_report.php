<?php
require_once __DIR__ . '/../includes/auth.php';
$role = 'teacher';
$ur = require_login($role);

$page_title = 'Report Details';
$active = 'attn_report.php';
include(__DIR__ . '/../includes/layout/portal_top.php');
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Details for</strong> Attendence Report
                                    </div>
                                    <form action="attn_display.php" method="get" class="form-horizontal">
                                        <div class="card-body card-block" id="class_details">
                                            <div class="row form-group">
                                                <div class="col-12 col-md-4">
                                                    <label for="f_date" class="form-control-label">From Date</label>
                                                    <input type="date" id="f_date" name="f_date" class="form-control" required>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="t_date" class="form-control-label">To Date</label>
                                                    <input type="date" id="t_date" name="t_date" class="form-control" required>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="year" class="form-control-label">Year</label>
                                                    <select name="year" id="year" class="form-control">
                                                        <option value="1">First Year</option>
                                                        <option value="2">Second Year</option>
                                                        <option value="3">Third Year</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="start_button" class="card-footer">
                                            <button type="submit" class="btn btn-info">View Attendence</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
<?php include(__DIR__ . '/../includes/layout/portal_bottom.php'); ?>
    <script>
        $('#f_date').val(App.today());
        $('#t_date').val(App.today());
    </script>

</body>

</html>
<!-- end document-->
