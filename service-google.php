<?php
function dpus_get_short_url_from_google($post_id){
	global $post;
	$key = get_option( 'google_shortner_service_key' );
	if (!$post_id && $post) $post_id = $post->ID;

	if ($post->post_status != 'publish')
		return "";

	$shortlink = get_post_meta($post_id, '_shortlink', true);
	if ($shortlink)
		return $shortlink;

	$permalink = get_permalink($post_id);

	$http = new WP_Http();
	$headers = array('Content-Type' => 'application/json');
	$url;
	if(isset($key)){
		$url = "https://www.googleapis.com/urlshortener/v1/url";
	}
	else{
		$url = "https://www.googleapis.com/urlshortener/v1/url?key=" . $key;
	}
	$result = $http->request($url, array( 'method' => 'POST', 'body' => '{"longUrl": "' . $permalink . '"}', 'headers' => $headers,'sslverify' => false));
	$result = json_decode($result['body']);
	$shortlink = $result->id;

	if ($shortlink) {
		add_post_meta($post_id, '_shortlink', $shortlink, true);
	}
}
?>