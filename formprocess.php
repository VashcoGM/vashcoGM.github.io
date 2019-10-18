
<?php

	//define values and set to empty values
	$email_error = $name_error = $website_error = $subject_error = "";
	$name = $details = $email  = $website = $success = $subject = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		// Name
		if (empty($_POST["name"])) {
			$name_error = "Name is required";
		}else {
			//$username = test_input($_POST["name"]);
			$name  = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
			//check if name only contains letters and whitespaces
			if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
				$name_error = "Only letters and whitespaces allowed";
			}
		}

		// Subject
		if (empty($_POST["subject"])) {
			$subject_error = "Subject is required";
		}else {
			//$subject = test_input($_POST["subject"]);
			$subject  = trim(filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING));
			//check if subject only contains letters and whitespaces
			if (!preg_match("/^[a-zA-Z ]*$/", $subject)) {
				$subject_error = "Only letters and whitespaces allowed";
			}
		}

		// Email
		if (empty($_POST["email"])) {
			$email_error = "Email is required";
		}else {
			//$email = test_input($_POST["email"]);
			$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));

			//check if email address is well formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$email_error = "Invalid email format";
			}
		}

		// Website
		if (empty($_POST["website"])) {
			//$website_error = "Website is required";
			$website = "";
		}else{
			//$website = test_input($_POST["website"]);
			$website = trim(filter_input(INPUT_POST, "website", FILTER_SANITIZE_SPECIAL_CHARS));

			//check if url address syntax is valid (this regular expression also allows dashes in the URL)
			if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
				$website_error = "Invalid URL";
			}
		}


		//check for empty comment section
		if (empty($_POST["details"])) {
			$details = "";
		}else {
			//$details = test_input($_POST["details"]);
			$details =  trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

		}


		//Honey pot check for robots
		if ($_POST["address"] != "") {
			echo "Bad Form Input";
			exit;
		}

		if ($name_error == "" and $email_error == "" and $website_error == "" and $subject_error == "") {
			$email_body = "";
			unset($_POST["submit"]);
			foreach ($_POST as $key => $value) {
				$email_body .= $key. ":". $value. "\n";
			}

			echo "<pre>";
				echo $email_body;
			echo "</pre>";

			

			$mailTo = "vashcogm@gmail.com";
			$subject_of_form = "From Vashco Resume Contact Form";
			$headers = "From: " .$email;
			$txt = "You have received an email from " .$name.".\n\n".$details;

			if(mail($mailTo, $subject_of_form, $email_body, $headers)){
				header("location: register.php?status=mailSend");
				$success = "Thanks for the message, we will get in touch with you shortly.";
				
			}
			
		}
	}

?>
