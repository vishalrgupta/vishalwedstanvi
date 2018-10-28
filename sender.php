<?php

	header('Content-type: application/json'); 

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	//Load composer's autoloader
	require './vendor/autoload.php';


	/* Form Process	
	*------------------------------------------------------------*/

	if ( ! empty( $_POST ) ) {

		$post_arr = array();

		$post_arr = $_POST;

		foreach( $post_arr as $key => $val){

		    $content_arr[] = '<p><strong>' . $key . ':</strong>  ' . htmlentities( $val ) . '<br /></p>';
		    $altbody_arr[] = $key . ': ' . htmlentities( $val );
		   
		}

		// email contents
		$content = implode( $content_arr );
		$altbody = implode( $altbody_arr );


		/* Email Process	
		*------------------------------------------------------------*/

		// Email subject
		$subject = 'RSVP';

		$mail = new PHPMailer;							// Passing `true` enables exceptions
		
		try {
			
			//Server settings	
			$mail->Host = 'localhost';  				// Specify main and backup SMTP servers
			$mail->Port = 25;							// TCP port to connect to
			
			//Recipients
			$mail->setFrom('youremail@domain.com');
			$mail->addAddress('youremail@domain.com');	// Add a recipient

			//Content
			$mail->isHTML(true);						// Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $content;
			$mail->AltBody = $altbody;

			$mail->send();
			
			$response_array['status'] = 'success';
			
		} catch (Exception $e) {
			
			$response_array['status'] = 'error';
			
		}

	} else {

		$response_array['status'] = 'error';
	}

	echo json_encode($response_array);

?>