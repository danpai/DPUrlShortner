<?php

function dpus_manage_option_page(){
	$googshortapikey = "";
	$dpus_shortner_service = "";
	if(!empty($_POST)){
		if(!empty($_POST['googshortapikey'])){
			$googshortapikey = $_POST['googshortapikey'];
		}
		if(!empty($_POST['dpus_shortner_service'])){
			$dpus_shortner_service = $_POST['dpus_shortner_service'];
		}
		if(!empty($_POST['bitlyapikey'])){
			$bitlyapikey = $_POST['bitlyapikey'];
		}
		if(!empty($_POST['bitlyusername'])){
			$bitlyusername = $_POST['bitlyusername'];
		}
		update_option( 'google_shortner_service_key', $googshortapikey );
		update_option( 'dpus_shortner_service', $dpus_shortner_service );
		update_option( 'bitly_shortner_service_key', $bitlyapikey );
		update_option( 'bitly_shortner_service_username', $bitlyusername );
	}
	else{
		$googshortapikey = get_option('google_shortner_service_key');
		$dpus_shortner_service = get_option('dpus_shortner_service');
		$bitlyusername = get_option('bitly_shortner_service_username');
		$bitlyapikey = get_option('bitly_shortner_service_key');
	} ?>
	<div class="wrap"><h1>DP URL Shortner</h1>
	<form method="POST" action="">
	<label>Insert Google URL Shortner API Key</label><br>
	<input type="text" name="googshortapikey" size="50" value="<?php echo $googshortapikey ?>"><br>
	<label>Insert Bitly API Key</label><br>
	<input type="text" name="bitlyapikey" size="50" value="<?php echo $bitlyapikey ?>"><br>
	<label>Insert Bitly Username</label><br>
	<input type="text" name="bitlyusername" size="50" value="<?php echo $bitlyusername ?>"><br>
	<label>Select Shortner Service</label><br>
	<select style="margin-top:10px" name="dpus_shortner_service">
		<option value="google" <?php echo selected( $dpus_shortner_service, "google" ) ?>>Google URL Shortner</option>
		<option value="bitly" <?php echo selected( $dpus_shortner_service, "bitly" ) ?>>Bitly.com</option>
	</select><br>
	<input type="submit" value="Save" style="margin:10px 0 0 120px; width:100px">
	</form></div>
	<?php
}

?>