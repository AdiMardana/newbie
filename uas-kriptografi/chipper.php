<?php
	//----------------------------------------------------------------//
	// Caesar Chipper												  //
	//----------------------------------------------------------------//
		if((isset($_POST['key_caesar'])) && (isset($_POST['plantext_caesar'])) && isset($_POST['encrypt_caesar'])){
			$key=$_POST['key_caesar'];
			$plantext=$_POST['plantext_caesar'];
			$split_key=str_split($key);
			$i=0;
			$split_chr=str_split($plantext);
			while ($key>52){
				$key=$key-52;
			}
			foreach($split_chr as $chr){
				if (char_to_dec($chr)!=null){
					$split_nmbr[$i]=char_to_dec($chr);
				} else {
					$split_nmbr[$i]=$chr;
				}
				$i++;
			}
			echo '<textarea rows="4" id="result" cols="33"  onclick="SelectAll(\'result\')" >';
			foreach($split_nmbr as $nmbr){
				if (($nmbr+$key)>52){
					if (dec_to_char($nmbr)!=null){
						echo dec_to_char(($nmbr+$key)-52);
					} else {
						echo $nmbr;
					}
				} else {
					if (dec_to_char($nmbr)!=null){
						echo dec_to_char($nmbr+$key);
					} else {
						echo $nmbr;
					}
				}
			}
			echo '</textarea><br/>';
		} else if ((isset($_POST['key_caesar'])) && (isset($_POST['plantext_caesar'])) && isset($_POST['decrypt_caesar'])){
			$key=$_POST['key_caesar'];
			$plantext=$_POST['plantext_caesar'];
			$i=0;
			$split_chr=str_split($plantext);
			while ($key>52){
				$key=$key-52;
			}
			foreach($split_chr as $chr){
				if (char_to_dec($chr)!=null){
					$split_nmbr[$i]=char_to_dec($chr);
				} else {
					$split_nmbr[$i]=$chr;
				}
				$i++;
			}
			echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
			foreach($split_nmbr as $nmbr){
				if (($nmbr-$key)<1){
					if (dec_to_char($nmbr)!=null){
						echo dec_to_char(($nmbr-$key)+52);
					} else {
						echo $nmbr;
					}
				} else {
					if (dec_to_char($nmbr)!=null){
						echo dec_to_char($nmbr-$key);
					} else {
						echo $nmbr;
					}
				}
			}
			echo '</textarea><br/>';
			
	//----------------------------------------------------------------//
	// Vigenere Chipper												  //
	//----------------------------------------------------------------//
		} else if ((isset($_POST['key_vigenere'])) && (isset($_POST['plantext_vigenere'])) && (isset($_POST['encrypt_vigenere']))){
			$key=$_POST['key_vigenere'];
			$plantext=$_POST['plantext_vigenere'];
			$len_key=strlen($key);
			$len_plantext=strlen($plantext);
			$split_key=str_split($key);
			$split_plantext=str_split($plantext);
			
			echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
			$i=0;
			for($j=0;$j<$len_plantext;$j++){
				if ($i==$len_key){
					$i=0;
				}
				$split_key2[$j]=$split_key[$i];
				$i++;
			}
			for($k=0;$k<$len_plantext;$k++){
				$a=char_to_dec($split_key2[$k]);
				$b=char_to_dec($split_plantext[$k]);
				if (($a && $b)!=null){
					echo (tabel_vigenere_encrypt($a, $b));
				} else {
					echo $split_plantext[$k];
				}
			}
			echo '</textarea><br/>';
		} else if ((isset($_POST['key_vigenere'])) && (isset($_POST['plantext_vigenere'])) && (isset($_POST['decrypt_vigenere']))){
			$key=$_POST['key_vigenere'];
			$plantext=$_POST['plantext_vigenere'];
			$len_key=strlen($key);
			$len_plantext=strlen($plantext);
			$split_key=str_split($key);
			$split_plantext=str_split($plantext);
			
			echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
			$i=0;
			for($j=0;$j<$len_plantext;$j++){
				if ($i==$len_key){
					$i=0;
				}
				$split_key2[$j]=$split_key[$i];
				$i++;
			}
			
			for($k=0;$k<$len_plantext;$k++){
				$a=char_to_dec($split_key2[$k]);
				$b=char_to_dec($split_plantext[$k]);
				if (($a && $b)!=null){
					echo (tabel_vigenere_decrypt($b, $a));
				} else {
					echo $split_plantext[$k];
				}
			}
			
			echo '</textarea><br/>';
		//----------------------------------------------------------------//
		// Vernam Chipper												  //
		//----------------------------------------------------------------//

		} else if ((isset($_POST['key_vernam'])) && (isset($_POST['plantext_vernam'])) && (isset($_POST['encrypt_vernam']))) {
			
			$ASCII = [
				"0"=> "[NULL]",
				"1"=> "[SOH]",
				"2"=> "[STX]",
				"3"=> "[ETX]",
				"4"=> "[EOT]",
				"5"=> "[ENQ]",
				"6"=> "[ACK]",
				"7"=> "[BEL]",
				"8"=> "[BS]",
				"9"=> "[TAB]",
				"10"=> "[LF]",
				"11"=> "[VT]",
				"12"=> "[FF]",
				"13"=> "[CR]",
				"14"=> "[SO]",
				"15"=> "[SI]",
				"16"=> "[DLE]",
				"17"=> "[DC1]",
				"18"=> "[DC2]",
				"19"=> "[DC3]",
				"20"=> "[DC4]",
				"21"=> "[NAK]",
				"22"=> "[SYM]",
				"23"=> "[ETB]",
				"24"=> "[CAN]",
				"25"=> "[EM]",
				"26"=> "[SUB]",
				"27"=> "[ESC]",
				"28"=> "[FS]",
				"29"=> "[GS]",
				"30"=> "[RS]",
				"31"=> "[US]",
				"32"=> "[SPACE]",
			];

			$chipper = "";
			$plain   = $_POST['plantext_vernam'];
			$key 	 = $_POST['key_vernam'];

			while (strlen($key) < strlen($plain)) {
				$key .= $key;
			}

			if (strlen($key) > strlen($plain)) {
				$key = substr($key, strlen($plain));
			}

			if (strlen($key) == strlen($plain)) {
				$arrayOfChipperBinary = [];
                $arrayOfKeyBinary = [];
                $arrayOfPlainTextBinary = [];

                for ($i = 0; $i < strlen($plain); $i++) { 
                	$temporaryArrayOfPlainTextBinary  = (string) decbin(ord($plain[$i]));
                	$temporaryArrayOfPlainTextBinary  = str_split($temporaryArrayOfPlainTextBinary);

                	$temporaryArrayOfKeyTextBinary    = (string) decbin(ord($key[$i]));
                	$temporaryArrayOfKeyTextBinary    = str_split($temporaryArrayOfKeyTextBinary);
                	// var_dump(count((array) $temporaryArrayOfPlainTextBinary) < 8);
                	// return;

                	while (count((array) $temporaryArrayOfPlainTextBinary) < 8) {
                		array_unshift($temporaryArrayOfPlainTextBinary, "0");
                	}

                	while (count((array) $temporaryArrayOfKeyTextBinary) < 8) {
                		array_unshift($temporaryArrayOfKeyTextBinary, "0");
                	}

                	$arrayOfPlainTextBinary = count($arrayOfPlainTextBinary) == 0 ? $temporaryArrayOfPlainTextBinary : array_merge($arrayOfPlainTextBinary, $temporaryArrayOfPlainTextBinary);
                	$arrayOfKeyBinary       = count($arrayOfKeyBinary) == 0 ? $temporaryArrayOfKeyTextBinary : array_merge($arrayOfKeyBinary, $temporaryArrayOfKeyTextBinary);
                }

                if (count($arrayOfPlainTextBinary) == count($arrayOfKeyBinary)) {
                	for ($i = 0; $i < count($arrayOfPlainTextBinary); $i++) { 
                		$xor = (int) $arrayOfPlainTextBinary[$i] ^ (int) $arrayOfKeyBinary[$i];
                		array_push($arrayOfChipperBinary, $xor);
                	}

                	$arrayOfChipperIndex  = [];
                	$arrayOfChipperBinary = join("", $arrayOfChipperBinary);

                	for ($i = 0; $i < strlen($arrayOfChipperBinary); $i += 8) { 
                		$t = substr($arrayOfChipperBinary, $i, 8);
                		array_push($arrayOfChipperIndex, bindec($t));
                	}

                	for ($i = 0; $i < count($arrayOfChipperIndex); $i++) { 
                		if ((int) $arrayOfChipperIndex[$i] < count((array) $ASCII)) {
                			$chipper .= $ASCII[$arrayOfChipperIndex[$i]];
                		} else {
                			$chipper .= chr($arrayOfChipperIndex[$i]);
                		}
                	}
                	echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';

                	echo $chipper;
					echo '</textarea><br/>';
                }
			}

		}
		elseif ((isset($_POST['key_vernam'])) && (isset($_POST['plantext_vernam'])) && (isset($_POST['decrypt_vernam']))) {
			$ASCII = [
				"0"=> "[NULL]",
				"1"=> "[SOH]",
				"2"=> "[STX]",
				"3"=> "[ETX]",
				"4"=> "[EOT]",
				"5"=> "[ENQ]",
				"6"=> "[ACK]",
				"7"=> "[BEL]",
				"8"=> "[BS]",
				"9"=> "[TAB]",
				"10"=> "[LF]",
				"11"=> "[VT]",
				"12"=> "[FF]",
				"13"=> "[CR]",
				"14"=> "[SO]",
				"15"=> "[SI]",
				"16"=> "[DLE]",
				"17"=> "[DC1]",
				"18"=> "[DC2]",
				"19"=> "[DC3]",
				"20"=> "[DC4]",
				"21"=> "[NAK]",
				"22"=> "[SYM]",
				"23"=> "[ETB]",
				"24"=> "[CAN]",
				"25"=> "[EM]",
				"26"=> "[SUB]",
				"27"=> "[ESC]",
				"28"=> "[FS]",
				"29"=> "[GS]",
				"30"=> "[RS]",
				"31"=> "[US]",
				"32"=> "[SPACE]",
			];

			$chipper = "";
			$plain   = $_POST['plantext_vernam'];
			$key 	 = $_POST['key_vernam'];

			while (strlen($key) < strlen($plain)) {
				$key .= $key;
			}

			if (strlen($key) > strlen($plain)) {
				$key = substr($key, strlen($plain));
			}

			if (strlen($key) == strlen($plain)) {
				$arrayOfChipperBinary = [];
                $arrayOfKeyBinary = [];
                $arrayOfPlainTextBinary = [];

                for ($i = 0; $i < strlen($plain); $i++) { 
                	$temporaryArrayOfPlainTextBinary  = (string) decbin(ord($plain[$i]));
                	$temporaryArrayOfPlainTextBinary  = str_split($temporaryArrayOfPlainTextBinary);

                	$temporaryArrayOfKeyTextBinary    = (string) decbin(ord($key[$i]));
                	$temporaryArrayOfKeyTextBinary    = str_split($temporaryArrayOfKeyTextBinary);
                	// var_dump(count((array) $temporaryArrayOfPlainTextBinary) < 8);
                	// return;

                	while (count((array) $temporaryArrayOfPlainTextBinary) < 8) {
                		array_unshift($temporaryArrayOfPlainTextBinary, "0");
                	}

                	while (count((array) $temporaryArrayOfKeyTextBinary) < 8) {
                		array_unshift($temporaryArrayOfKeyTextBinary, "0");
                	}

                	$arrayOfPlainTextBinary = count($arrayOfPlainTextBinary) == 0 ? $temporaryArrayOfPlainTextBinary : array_merge($arrayOfPlainTextBinary, $temporaryArrayOfPlainTextBinary);
                	$arrayOfKeyBinary       = count($arrayOfKeyBinary) == 0 ? $temporaryArrayOfKeyTextBinary : array_merge($arrayOfKeyBinary, $temporaryArrayOfKeyTextBinary);
                }

                if (count($arrayOfPlainTextBinary) == count($arrayOfKeyBinary)) {
                	for ($i = 0; $i < count($arrayOfPlainTextBinary); $i++) { 
                		$xor = (int) $arrayOfPlainTextBinary[$i] ^ (int) $arrayOfKeyBinary[$i];
                		array_push($arrayOfChipperBinary, $xor);
                	}

                	$arrayOfChipperIndex  = [];
                	$arrayOfChipperBinary = join("", $arrayOfChipperBinary);

                	for ($i = 0; $i < strlen($arrayOfChipperBinary); $i += 8) { 
                		$t = substr($arrayOfChipperBinary, $i, 8);
                		array_push($arrayOfChipperIndex, bindec($t));
                	}

                	for ($i = 0; $i < count($arrayOfChipperIndex); $i++) { 
                		if ((int) $arrayOfChipperIndex[$i] < count((array) $ASCII)) {
                			$chipper .= $ASCII[$arrayOfChipperIndex[$i]] ."---";
                		} else {
                			$chipper .= chr($arrayOfChipperIndex[$i]);
                		}
                	}
                	echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';

                	echo $chipper;
					echo '</textarea><br/>';
                }
			}
		}
		else {
			echo "Result Here...";
		}
	?>