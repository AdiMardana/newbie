<?php

	include "convert.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Kriptografi | BD173</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Geany 0.18" />
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="css/">
		
		<style type="text/css">
			a:link {color: #000000; text-decoration: none}
			a:visited {color: #000000; text-decoration: none}
			a:hover {color: #FF0000; text-decoration: underline}
		</style>
		<script type="text/javascript">
		function SelectAll(id){
			document.getElementById(id).focus();
			document.getElementById(id).select();
		}
		function Info(){
			alert("Tugas UAS Kriptografi :"+'\n\n'+"Ketut Adi Mardana"+'\n'+"170030001"+'\n'+"Source Code : ");
		}
		function InfoCaesar(){
			alert("Key hanya berupa kombinasi angka,"+'\n'+"dan plain text tidak boleh mengandung angka!");
		}
		function InfoVigenere(){
			alert("Key hanya berupa kombinasi kata, tidak boleh mengandung angka,"+'\n'+"dan plain text tidak boleh mengandung angka!");
		}
		function InfoVernam(){
			alert("Key dan plain text boleh berupa kombinasi angat dan kata");
		}
		</script>
	</head>

	<body>
		<center>
			<h2 id="header">
				APLIKASI KRIPTOGRAFI
			</h2>
			<h4 id="header" class="sub">
				<a onclick="Info()">INFO !</a>
			</h4>
		</center>
		<table width="600" align="center" border="3px">
			<tr>
				<td width="50%" valign="top">
					<fieldset>
						<legend>
							<b id="header" class="sub">Caesar Chipper</b>
						</legend>
						<form action="" method="post">
							<input type="text" name="key_caesar" id="key_caesar" class="button" placeholder="The Key..." onclick="SelectAll('key_caesar')" />
							<input type="submit" value="?" onclick="InfoCaesar()" /><br/>
							<textarea rows="4" name="plantext_caesar" id="plantext_caesar" cols="33" onclick="SelectAll('plantext_caesar')" placeholder="Plain Text..."></textarea><br/>
							<input type="submit" id="button" name="encrypt_caesar" value="Encrypt" />
							<input type="submit" id="button" name="decrypt_caesar" value="Decrypt" />
							<input type="reset" id="button" value="Reset" />
						</form>
					</fieldset>
				</td>
				<td valign="top" colspan="3" width="50%">
					<fieldset>
						<legend>
							<b id="header" class="sub">Result</b>
						</legend>
					<?php 
						include("chipper.php");
					 ?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<fieldset>
						<legend>
							<b id="header" class="sub">Vigenere Chipper</b>
						</legend>
						<form action="" method="post">
							<input type="text" name="key_vigenere" id="key_vigenere" class="button" placeholder="The Key..." onclick="SelectAll('key_vigenere')" />
							<input type="submit" value="?" onclick="InfoVigenere()" /><br/>
							<textarea rows="4" name="plantext_vigenere" id="plantext_vigenere" cols="33" onclick="SelectAll('plantext_vigenere')" placeholder="Plain Text..."></textarea><br/>
							<input type="submit" id="button" name="encrypt_vigenere" value="Encrypt" />
							<input type="submit" id="button" name="decrypt_vigenere" value="Decrypt" />
							<input type="reset" id="button" value="Reset" />
						</form>
					</fieldset>
				</td>
			</tr>


			<tr>
				<td valign="top">
					<fieldset>
						<legend>
							<b id="header" class="sub">Vernam Chipper</b>
						</legend>
						<form action="" method="post">
							<input type="text" name="key_vernam" id="key_vernam" class="button" placeholder="The Key..." onclick="SelectAll('key_vernam')" />
							<input type="submit" value="?" onclick="InfoVernam()" /><br/>
							<textarea rows="4" name="plantext_vernam" id="plantext_vernam" cols="33" onclick="SelectAll('plantext_vernam')" placeholder="Plain Text..."></textarea><br/>
							<input type="submit" id="button" name="encrypt_vernam" value="Encrypt" />
							<input type="submit" id="button" name="decrypt_vernam" value="Decrypt" />
							<input type="reset" id="button" value="Reset" />
						</form>
					</fieldset>
				</td>
			</tr>
		</table>
	</body>
</html>