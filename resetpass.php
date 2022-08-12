<?php include('applogic.php'); ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
	<link rel="stylesheet" href="taters-css.css">
</head>
<body>
	<form class="login-form" action="" method="post">
		<h2 class="form-title">Reset Password Before Signing In</h2>
		<!-- form validation messages -->
		<?php include('messages.php'); ?>
		<div class="form-group">
			<label>New password</label>
			<input type="password" name="new_pass">
		</div>
		<div class="form-group">
			<label>Confirm new password</label>
			<input type="password" name="new_pass_c">
		</div>
		<div class="form-group">
			<button type="submit" name="new_password" id="submitbtn" class="login-btn">Submit</button>
		</div>
	</form>
</body>
</html>