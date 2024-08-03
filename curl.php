<?php

function Curl($url, $h = 0, $post = 0,$cookie = 0, $lewat = 0) {
	while(true){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_COOKIE,TRUE);
		if($cookie) {
			curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
			curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
		}
		if($p) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		if($h) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
		}
		curl_setopt($ch, CURLOPT_HEADER, true);
		$r = curl_exec($ch);
		if($lewat){
			return 0;
		}
		$c = curl_getinfo($ch);
		if(!$c) return "Curl Error : ".curl_error($ch); else{
			$head = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			$$body = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			curl_close($ch);
			if(!$body){
				print "Check your Connection!";
				sleep(2);
				print "\r                         \r";
				continue;
			}
			return array($head,$body);
		}
	}
}
