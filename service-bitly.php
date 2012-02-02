<?php
function dpus_get_short_url_from_bitly($post_id){
	global $post;
	$key = get_option( 'bitly_shortner_service_key' );
	$username = get_option( 'bitly_shortner_service_username' );
	if (!$post_id && $post) $post_id = $post->ID;

	if ($post->post_status != 'publish')
		return "";

	$shortlink = get_post_meta($post_id, '_shortlink', true);
	if ($shortlink)
		return $shortlink;

	$permalink = get_permalink($post_id);

	$http = new WP_Http();
	$url = "https://api-ssl.bitly.com/v3/shorten";
	$login = "login=" . $username;
	$apikey = "apiKey=" . $key;
	$longurl = "longUrl=" . urlencode($permalink);
	$format = "format=json";
	$url = $url . "?" . $login . "&" . $apikey . "&" . $longurl . "&" . $format;
	$result = $http->request($url, array( 'method' => 'GET','sslverify' => false));
	$result = json_decode($result['body']);
	$shortlink = $result->data->url;
	if ($result->status_code == 200) {
		add_post_meta($post_id, '_shortlink', $shortlink, true);
	}
}
?>