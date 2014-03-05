<?php
$access_item = false;

if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["PAGE_PATH"]."/page.class.php");


$request = new HttpRequest('http://wiresusers.dearapi.com/login', HttpRequest::METH_POST);
//$request = new HttpRequest('http://users.local/login', HttpRequest::METH_POST);
$request->addPostFields(array('username' => getVar("username"), 'password' => getVar("password")));

try {
	$response = new DOMDocument('1.0', 'UTF-8');
	$response->loadHTML($request->send()->getBody());

//	if($response->schemaValidate(FRAMEWORK_PATH."/library/translations/login.xsd")) {

		print $response->saveXML();
		// getElementById doesn't work (works on my 5.3 on mac)
		// use this workaround instead
//		$xpath = new DOMXPath($response);
//		$user_id = $xpath->query("//*[@id='user_id']")->item(0);
//		$nickname = $xpath->query("//*[@id='nickname']")->item(0);

//		if($user_id && $nickname) {

//			Session::setLogin(new Login());
//			Session::getLogin()->doLogin($user_id->nodeValue, $nickname->nodeValue, defined('ADMIN_FRONT') ? ADMIN_FRONT :"/front/index.php");
//		}
//	}
}
catch (HttpException $e) {

	print '<div class="error">'.$e.'</div>';
//	return false;
}

?>