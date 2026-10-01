<?php
// Closing markup and scripts for the login-style pages. The page adds its own
// <script> after this include and then closes </body></html>.
?>
			</div>
		</div>
	</div>

	<script src="<?php echo $base; ?>includes/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $base; ?>includes/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo $base; ?>includes/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo $base; ?>includes/vendor/select2/select2.min.js"></script>
	<script src="<?php echo $base; ?>includes/vendor/tilt/tilt.jquery.min.js"></script>
	<script src="<?php echo $base; ?>includes/js/app.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="<?php echo $base; ?>includes/js/main.js"></script>
