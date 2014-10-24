<?php
	if (isset($_POST['email']) && isset($_POST['password'])) {
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			if (strlen($_POST['password']) >= 8) {
				$stmt = $db->prepare('SELECT * FROM accounts WHERE email=:email LIMIT 1');
				$stmt->execute(array(
					':email'=>$_POST['email']
				));
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if ($results) {
					$password_valid = password_verify($_POST['password'], $results[0]['password']);

					if ($password_valid) {
						$update_session_id = md5(mcrypt_create_iv(16, MCRYPT_RAND) . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . uniqid(microtime(), true));
						$update_session_ip = $_SERVER['REMOTE_ADDR'];
						$update_session_user_agent = $_SERVER['HTTP_USER_AGENT'];

						$stmt = $db->prepare('UPDATE accounts SET session_id=:session_id, session_ip=:session_ip, session_user_agent=:session_user_agent WHERE email=:email');
						$stmt->execute(array(
							':session_id'=>$update_session_id,
							':session_ip'=>$update_session_ip,
							':session_user_agent'=>$update_session_user_agent,
							':email'=>$_POST['email']
						));

						setcookie('session', $update_session_id, 0, '/');
						$logged_in = true;

						header('Location: ' . preg_replace('/\.php|index\.php/', '', $_SERVER['PHP_SELF']));
					}
				}

				else {
					$insert_email = $_POST['email'];
					$insert_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$insert_session_id = md5(mcrypt_create_iv(16, MCRYPT_RAND) . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . uniqid(microtime(), true));
					$insert_session_ip = $_SERVER['REMOTE_ADDR'];
					$insert_session_user_agent = $_SERVER['HTTP_USER_AGENT'];

					$stmt = $db->prepare('INSERT INTO accounts (email, password, level, session_id, session_ip, session_user_agent) VALUES (:email, :password, :level, :session_id, :session_ip, :session_user_agent)');
					$stmt->execute(array(
						':email'=>$insert_email,
						':password'=>$insert_password,
						':level'=>'Basic',
						':session_id'=>$insert_session_id,
						':session_ip'=>$insert_session_ip,
						':session_user_agent'=>$insert_session_user_agent
					));

					setcookie('session', $insert_session_id, 0, '/');
					$account_created = true;

					require $_SERVER['DOCUMENT_ROOT'] . '/sendgrid/sendgrid-php.php';

					$sendgrid = new SendGrid($SENDGRID_USERNAME, $SENDGRID_PASSWORD);

					$email = new SendGrid\Email();
					$email->
						addTo($insert_email)->
						setFrom('contact@findanewmax.com')->
						setFromName('FITspiration')->
						setSubject('Welcome to FITspiration!')->
						setHtml("<div style=\"font-family:'Open Sans','Helvetica Neue',Helvetica,'Trebuchet MS','Verdana',Arial,sans-serif;text-align:center;\"><img src=\"https://www.findanewmax.com/img/logo.png\" width=\"20%\"><h1>Welcome to FITspiration!</h1><p>We're sending you this email to let you know that your account is all set up and ready to go! If you ever lose your way, visit <a href=\"https://www.findanewmax.com/\">findanewmax.com</a> and log in with your email ($insert_email) and the password you chose when you signed up. Thank you for being a part of the FITspiration community!</p><p><small>P.S. This email is just for confirmation, and we'll never send you spam. If you have any questions or concerns, please reply to this email or send a new message to <a href=\"mailto:contact@findanewmax.com\">contact@findanewmax.com</a>.</small></p></div>");
					$sendgrid->send($email);

					header('Location: ' . preg_replace('/\.php|index\.php/', '', $_SERVER['PHP_SELF']));
				}
			}

			else {
				$password_too_short = true;
			}
		} else {
			$email_valid = false;
		}
	}
?>
