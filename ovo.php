<?php
Class Ovo{
	public $token;
	
	public static $header;
	
	public function __construct($token = null){
		$files = fopen("config.txt","rb");
		$this->token = fgets($files);
	    self::$header = array(
			"Authorization: ".$this->token,
			"App-Version:2.8.*",		
			"OS:Android",
			"cs-session-id:CS1560679449275701769",
			"Connection: Keep-Alive",
			"User-Agent:okhttp/3.12.1",
			"Content-type:Application/json"
		);
	}
			
	public static function get_info_account(){
		$x =  Ovo::curl("https://api.ovo.id/wallet/inquiry",[
			CURLOPT_HTTPHEADER=>self::$header]
		);
		return json_decode($x["exec"]);
	}
	
	public static function get_mutasi_account($data = null){
		if(empty($data)){
			$limit = 1;
		}else{
			$limit = $data;
		}
		
		$x =  Ovo::curl("https://api.ovo.id/wallet/v2/transaction?page=1&limit=$limit&productType=001",[
			CURLOPT_HTTPHEADER=>self::$header]
		);
		return json_decode($x["exec"]);
	}
	
	
	
	public static function get_listbank(){
		
		$x =  Ovo::curl("https://api.ovo.id/v1.0/reference/master/ref_bank",[
					CURLOPT_HTTPHEADER=>self::$header]
		);
		return json_decode($x["exec"]);
	}
	
	public static function trf_to_bank($data= null){
		$x =  Ovo::curl("https://api.ovo.id/transfer/inquiry",[
					CURLOPT_HTTPHEADER =>self::$header,
					CURLOPT_POSTFIELDS => json_encode($data)
					]
		);
		
		return json_decode($x["exec"]);
	}
	
	public static function get_trxid($data = null){
		$x =  Ovo::curl("https://api.ovo.id/v1.0/api/auth/customer/genTrxId",[
					CURLOPT_HTTPHEADER =>self::$header,
					CURLOPT_POSTFIELDS => json_encode(["actionMark"=>$data["jenis"],"amount"=>$data["amount"]])
					]
		);
		return json_decode($x["exec"]);
	}
	
	public static function direct_tf_bank($data = null){
		$x =  Ovo::curl("https://api.ovo.id/transfer/direct",[
					CURLOPT_HTTPHEADER =>self::$header,
					CURLOPT_POSTFIELDS => json_encode($data)
					]
		);
		return json_decode($x["exec"]);
	}
	
	public static function trf_to_ovo($data = null){
		$x =  Ovo::curl("https://api.ovo.id/v1.1/api/auth/customer/isOVO",[
					CURLOPT_HTTPHEADER =>self::$header,
					CURLOPT_POSTFIELDS => json_encode($data)
					]
		);
		
		return json_decode($x["exec"]);
	}
	
	public static function direct_tf_ovo($data = null){
		$x =  Ovo::curl("https://api.ovo.id/v1.0/api/customers/transfer",[
					CURLOPT_HTTPHEADER =>self::$header,
					CURLOPT_POSTFIELDS => json_encode($data)
					]
		);
		return json_decode($x["exec"]);
	}
	
	public static function login_ovo($data = null,$step = null){
			$array = array(
				"app-id: C7UMRSMFRZ46D9GW9IK7",
				"App-Version:2.13.0",		
				"OS:Android",
				"cs-session-id:CS1560679449275701769",
				"Connection: Keep-Alive",
				"User-Agent:okhttp/3.12.1",
				"Content-type:Application/json"
				); 
		if($step == "1"){
			$x =  Ovo::curl("https://api.ovo.id/v2.0/api/auth/customer/login2FA",[			
						CURLOPT_HTTPHEADER =>$array,
						CURLOPT_POSTFIELDS => json_encode($data)
						]
			);
		}else if($step == "2"){
			$x =  Ovo::curl("https://api.ovo.id/v2.0/api/auth/customer/login2FA/verify",[
						CURLOPT_HTTPHEADER =>$array,
						CURLOPT_POSTFIELDS => json_encode($data)
						]
			);
		}else if($step == "3"){
			$x =  Ovo::curl("https://api.ovo.id/v2.0/api/auth/customer/loginSecurityCode/verify",[
						CURLOPT_HTTPHEADER => $array,
						CURLOPT_POSTFIELDS => json_encode($data)
						]
			);
		}
		
		return json_decode($x["exec"]);
	}
	
	
	private static function curl($url, $opt = []){	
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

	function random_string($length) {
		$key = '';
		$keys = array_merge(range(0, 9), range('a', 'z'));

		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}

    	return $key;
	}



	function convert_to_array($arrays){
		
		if (is_object($arrays)) {
			$arrays = get_object_vars($arrays);
		}

		if (is_array($arrays)) {
			return array_map(__FUNCTION__, $arrays);
		} else {
			return $arrays;
		}

	}
	



print("##############################################".PHP_EOL);
print("|       Creator Muhammad Ezha Syafaat     	|".PHP_EOL);
print("|              Script API OVO                |".PHP_EOL);
print("|           Contact : 08990081081            |".PHP_EOL);
print("##############################################".PHP_EOL);

print("=> 1 = Profile akun ovo.".PHP_EOL);
print("=> 2 = Cek Mutasi akun ovo.".PHP_EOL);
print("=> 3 = Transfer ovo to bank.".PHP_EOL);
print("=> 4 = Transfer ovo to ovo.".PHP_EOL);
print("=> 5 = Login ovo.").PHP_EOL;
print("Loading..              ".PHP_EOL);
sleep(3);
if(file_exists("config.txt")){
	$file = fopen("config.txt","rb");
	if(empty(fgets($file))){
		echo ("Mohon perbarui signature token.\n");
	}
	fclose($file);
}




		$p = new Ovo;
		print("Chose number : ");
		$aksi = fgets(STDIN);
		if(trim($aksi) == "1"){
			$data = convert_to_array($p->get_info_account()->data);
		
			print("################ INFORMASI #####################").PHP_EOL;
			echo "Norek OVO CASH : ".$data['001']['card_no'].PHP_EOL;
			echo "Norek OVO POIN : ".$data['600']['card_no'].PHP_EOL;
			echo "Balance OVO CASH : Rp ".number_format($data['001']['card_balance'],0,",",".").PHP_EOL;
			echo "Balance OVO POIN : Rp ".number_format($data['600']['card_balance'],0,",",".").PHP_EOL;
			print("################ INFORMASI #####################").PHP_EOL;
		}else if(trim($aksi) == "2"){
			print("Jumlah mutasi yang ingin dilihat? ");
			$jumlah_data = fgets(STDIN);
			$data = $p->get_mutasi_account(trim($jumlah_data))->data;
			$array = $data["0"]->complete;
			
			foreach($array as $key => $value){
				echo "-------------------------------------------".PHP_EOL;
				if($value->transaction_type == "FINANCIAL" || $value->transaction_type == "VOID"){
					echo "ID Transaction : ".$value->merchant_invoice."".PHP_EOL;
					echo "Merchant Name : ".$value->merchant_name."".PHP_EOL;
					echo "Date : ".$value->transaction_date." & ".$value->transaction_time."".PHP_EOL;
					echo "Amount : ".$value->transaction_amount."".PHP_EOL;
				}else if($value->transaction_type == "INCOMING TRANSFER"){
					echo "ID Transaction : ".$value->merchant_invoice."".PHP_EOL;
					echo "Deskripsi : ".$value->desc1."".PHP_EOL;
					echo "Date : ".$value->transaction_date." & ".$value->transaction_time."".PHP_EOL;
					echo "Amount : ".$value->transaction_amount."".PHP_EOL;
					echo "Category : ".$value->desc2."".PHP_EOL;
				}else if($value->transaction_type == "EXTERNAL TRANSFER"){
					echo "ID Transaction : ".$value->merchant_invoice."".PHP_EOL;
					echo "Deskripsi : ".trim($value->desc1)." / ".$value->desc3."".PHP_EOL;
					echo "Date : ".$value->transaction_date." & ".$value->transaction_time."".PHP_EOL;
					echo "Amount : ".$value->transaction_amount."".PHP_EOL;
					echo "Category : ".$value->desc2."".PHP_EOL;
				}else if($value->transaction_type == "TRANSFER"){
					echo "ID Transaction : ".$value->merchant_invoice."".PHP_EOL;
					echo "Deskripsi : ".trim($value->desc2)." / ".$value->desc1."".PHP_EOL;
					echo "Date : ".$value->transaction_date." & ".$value->transaction_time."".PHP_EOL;
					echo "Amount : ".$value->transaction_amount."".PHP_EOL;
					echo "Category : ".$value->desc2."".PHP_EOL;
				}else{
					echo "ID Transaction : ".$value->merchant_invoice."".PHP_EOL;
					echo "Deskripsi : ".trim($value->desc2)." / ".$value->desc1."".PHP_EOL;
					echo "Date : ".$value->transaction_date." & ".$value->transaction_time."".PHP_EOL;
					echo "Amount : ".$value->transaction_amount."".PHP_EOL;
					echo "Category : ".$value->desc2."".PHP_EOL;
				}
			}
		}else if(trim($aksi) == "3"){
			$databank = [];
			$list_bank = $p->get_listbank()->bankTypes;
	
			foreach($list_bank as $key => $val){
				
				echo $val->id." > ".$val->name."".PHP_EOL;
			}
			print("Select bank: ");
			$bank = fgets(STDIN);
			foreach($list_bank as $key => $val){
				if($val->id == $bank){
					$databank[] = ["value"=>$val->value,"name"=>$val->name];
				}
			}
			
			if(empty($databank)){
				exit("Silahkan pilih bank dengan benar.");
			}
			
			print("No Rekening Tujuan : ");
			$rekening = fgets(STDIN);
			print("Jumlah Transfer : ");
			$nominal = fgets(STDIN);
			if($nominal < 10000){
				exit("Nominal transfer minimal 10000");
			}
			print("Pesan : ");
			$pesan = fgets(STDIN);
			
			$postdata1 = ["accountNo"=>trim($rekening),"amount"=>trim($nominal),"bankCode"=>trim($databank["0"]["value"]),"bankName"=>trim($databank["0"]["name"]),"message"=>trim($pesan)];
			$trx = $p->trf_to_bank($postdata1);
			
			if(isset($trx->status)){
				exit($trx->message);
			}else{
			echo "".PHP_EOL;
			print("########## Invoice Transaction ##########".PHP_EOL);
			echo "Bank  : ".$trx->bankName."".PHP_EOL;
			echo "Name : ".$trx->accountName."".PHP_EOL;
			echo "Rekenenig : ".$trx->accountNo."".PHP_EOL;
			echo "Amount : ".$trx->amount."".PHP_EOL;
			echo "Fee admin : ".$trx->adminFee."".PHP_EOL;
			echo "".PHP_EOL;
			}
			print("Are you sure you want to transfer? (Y/N)?");
			$alert = fgets(STDIN);
			if(trim($alert) == "Y" || trim($alert) == "y"){
				$jml = ["jenis"=>"trf_other_bank","amount"=>$postdata1["amount"]];
				$trxid = $p->get_trxid($jml)->trxId;
				$account = convert_to_array($p->get_info_account()->data);
				$param = [
					  "accountName"=>trim($trx->accountName),
					  "accountNo"=>$account['001']['card_no'],
					  "accountNoDestination"=>trim($rekening),
					  "amount"=>trim($nominal),
					  "bankCode"=>trim($databank["0"]["value"]),
					  "bankName"=>trim($databank["0"]["name"]),
					  "message"=>trim($pesan),
					  "notes"=>trim($pesan),
					  "transactionId"=>$trxid
				];
				
				 
				$result = $p->direct_tf_bank($param);
				print_r($result);
			}else{
				exit("Canceled transaction");
			}
			
			
		}else if(trim($aksi) == "4"){
			print("Nomer ovo tujuan : ");
			$nomer = fgets(STDIN);
			print("Jumlah Transfer : ");
			$nominal = fgets(STDIN);
			if($nominal < 10000){
				exit("Nominal transfer minimal 10000");
			}
			print("Pesan : ");
			$pesan = fgets(STDIN);
			$postdata2 = ["totalAmount"=>trim($nominal),"mobile"=>trim($nomer)];
			$trx = $p->trf_to_ovo($postdata2);
			if(isset($trx->status)){
				exit($trx->message);
			}else{
			echo "".PHP_EOL;
			print("########## Invoice Transaction ##########".PHP_EOL);
			echo "Nama : ".$trx->fullName."".PHP_EOL;
			echo "Username : ".$trx->nickName."".PHP_EOL;
			echo "Nomer : ".$trx->mobile."".PHP_EOL;
			echo "".PHP_EOL;
			}
			print("Apakah anda yakin akan mentransfer (Y/N)?");
			$alert = fgets(STDIN);
			if(trim($alert) == "Y" || trim($alert) == "y"){
				$jml = ["jenis"=>"trf_ovo","amount"=>$postdata2["totalAmount"]];
				$trxid = $p->get_trxid($jml)->trxId;
				$param = [
					  "amount"=>trim($nominal),
					  "message"=>trim($pesan),
					  "to"=>trim($nomer),
					  "trxId"=>$trxid
				];
				$result = $p->direct_tf_ovo($param);
				print_r($result);
			}else{
				exit("Transaksi dibatalkan");
			}
			
		}else if(trim($aksi) == "5"){
							print("Nomor ovo anda : ");
							$nomer = fgets(STDIN);
							$rand = "6cd799d5-8979-3139-96db-".random_string(12);
							$sendCode = $p->login_ovo(['deviceId'=>$rand,'mobile'=>trim($nomer)],1)->refId;
							print("Masukkan kode OTP: ");
							$kode = fgets(STDIN);
							$array =
							[
							  "appVersion"=>"2.13.0",
							  "deviceId"=>$rand,
							  "macAddress"=>"00:CE:0A:ED:BF:BD",
							  "mobile"=>trim($nomer),
							  "osName"=>"android",
							  "osVersion"=>"7.1.2",
							  "pushNotificationId"=>"FCM|dOJkIbwZgbQ:APA91bGBWD1m3UGmcdQmeDMM4S_lFx3I2CyigmnE4vSjagq6Kg2qXBi4ZzWi-CMVrXv2YkmU_0rgW699b04a2msnoyQ-vVqsWGXUDZiSVATiQQ2WvPcVgLF2LdgJ4KTDwWZqxEPZoafM",
							  "refId"=>$sendCode,
							  "verificationCode"=>trim($kode)
							];
							$verify = $p->login_ovo($array,2);
							
							if(isset($verify->code)){
								return die($verify->message);
							}
							print("Masukkan Security PIN anda : ");
							$pin = fgets(STDIN);
							$verifyPin = $p->login_ovo(["deviceUnixtime"=>strtotime(date("Y-m-d H:i:s")),
										"securityCode"=> trim($pin),
										"updateAccessToken"=>$verify->updateAccessToken],3);
							if(isset($verifyPin->token)){
								
								$file = fopen("config.txt","w");
								$write = fwrite($file,$verifyPin->token);
								fclose($file);
								
								die("Berhasil Login.".PHP_EOL);
							}else{
								return die("Sistem Error.");
							}
							
		}else{
			die("Nomor salah!");
		}
		print("Continued (Y/N) ? ");

		$lanjut = trim(fgets(STDIN));	
		
		if($lanjut == "Y" || $lanjut == "y"){
				$yes = false;
				while(!$yes){
					print("Pilih aksi nomer : ");
					$aksi = fgets(STDIN);
		if(trim($aksi) == "1"){
			$data = convert_to_array($p->get_info_account()->data);
		
			print("################ INFORMASI #####################").PHP_EOL;
			echo "Norek OVO CASH : ".$data['001']['card_no'].PHP_EOL;
			echo "Norek OVO POIN : ".$data['600']['card_no'].PHP_EOL;
			echo "Balance OVO CASH : Rp ".number_format($data['001']['card_balance'],0,",",".").PHP_EOL;
			echo "Balance OVO POIN : Rp ".number_format($data['600']['card_balance'],0,",",".").PHP_EOL;
			print("################ INFORMASI #####################").PHP_EOL;
		}else if(trim($aksi) == "2"){
			print("Jumlah mutasi yang ingin dilihat? ");
			$jumlah_data = fgets(STDIN);
			$data = $p->get_mutasi_account(trim($jumlah_data))->data;
			$array = $data["0"]->complete;
			
			foreach($array as $key => $value){
				echo "-------------------------------------------".PHP_EOL;
				if($value->transaction_type == "FINANCIAL" || $value->transaction_type == "VOID"){
					echo "ID Transaction : ".$value->merchant_invoice."".PHP_EOL;
					echo "Merchant Name : ".$value->merchant_name."".PHP_EOL;
					echo "Date : ".$value->transaction_date." & ".$value->transaction_time."".PHP_EOL;
					echo "Amount : ".$value->transaction_amount."".PHP_EOL;
				}else if($value->transaction_type == "INCOMING TRANSFER"){
					echo "ID Transaction : ".$value->merchant_invoice."".PHP_EOL;
					echo "Deskripsi : ".$value->desc1."".PHP_EOL;
					echo "Date : ".$value->transaction_date." & ".$value->transaction_time."".PHP_EOL;
					echo "Amount : ".$value->transaction_amount."".PHP_EOL;
					echo "Category : ".$value->desc2."".PHP_EOL;
				}else if($value->transaction_type == "EXTERNAL TRANSFER"){
					echo "ID Transaction : ".$value->merchant_invoice."".PHP_EOL;
					echo "Deskripsi : ".trim($value->desc1)." / ".$value->desc3."".PHP_EOL;
					echo "Date : ".$value->transaction_date." & ".$value->transaction_time."".PHP_EOL;
					echo "Amount : ".$value->transaction_amount."".PHP_EOL;
					echo "Category : ".$value->desc2."".PHP_EOL;
				}else if($value->transaction_type == "TRANSFER"){
					echo "ID Transaction : ".$value->merchant_invoice."".PHP_EOL;
					echo "Deskripsi : ".trim($value->desc2)." / ".$value->desc1."".PHP_EOL;
					echo "Date : ".$value->transaction_date." & ".$value->transaction_time."".PHP_EOL;
					echo "Amount : ".$value->transaction_amount."".PHP_EOL;
					echo "Category : ".$value->desc2."".PHP_EOL;
				}else{
					echo "ID Transaction : ".$value->merchant_invoice."".PHP_EOL;
					echo "Deskripsi : ".trim($value->desc2)." / ".$value->desc1."".PHP_EOL;
					echo "Date : ".$value->transaction_date." & ".$value->transaction_time."".PHP_EOL;
					echo "Amount : ".$value->transaction_amount."".PHP_EOL;
					echo "Category : ".$value->desc2."".PHP_EOL;
				}
			}
		}else if(trim($aksi) == "3"){
			$databank = [];
			$list_bank = $p->get_listbank()->bankTypes;
	
			foreach($list_bank as $key => $val){
				
				echo $val->id." > ".$val->name."".PHP_EOL;
			}
			print("Select bank: ");
			$bank = fgets(STDIN);
			foreach($list_bank as $key => $val){
				if($val->id == $bank){
					$databank[] = ["value"=>$val->value,"name"=>$val->name];
				}
			}
			
			if(empty($databank)){
				exit("Silahkan pilih bank dengan benar.");
			}
			
			print("No Rekening Tujuan : ");
			$rekening = fgets(STDIN);
			print("Jumlah Transfer : ");
			$nominal = fgets(STDIN);
			if($nominal < 10000){
				exit("Nominal transfer minimal 10000");
			}
			print("Pesan : ");
			$pesan = fgets(STDIN);
			
			
			
			
			$postdata1 = ["accountNo"=>trim($rekening),"amount"=>trim($nominal),"bankCode"=>trim($databank["0"]["value"]),"bankName"=>trim($databank["0"]["name"]),"message"=>trim($pesan)];
			$trx = $p->trf_to_bank($postdata1);
			
			if(isset($trx->status)){
				exit($trx->message);
			}else{
			echo "".PHP_EOL;
			print("########## Invoice Transaction ##########".PHP_EOL);
			echo "Bank  : ".$trx->bankName."".PHP_EOL;
			echo "Name : ".$trx->accountName."".PHP_EOL;
			echo "Rekenenig : ".$trx->accountNo."".PHP_EOL;
			echo "Amount : ".$trx->amount."".PHP_EOL;
			echo "Fee admin : ".$trx->adminFee."".PHP_EOL;
			echo "".PHP_EOL;
			}
			print("Are you sure you want to transfer? (Y/N)?");
			$alert = fgets(STDIN);
			if(trim($alert) == "Y" || trim($alert) == "y"){
				$jml = ["jenis"=>"trf_other_bank","amount"=>$postdata1["amount"]];
				$trxid = $p->get_trxid($jml)->trxId;
				$account = convert_to_array($p->get_info_account()->data);
				$param = [
					  "accountName"=>trim($trx->accountName),
					  "accountNo"=>$account['001']['card_no'],
					  "accountNoDestination"=>trim($rekening),
					  "amount"=>trim($nominal),
					  "bankCode"=>trim($databank["0"]["value"]),
					  "bankName"=>trim($databank["0"]["name"]),
					  "message"=>trim($pesan),
					  "notes"=>trim($pesan),
					  "transactionId"=>$trxid
				];
				
				 
				$result = $p->direct_tf_bank($param);
				print_r($result);
			}else{
				exit("Canceled transaction");
			}
			
			
		}else if(trim($aksi) == "4"){
			print("Nomer ovo tujuan : ");
			$nomer = fgets(STDIN);
			print("Jumlah Transfer : ");
			$nominal = fgets(STDIN);
			if($nominal < 10000){
				exit("Nominal transfer minimal 10000");
			}
			print("Pesan : ");
			$pesan = fgets(STDIN);
			$postdata2 = ["totalAmount"=>trim($nominal),"mobile"=>trim($nomer)];
			$trx = $p->trf_to_ovo($postdata2);
			if(isset($trx->status)){
				exit($trx->message);
			}else{
			echo "".PHP_EOL;
			print("########## Invoice Transaction ##########".PHP_EOL);
			echo "Nama : ".$trx->fullName."".PHP_EOL;
			echo "Username : ".$trx->nickName."".PHP_EOL;
			echo "Nomer : ".$trx->mobile."".PHP_EOL;
			echo "".PHP_EOL;
			}
			print("Apakah anda yakin akan mentransfer (Y/N)?");
			$alert = fgets(STDIN);
			if(trim($alert) == "Y" || trim($alert) == "y"){
				$jml = ["jenis"=>"trf_ovo","amount"=>$postdata2["totalAmount"]];
				$trxid = $p->get_trxid($jml)->trxId;
				$param = [
					  "amount"=>trim($nominal),
					  "message"=>trim($pesan),
					  "to"=>trim($nomer),
					  "trxId"=>$trxid
				];
				$result = $p->direct_tf_ovo($param);
				print_r($result);
			}else{
				exit("Transaksi dibatalkan");
			}
			
		}else if(trim($aksi) == "5"){
							print("Nomor ovo anda : ");
							$nomer = fgets(STDIN);
							$rand = "6cd799d5-8979-3139-96db-".random_string(12);
							$sendCode = $p->login_ovo(['deviceId'=>$rand,'mobile'=>trim($nomer)],1)->refId;
							print("Masukkan kode OTP: ");
							$kode = fgets(STDIN);
							$array =
							[
							  "appVersion"=>"2.13.0",
							  "deviceId"=>$rand,
							  "macAddress"=>"00:CE:0A:ED:BF:BD",
							  "mobile"=>trim($nomer),
							  "osName"=>"android",
							  "osVersion"=>"7.1.2",
							  "pushNotificationId"=>"FCM|dOJkIbwZgbQ:APA91bGBWD1m3UGmcdQmeDMM4S_lFx3I2CyigmnE4vSjagq6Kg2qXBi4ZzWi-CMVrXv2YkmU_0rgW699b04a2msnoyQ-vVqsWGXUDZiSVATiQQ2WvPcVgLF2LdgJ4KTDwWZqxEPZoafM",
							  "refId"=>$sendCode,
							  "verificationCode"=>trim($kode)
							];
							$verify = $p->login_ovo($array,2);
							
							if(isset($verify->code)){
								return die($verify->message);
							}
							print("Masukkan Security PIN anda : ");
							$pin = fgets(STDIN);
							$verifyPin = $p->login_ovo(["deviceUnixtime"=>strtotime(date("Y-m-d H:i:s")),
										"securityCode"=> trim($pin),
										"updateAccessToken"=>$verify->updateAccessToken],3);
							if(isset($verifyPin->token)){
								
								$file = fopen("config.txt","w");
								$write = fwrite($file,$verifyPin->token);
								fclose($file);
								
								die("Berhasil Login.".PHP_EOL);
							}else{
								return die("Sistem Error.");
							}
							
		}else{
			die("Nomor salah!");
		}
					
				}
						
					
				
		
		}else{
			exit("Perintah diakhiri.");
		} 



		
		

