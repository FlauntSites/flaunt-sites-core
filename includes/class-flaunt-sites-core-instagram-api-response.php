<?php
/**
 * Shortcode for the Instagram API Response
 *
 * @link       http://williambay.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes
 */

add_shortcode( 'instagram', function(){
	$code = isset($_GET['code']) ? $_GET['code'] : null;
	
    if ($code) {
        $result = bb_get_ig_access_token($code);

        if ($result) {
			bb_get_ig_long_term_access_token();
			return 'All Good in the Hood.';
        }
    }
});

function bb_get_ig_long_term_access_token()
{
    $ig_details = get_user_meta(get_current_user_id(), 'ig_user_details', true);

    $client_secret = FS_IG_APP_CLIENT_SECRET;
    $access_token  = $ig_details['access_token'];

    $url = "https://graph.instagram.com/access_token?grant_type=ig_exchange_token&client_secret={$client_secret}&access_token={$access_token}";

    $response = wp_remote_get($url);

    $body = wp_remote_retrieve_body($response);

    if (!$body) {
        return false;
    }

    $ig_details = json_decode($body, true);

    if (!isset($ig_details['access_token']) || !isset($ig_details['user_id'])) {
        return false;
    }

    update_user_meta(get_current_user_id(), 'ig_user_details', $ig_details);

    return $ig_details;
}

function bb_get_ig_access_token($code)
{
    $url = 'https://api.instagram.com/oauth/access_token';

    $response = wp_remote_post($url, [
        'body' => [
            'client_id'     => FS_IG_APP_CLIENT_ID,
            'client_secret' => FS_IG_APP_CLIENT_SECRET,
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => 'https://flauntsites.com/instagram-redirect-page/',
            'code'          => $code,
        ],
    ]);

    $body = wp_remote_retrieve_body($response);

    if (!$body) {
        return false;
    }

    $ig_details = json_decode($body, true);

    if (!isset($ig_details['access_token']) || !isset($ig_details['user_id'])) {
        return false;
    }

    update_user_meta(get_current_user_id(), 'ig_user_details', $ig_details);

    return $ig_details;
}