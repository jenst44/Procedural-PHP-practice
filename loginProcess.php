<?php 
session_start();
require_once('connection.php');

if($_POST['action'] == 'register')
{
	register_user($connection, $_POST);
}
elseif($_POST['action'] == 'login')
{
	login_user($connection, $_POST);
}
else
{
	session_destroy();
	header("Location: login.php");
}

function register_user($connection, $post)
{
	$_SESSION['register_errors'] = array();

	if(empty($post['user_name']))
	{
		$_SESSION['register_errors'][] = 'User Name Cannot Be Blank';
	}
	if(empty($post['email']))
	{
		$_SESSION['register_errors'][] = 'Email Cannot Be Blank';
	}
	if(empty($post['password']))
	{
		$_SESSION['register_errors'][] = 'Password Cannot Be Blank';
	}
	elseif(strlen($post['password']) < 6)
	{
		$_SESSION['register_errors'][] = 'Password Must Be At Least Six Characters Long';
	}
	if($post['password'] != $post['confirm_password'])
	{
		$_SESSION['register_errors'][] = "Password & Confirm Password Do Not Match";
	}
	
	$firstQuery = "SELECT * FROM users WHERE users.email = '{$post['email']}'";
	$result = fetch_all($firstQuery);

	if(count($result) > 0)
	{
		$_SESSION['register_errors'][] = "Email Already Exists";
	}

	$nextQuery = "SELECT * FROM users WHERE users.user_name = '{$post['user_name']}'";
	$result = fetch_all($firstQuery);

	if(count($result) > 0)
	{
		$_SESSION['register_errors'][] = "User Name Already Exists";
	}
	if(count($_SESSION['register_errors']) > 0)
	{
		header('Location: login.php');
	}
	else
	{
		$user_name = mysqli_real_escape_string($connection, ucwords(strtolower($post['user_name'])));
		$email = mysqli_real_escape_string($connection, strtolower($post['email']));
		$password = mysqli_real_escape_string($connection, $post['password']);
		$secondQuery = "INSERT INTO users (user_name, email, password, created_at, updated_at) VALUES ('$user_name', '$email', '$password', NOW(), NOW())";
		if(mysqli_query($connection, $secondQuery))
		{
			$setQuery = "SELECT * FROM users WHERE users.email = '$email'";
			$result = fetch_all($setQuery);

			$_SESSION['user_name'] = $user_name;
			$_SESSION['user_id'] = $result[0]['id'];
			header('Location: success.php');
		}
		else
		{
			header('Location: login.php');
		}

	}
}

function login_user($connection, $post)
{
	$_SESSION['login_errors'] = array();
	
	if(empty($post['user_name']))
	{
		$_SESSION['login_errors'][] = 'User Name cannot be blank';
	}
	if(empty($post['password']))
	{
		$_SESSION['login_errors'][] = 'Password cannot be blank';
	}
	if(count($_SESSION['login_errors']) > 0)
	{
		header('Location: login.php');
	}
	else
	{
		$user_name = mysqli_real_escape_string($connection, $post['user_name']);
		$password = mysqli_real_escape_string($connection, $post['password']);
		$query = "SELECT * FROM users WHERE users.user_name = '{$user_name}'";
		$result = fetch_all($query);

		if(!empty($result) && $result[0]['password'] == $password)
		{
			$_SESSION['user_name'] = $user_name;
			$_SESSION['user_id'] = $result[0]['id'];
			header('Location: success.php');
		}
		else
		{
			$_SESSION['login_errors'][] = 'Login Failed';
			header('Location: login.php');
		}
	}
}
?>
