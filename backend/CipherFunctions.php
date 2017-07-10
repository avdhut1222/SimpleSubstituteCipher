<?php
	class CipherFunctions {

		// constructor
	    function __construct() {
	         
	    }
	 
	    // destructor
	    function __destruct() {

	    }

		public function decrypt($fileName, $cipherKey){
			$output = "";
			$alphabets = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$key = $this->generateKey($cipherKey);
			$file = fopen($fileName, "r") or die("Unable to open file!");
			$fileStr = fread($file,filesize($fileName));
			for($i = 0; $i < strlen($fileStr); $i++){
				if(strpos($key, $fileStr[$i]) !== FALSE){
					$pos = strpos($key, $fileStr[$i]);
					$temp = $alphabets[$pos];
					$output = $output . $temp;
				} else {
					$output = $output . $fileStr[$i];
				}
			}
			fclose($file);
			return $output;
		}

		public function encrypt($fileName, $cipherKey){
			$output = "";
			$alphabets = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$key = $this->generateKey($cipherKey);
			$file = fopen($fileName, "r") or die("Unable to open file!");
			$fileStr = fread($file,filesize($fileName));
			for($i = 0; $i < strlen($fileStr); $i++){
				if(strpos($alphabets, $fileStr[$i]) !== FALSE){
					$pos = strpos($alphabets, $fileStr[$i]);
					$temp = $key[$pos];
					$output = $output . $temp;
				} else {
					$output = $output . $fileStr[$i];
				}
			}
			fclose($file);
			return $output;
		}

		public function generateKey($cipherKey){
			$alphabets = "abcdefghijklmnopqrstuvwxyz";
			if(strlen($cipherKey) > 0){
				$alphabets = strrev($alphabets);
			}
			$key = $cipherKey;
			for($i = 0; $i < strlen($alphabets); $i++){
				if(strpos($cipherKey, $alphabets[$i]) === FALSE){
					$key = $key . $alphabets[$i];
				} else {
					continue;
				}
			}
			$key = $key . strtoupper($key);
			return $key;

		}


	}
?>