<?php
/**
 * Created by PhpStorm.
 * User: cjenpitak
 * Date: 5/18/2017 AD
 * Time: 12:16 PM
 */
session_start();
//ทำการเรียก Sesion_start(); เพื่อให้ Sesion ต่างๆทำงาน

require_once __DIR__ . '/vendor/autoload.php';
//ทำการสร้างการดึงไฟล์ต่างๆ
//ของ facebook sdk ด้วยคำสั่ง  require_once  __DIR__ .'ตามด้วย ที่เก็บ file autoload.php '
$fb = new Facebook\Facebook([
    'app_id' => '221875874976573',
    'app_secret' => 'bbea6680fb27d867a205ec0a372a7b52',
    'default_graph_version' => 'v2.2',
]);

$helper = $fb->getPageTabHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (! isset($accessToken)) {
    echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
    exit;
}

// Logged in
echo '<h3>Page ID</h3>';
var_dump($helper->getPageId());

echo '<h3>User is admin of page</h3>';
var_dump($helper->isAdmin());

echo '<h3>Signed Request</h3>';
var_dump($helper->getSignedRequest());

echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());