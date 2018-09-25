<?php
session_start();
//require_once 'evlfs.php';

class ZohoApi {

	private $authtoken, $POST_DATA, $url;

	public function __construct() {
		$this -> authtoken = $_SERVER[];
		$this -> url  = "";
	}

	public function initiateData() {
		$gain_str = "";

		if (is_array($_SESSION['gain']) || is_object($_SESSION['gain']))
		{
			foreach ($_SESSION['gain'] as $gain_val) {
				$gain_str .= $gain_val . ', ';
			}
		}
		$gain_str = substr($gain_str, 0, -2);

		$xmldata = '<Leads>
		<row no="1">
		<FL val="Lead Source">Web Download</FL>
		<FL val="Company">'. 		$_SESSION['parent'].'</FL>
		<FL val="Last Name">'. 		$_SESSION['child'].'</FL>
		<FL val="学年">'. 			$_SESSION['grade'].'</FL>
		<FL val="Email">'. 			$_SESSION['email'].'</FL>
		<FL val="Phone">'. 			$_SESSION['phone'].'</FL>
		<FL val="pgkids見学会教室">'.	$_SESSION['learn'].'</FL>
		<FL val="体験会第１希望">'. 	$_SESSION['class'].'</FL>
		<FL val="希望の連絡手段">'. 	$_SESSION['method'].'</FL>
		<FL val="電話希望の時間帯">'.	$_SESSION['time'].'</FL>
		<FL val="期待すること">'. 	$gain_str.'</FL>
		<FL val="ご意見ご要望">'. 	$_SESSION['opinion'].'</FL>
		<FL val="サービス">プログラミングキッズ</FL>
		</row>
		</Leads>';

		$this -> POST_DATA = [
			'newFormat' => 1,
			'authtoken' => $this -> authtoken, 
			'scope'     => crmapi,
			'xmlData'   => $xmldata,
		];
	}

	public function upload() {
		
		$curl = curl_init($this -> url);
		curl_setopt($curl, CURLOPT_POST, 			TRUE);
		curl_setopt($curl, CURLOPT_POSTFIELDS, 		http_build_query($this -> POST_DATA));
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 	FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 	FALSE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 	TRUE);
		curl_setopt($curl, CURLOPT_COOKIEJAR, 		'cookie');
		curl_setopt($curl, CURLOPT_COOKIEFILE, 		'tmp');
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 	TRUE);

		$output = curl_exec($curl);

		return $output;
	}
}
?>
