<?php
class Ovo
{
	public $token;

	public static $header;

	public function __construct($token = null)
	{
		if (!file_exists("config.txt")) {
			$fp = fopen("config.txt", "wb");
			if ($fp == false) {
				return;
			} else {
				fwrite($fp, "");
				fclose($fp);
			}
		}
		$files = fopen("config.txt", "rb");
		$this->token = fgets($files);

		// $files = fopen("config.txt","rb");
		// $this->token = fgets($files);
		self::$header = array(
			"Authorization: " . $this->token,
			"App-Version:2.8.*",
			"OS:Android",
			"cs-session-id:CS1560679449275701769",
			"Connection: Keep-Alive",
			"User-Agent:okhttp/3.12.1",
			"Content-type:Application/json"
		);
	}

	public static function get_info_account()
	{
		$x =  Ovo::curl(
			"https://api.ovo.id/wallet/inquiry",
			[
				CURLOPT_HTTPHEADER => self::$header
			]
		);
		return json_decode($x["exec"]);
	}

	public static function get_mutasi_account($data = null)
	{
		if (empty($data)) {
			$limit = 1;
		} else {
			$limit = $data;
		}

		$x =  Ovo::curl(
			"https://api.ovo.id/wallet/v2/transaction?page=1&limit=$limit&productType=001",
			[
				CURLOPT_HTTPHEADER => self::$header
			]
		);
		return json_decode($x["exec"]);
	}



	public static function get_listbank()
	{

		$x =  Ovo::curl(
			"https://api.ovo.id/v1.0/reference/master/ref_bank",
			[
				CURLOPT_HTTPHEADER => self::$header
			]
		);
		return json_decode($x["exec"]);
	}

	public static function trf_to_bank($data = null)
	{
		$x =  Ovo::curl(
			"https://api.ovo.id/transfer/inquiry",
			[
				CURLOPT_HTTPHEADER => self::$header,
				CURLOPT_POSTFIELDS => json_encode($data)
			]
		);

		return json_decode($x["exec"]);
	}

	public static function get_trxid($data = null)
	{
		$x =  Ovo::curl(
			"https://api.ovo.id/v1.0/api/auth/customer/genTrxId",
			[
				CURLOPT_HTTPHEADER => self::$header,
				CURLOPT_POSTFIELDS => json_encode(["actionMark" => $data["jenis"], "amount" => $data["amount"]])
			]
		);
		return json_decode($x["exec"]);
	}

	public static function direct_tf_bank($data = null)
	{
		$x =  Ovo::curl(
			"https://api.ovo.id/transfer/direct",
			[
				CURLOPT_HTTPHEADER => self::$header,
				CURLOPT_POSTFIELDS => json_encode($data)
			]
		);
		return json_decode($x["exec"]);
	}

	public static function trf_to_ovo($data = null)
	{
		$x =  Ovo::curl(
			"https://api.ovo.id/v1.1/api/auth/customer/isOVO",
			[
				CURLOPT_HTTPHEADER => self::$header,
				CURLOPT_POSTFIELDS => json_encode($data)
			]
		);

		return json_decode($x["exec"]);
	}

	public static function direct_tf_ovo($data = null)
	{
		$x =  Ovo::curl(
			"https://api.ovo.id/v1.0/api/customers/transfer",
			[
				CURLOPT_HTTPHEADER => self::$header,
				CURLOPT_POSTFIELDS => json_encode($data)
			]
		);
		return json_decode($x["exec"]);
	}

	public static function login_ovo($data = null, $step = null)
	{
		$array = array(
			"app-id: C7UMRSMFRZ46D9GW9IK7",
			"App-Version:2.13.0",
			"OS:Android",
			"cs-session-id:CS1560679449275701769",
			"Connection: Keep-Alive",
			"User-Agent:okhttp/3.12.1",
			"Content-type:Application/json"
		);
		if ($step == "1") {
			$x =  Ovo::curl(
				"https://api.ovo.id/v2.0/api/auth/customer/login2FA",
				[
					CURLOPT_HTTPHEADER => $array,
					CURLOPT_POSTFIELDS => json_encode($data)
				]
			);
		} else if ($step == "2") {
			$x =  Ovo::curl(
				"https://api.ovo.id/v2.0/api/auth/customer/login2FA/verify",
				[
					CURLOPT_HTTPHEADER => $array,
					CURLOPT_POSTFIELDS => json_encode($data)
				]
			);
		} else if ($step == "3") {
			$x =  Ovo::curl(
				"https://api.ovo.id/v2.0/api/auth/customer/loginSecurityCode/verify",
				[
					CURLOPT_HTTPHEADER => $array,
					CURLOPT_POSTFIELDS => json_encode($data)
				]
			);
		}

		return json_decode($x["exec"]);
	}


	private static function curl($url, $opt = [])
	{
		$ch = curl_init($url);
		$optf = [
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_FOLLOWLOCATION => true
		];
		foreach ($opt as $key => $value) {
			$optf[$key] = $value;
		}
		curl_setopt_array($ch, $optf);
		$out = curl_exec($ch);
		$info = curl_getinfo($ch);
		$error = curl_error($ch);
		$errno = curl_errno($ch);
		curl_close($ch);
		return [
			"exec" => $out,
			"info" => $info,
			"error" => $error,
			"errno" => $errno
		];
	}
}

function random_string($length)
{
	$key = '';
	$keys = array_merge(range(0, 9), range('a', 'z'));

	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $key;
}



function convert_to_array($arrays)
{

	if (is_object($arrays)) {
		$arrays = get_object_vars($arrays);
	}

	if (is_array($arrays)) {
		return array_map(__FUNCTION__, $arrays);
	} else {
		return $arrays;
	}
}
