<?php
    if($_POST['ma_bootstrapcontactform_hidden'] == 'Y') {
        //Form data sent
        $ma_email = $_POST['ma_bootstrapcontactform_email'];
        update_option('ma_bootstrapcontactform_email', $ma_email);
        ?>
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
        <?php
    } else {
        //Normal page display
	$ma_email = get_option('ma_bootstrapcontactform_email');
    }
?>

<div class="wrap">
    <?php    echo "<h2>" . __( 'Bootstrap Contact Form settings', 'ma_bootstrapcontactform_trdom' ) . "</h2>"; ?>
     <?php echo "<p>This contact form uses Bootstrap styling classes such as 'form-control'. <br />
	 If you don't have Bootstrap installed you can get it here: <a href='http://getbootstrap.com/getting-started/' title='Get Bootstrap'>GetBootstrap.com</a>.</p>"; ?>
    <form name="ma_bootstrapcontactform_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="ma_bootstrapcontactform_hidden" value="Y">
        <?php    echo "<h3>" . __( 'Enter your email address.', 'ma_bootstrapcontactform_trdom' ) . "</h3>"; ?>
        <?php echo "<p>The messages from the contact form will be sent to this e-mail</p>"; ?>
        <p><?php _e("E-mail: " ); ?><input class="form-control" type="email" name="ma_bootstrapcontactform_email" value="<?php echo $ma_email; ?>" size="40"><?php _e(" ex: name@test.com" ); ?></p>
         
     
        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'ma_bootstrapcontactform_trdom' ) ?>" />
        </p>
    </form>
	<?php echo "<p>To use the contact from simply insert one of the shortcodes in your post or page:  <br />
	 Contact form in english: <strong>[bootstrapcontactform_english]</strong> <br />
	Kontaktformulär på svenska: <strong>[bootstrapcontactform_swedish]</strong></p>"; ?>
</div>