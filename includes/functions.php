<?php

	function blowFishHash ($ww) {
		$salt = "$2y$14$";
		for ($i = 0; $i < 22; $i++) {
			$salt .= substr("./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1);
		}
		$hash = crypt($ww, $salt);
		return $hash;
	}

	function ww_juist_ingevuld ($wachtwoord) {
		return (bool) preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/", $wachtwoord);
	}

	function inlognaam_juist_ingevuld ($gebruikersnaam) {
		return (bool) preg_match("/^.{6,}$/", $gebruikersnaam);
	}

	function juist_ingevuld ($gebruikersnaam, $wachtwoord) {
		return ww_juist_ingevuld($wachtwoord) 
		&& inlognaam_juist_ingevuld($gebruikersnaam);
	}

	function email_juist_ingevuld ($email) {
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	function straat_juist_ingevuld ($straat) {
		return (bool) preg_match('/[aA-zZ]/', $straat);
	}

	function huisnummer_juist_ingevuld ($huisnummer) {
		return (bool) preg_match('/^[0-9]/', $huisnummer);
	}

	function postcode_juist_ingevuld ($postcode) {
		return (bool) preg_match('/^[0-9]{4}[aA-zZ]{2}$/', $postcode);
	}

	function info_juist_ingevuld ($postcode, $email, $straat, $huisnummer) {
		return email_juist_ingevuld ($email) && straat_juist_ingevuld ($straat) && huisnummer_juist_ingevuld ($huisnummer) &&
		preg_match('/^[0-9]{4}[aA-zZ]{2}$/', $postcode);
	}

	function account_bestaat ($gebruikersnaam, $db) {
		$gebruikersnaam = test_invoer($gebruikersnaam);
		$query 	= "SELECT * FROM gebruiker ";	
		$query .= "WHERE inlognaam = '$gebruikersnaam'";
		$result = $db->query($query);
		return $result->num_rows != 0;
	}

	function test_invoer ($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function registreer ($gebruikersnaam, $wachtwoord, $db) {
		$gebruikersnaam = test_invoer($gebruikersnaam);
		$wachtwoord_hashed = test_invoer(blowFishHash($wachtwoord));
		$query 	= "INSERT INTO gebruiker(inlognaam, wachtwoord) ";
		$query .= "VALUES('$gebruikersnaam', '$wachtwoord_hashed')";
		$db->query($query);

		$query 	= "SELECT id FROM gebruiker ";
		$query .= "WHERE inlognaam = '$gebruikersnaam'";
		$result = $db->query($query);

		while($gebruiker = $result->fetch_object()) {
			$query 	= "INSERT INTO gebruikerinfo(gebruiker_id) ";
			$query .= "VALUES('$gebruiker->id')";
			$db->query($query);
		}
		header('location: redirect.php');
	}

	function login ($gebruikerid, $gebruikersnaam) {
		$_SESSION['gebruiker'] = $gebruikerid;
		$_SESSION['inlognaam'] = $gebruikersnaam;
		header('location: redirect.php');
	}
	
	function is_logged_in () {
		return isset($_SESSION['gebruiker']);
	}

	function get_hashed_wachtwoord ($gebruikersnaam, $db) {
		$gebruikersnaam = test_invoer($gebruikersnaam);
		$query  = "SELECT wachtwoord FROM gebruiker ";
		$query .= "WHERE inlognaam = '$gebruikersnaam'";
		$result = $db->query($query);
		while($gebruiker = $result->fetch_object()){
			return $gebruiker->wachtwoord;

		}
	}

	function wachtwoord_correct ($ww, $gebruikersnaam ,$db) {
		$hashed_ww = get_hashed_wachtwoord($gebruikersnaam, $db);
		return crypt($ww, $hashed_ww) == $hashed_ww;
	}

	function get_gebruikerid ($gebruikersnaam, $db) {
		$gebruikersnaam = test_invoer($gebruikersnaam);
		$query = "SELECT id FROM gebruiker WHERE inlognaam = '$gebruikersnaam'";
		$result = $db->query($query);
		while($gebruiker = $result->fetch_object()){
			return $gebruiker->id;
		}
	}

	function update ($gebruikersnaam, $gebruikerid,  $db) {
		$gebruikersnaam = test_invoer($gebruikersnaam);
		$query 	= "UPDATE gebruiker ";
		$query .= "SET inlognaam = '$gebruikersnaam' ";
		$query .= "WHERE id = '$_SESSION[gebruiker]'";
		$_SESSION['inlognaam'] = $gebruikersnaam;
		$db->query($query);
	}

	function update_info ($email, $straat, $huisnummer, $postcode, $db) {

		$email = test_invoer($email);
		$straat = test_invoer($straat);
		$huisnummer = test_invoer($huisnummer);
		$postcode = test_invoer($postcode);

		$query  = "UPDATE gebruikerinfo ";
		$query .= "SET postcode = '$postcode', email='$email', straat= '$straat', huisnummer='$huisnummer' ";
		$query .= "WHERE gebruiker_id='$_SESSION[gebruiker]'";


		$db->query($query);
	}

	function get_gebruiker_info ($db) {
		$query  = "SELECT inlognaam, wachtwoord, email, straat, huisnummer, postcode ";
		$query .= "FROM gebruikerinfo INNER JOIN gebruiker ";
		$query .= "ON gebruikerinfo.gebruiker_id=gebruiker.id ";
		$query .= "where gebruiker.id='$_SESSION[gebruiker]'";
		$result = $db->query($query);
		while ($gebruiker = $result->fetch_object()) {
			return $gebruiker;
		}
	}

	function update_ww ($ww, $db) {
		$ww = test_invoer(blowFishHash($ww));
		$query 	= "UPDATE gebruiker ";
		$query .= "SET wachtwoord = '$ww' ";
		$query .= "WHERE id = '$_SESSION[gebruiker]'";
		if(!$db->query($query)){
			echo 'now working';
		}
	}