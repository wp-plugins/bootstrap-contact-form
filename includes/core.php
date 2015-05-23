<?php
$ma_form = "";
$ma_error = "";
//Creates a contact form in swedish
function ma_html_form_code_swe() { 
	$ma_form .= '<form role="form" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
    $ma_form .= '<div class="form-group">
    <label for="contact-form-name">Namn*: </label>
	<input type="text" class="form-control" required name="contact-form-name" id="contact-form-name" value="' . (isset( $_POST["contact-form-name"]) ? esc_attr($_POST["contact-form-name"]) : '' ) . '" />
	</div>';
	
    $ma_form .= '<div class="form-group">
    <label for="contact-form-email">E-mail*: </label>
	<input type="email" name="contact-form-email" required class="form-control" id="contact-form-email" value="' . ( isset( $_POST["contact-form-email"] ) ? esc_attr( $_POST["contact-form-email"] ) : '' ) . '" />
	</div>';
    
    $ma_form .= '<div class="form-group">
    <label for="contact-form-subject">Ämne: </label><input class="form-control" type="text" name="contact-form-subject" value="' . ( isset( $_POST["contact-form-subject"] ) ? esc_attr( $_POST["contact-form-subject"] ) : '' ) . '" /></div>';
    
    $ma_form .= '<div class="form-group">
    <label for="contact-form-message">Meddelande*: </label>
	<textarea class="form-control" required id="contact-form-message" name="contact-form-message">' . ( isset( $_POST["contact-form-message"] ) ? esc_attr( $_POST["contact-form-message"] ) : '' ) . '</textarea>
	</div>';

    $ma_form .= '<button type="submit" class="btn btn-default ma-button" name="contact-form-submit">Skicka</button>';
    $ma_form .= '</form>';
	echo $ma_form;
}

//Creates a contact form in english 
function ma_html_form_code_eng() {
    $ma_form .= '<form role="form" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
    $ma_form .= '<div class="form-group">
    <label for="contact-form-name">Name*: </label>
	<input type="text" class="form-control" required name="contact-form-name" id="contact-form-name" value="' . ( isset( $_POST["contact-form-name"] ) ? esc_attr( $_POST["contact-form-name"] ) : '' ) . '" /></div>';

    $ma_form .= '<div class="form-group">
    <label for="contact-form-email">E-mail*: </label>
	<input type="email" name="contact-form-email" required class="form-control" id="contact-form-email" value="' . ( isset( $_POST["contact-form-email"] ) ? esc_attr( $_POST["contact-form-email"] ) : '' ) . '" />
	</div>';
    
    $ma_form .= '<div class="form-group">
    <label for="contact-form-subject">Subject: </label><input class="form-control" type="text" name="contact-form-subject" value="' . ( isset( $_POST["contact-form-subject"] ) ? esc_attr( $_POST["contact-form-subject"] ) : '' ) . '" /></div>';
    
    $ma_form .= '<div class="form-group">
    <label for="contact-form-message">Message*: </label>
	<textarea class="form-control" id="massage" required name="contact-form-message">' . ( isset( $_POST["contact-form-message"] ) ? esc_attr( $_POST["contact-form-message"] ) : '' ) . '</textarea>
	</div>';

    $ma_form .= '<button type="submit" class="btn btn-default ma-button" name="contact-form-submit">Send</button>';
    $ma_form .= '</form>';
	echo $ma_form;
}

 
function ma_deliver_mail($lang) {
	
 	if ( isset( $_POST['contact-form-submit'] ) ) { 		
        if (empty($_POST["contact-form-name"])) {
			if ($lang == "swe") {
    			$ma_error .= "* Namn är obligatoriskt. <br />" . "\r\n";
			}
			else 
			{
				$ma_error .= $nameError = "* Name is required. <br />" . "\r\n";
			}
  		} 
		else {
			$ma_name = sanitize_text_field( $_POST["contact-form-name"]);
			if ($lang == "swe") {
				if (!preg_match("/^[a-öA-Ö0-9]+$/",$ma_name)) {
  					$ma_error .= "* Endast bokstäver är tillåtna. <br />" . "\r\n";
				}
			}
			elseif (!preg_match("/^[a-zA-Z ]*$/",$ma_name)) { 
				$ma_error .= "* Name may only contain letters. <br />" . "\r\n";
			}
			else {
				$ma_name = sanitize_text_field( $_POST["contact-form-name"]);
			}
  		}
    	if (empty($_POST["contact-form-email"])) {
				if ($lang == "swe") {
    				$ma_error .= "* E-mail är obligatoriskt. <br />" . "\r\n";
				}
				else 
				{
					$ma_error .= "* E-mail is required. <br />" . "\r\n";
				}
			}
		else {
			$ma_email = sanitize_email( $_POST["contact-form-email"] );
			if (!filter_var($ma_email, FILTER_VALIDATE_EMAIL)) {
  				if ($lang == "swe") {
    				$ma_error .= "* Ogiltigt e-mail format. <br />" . "\r\n";
				}
				else 
				{
					$ma_error .= "* Invalid e-mail format. <br />" . "\r\n";
				}
			}
			else {
				$ma_email = sanitize_email( $_POST["contact-form-email"] );
			}
		}
		
        $ma_subject = stripslashes(sanitize_text_field( $_POST["contact-form-subject"] ));
        
		if (empty($_POST["contact-form-message"])) {
			if ($lang == "swe") {
    			$ma_error .= "* Meddelande är obligatoriskt. <br />" . "\r\n";
			}
			else 
			{
				$ma_error .= "* Message is required. <br />" . "\r\n";
			}
		}
		else {
			$ma_message = stripslashes(esc_textarea( $_POST["contact-form-message"] ));
		}
 
        // get the email address
    	$ma_to = get_option('ma_bootstrapcontactform_email');
 
        $ma_headers = "From: $ma_name <$ma_email>" . "\r\n";
 		if ($lang == "swe") {
			if ($ma_error != "") {
				echo '<div id="errorMessages">' . $ma_error . '</div>';

				return; 
			}
			elseif ( wp_mail( $ma_to, $ma_subject, $ma_message, $ma_headers ) ) {
				$ma_success = '<p>Tack för ditt meddelande, vi kontaktar dig inom kort.</p>';
				$_POST["contact-form-name"] = "";
				$_POST["contact-form-email"] = "";
				$_POST["contact-form-subject"] = "";
				$_POST["contact-form-message"] = "";
				echo '<div class="formSuccess">' .  $ma_success . '</div>' ;						
        	} 
			else {
           		echo 'Något gick fel! Försök igen eller skicka ett mail till ' . $ma_to . '.';
        	}
		}
        // If email has been process for sending, display a success message
        else {
			if ($ma_error != "") {
				echo '<div id="errorMessages">' . $ma_error . '</div>';
				return; 
			}
			elseif ( wp_mail( $ma_to, $ma_subject, $ma_message, $ma_headers ) ) {
            	$ma_success = '<p>Thanks for the message, we will contact you shortly. </p>';
				$_POST["contact-form-name"] = "";
				$_POST["contact-form-email"] = "";
				$_POST["contact-form-subject"] = "";
				$_POST["contact-form-message"] = "";
				echo '<div class="formSuccess">' .  $ma_success . '</div>' ;	
        	} 
			else {
            	echo 'An unexpected error occurred! Please try again or send an e-mail to ' . $ma_to . '.';
        	}
    	}
	}
}
?>