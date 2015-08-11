<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome User</title>
	<link rel="stylesheet" href="styling.css">
</head>
<body>
	<h1>Welcome</h1>
	<div class="loginBox">
		<form action="loginProcess.php" method="post">
			<input type="hidden" name="action" value="login">
			<h2>Login</h2>
			<p>User Name:</p>
			<input type="text" name="user_name">
			<p>Password:</p>
			<input type="password" name="password">
			<button>Login</button>
		</form>
		<?php if(isset($_SESSION['login_errors']))
				{
				foreach($_SESSION['login_errors'] as $error)
				{ ?>
					<p class='error'><?= $error ?></p>
			<?php } unset($_SESSION['login_errors']); 
		} ?>
	</div>
	<div class="loginBox">
		<form action="loginProcess.php" method="post">
			<input type="hidden" name="action" value="register">
			<h2>Register</h2>
			<p>User Name:</p>
			<input type="text" name="user_name">
			<p>Email:</p>
			<input type="email" name="email">
			<p>Password:</p>
			<input type="password" name="password">
			<p>Confirm Password:</p>
			<input type="password" name="confirm_password">
			<button>Register</button>
		</form>
		<?php 
			if(isset($_SESSION['register_errors']))
			{ 
				foreach($_SESSION['register_errors'] as $error)
				{ ?>
				<p class="error"><?= $error ?></p>
				<?php } unset($_SESSION['register_errors']);
			} ?>
	</div>
</body>
</html>