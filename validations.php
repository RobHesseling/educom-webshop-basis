<?php
function validateContact()
{
  $naam_input = $_POST['naam'];
  $email_input = $_POST['email'];
  $telefoonnummer_input = $_POST['telefoonnummer'];
  $formIsCorrect = true;

  if (!preg_match("/^[a-zA-Z-' ]*$/", $naam_input)) {
    $naam_err = '<span style="color:red;">Gebruik alleen letters en spaties!</span>';
    $formIsCorrect = false;
  } else {
    $naam_err = '';
  }

  if (!filter_var($email_input, FILTER_VALIDATE_EMAIL)) {
    $email_err = '<span style="color:red;">Voer een geldig mailadres in!</span>';
    $formIsCorrect = false;
  } else {
    $email_err = '';
  }

  $validateTel = is_numeric($telefoonnummer_input);
  if (!$validateTel == true || strlen($telefoonnummer_input) < 10 || strlen($telefoonnummer_input) > 10) {
    $tel_err = '<span style="color:red;">Voer een geldig telefoonnummer in! (Bijv; "0612345678")</span>';
    $formIsCorrect = false;
  } else {
    $tel_err = '';
  }


  if (isset($_POST['bericht'])) {
    $bericht =  htmlentities($_POST['bericht']);
  }

  $validateBericht = str_replace(' ', '', $bericht);
  $berichtLen = strlen($validateBericht);

  if ($berichtLen < 10) {
    $bericht_err = '<span style="color:red;">Minimaal 10 karakters!</span>';
    $formIsCorrect = false;
  } else {
    $bericht_err = '';
  }

  $errors = array('', $naam_err, $email_err, $tel_err, $bericht_err, $formIsCorrect);
  if (!$formIsCorrect) {
    $contactValidation = array('contact', $errors, count($errors));
  } else {
    $contactValidation = array('bedankt', $errors, count($errors));
  }
  return $contactValidation;
}
//============================================
function validateLogin()
{
  $email_input = $_POST['email'];
  $wachtwoord_input = $_POST['wachtwoord'];

  $myfile = fopen("Users/users.txt", "r");
  while (!feof($myfile)) {
    $line = fgets($myfile);
    if (str_contains($line, $email_input) && str_contains($line, $wachtwoord_input)) {
      $fileArray = explode("|", $line);

      $userInfo = array("userEmail" => $fileArray[0], "userName" => $fileArray[1]);
      $_SESSION["userInfo"] = $userInfo;
      print_r($_SESSION);
      $errors = array('');
      $login_validation = array("home", $errors, count($errors));
      break;
    } else {
      $errors = array('<span style="color:red;">Email-wachtwoord combinatie bestaat niet!</span>');
      $login_validation = array("login", $errors, count($errors));
    }
  }
  fclose($myfile);
  return $login_validation;
}
//============================================
function validateRegister()
{
  $naam_input = $_POST['naam'];
  $email_input = $_POST['email'];
  $wachtwoord_input = $_POST['wachtwoord'];
  $herhaalwachtwoord_input = $_POST['herhaalwachtwoord'];
  $formIsCorrect = true;


  if (!preg_match("/^[a-zA-Z-' ]*$/", $naam_input)) {
    $naam_err = '<span style="color:red;">Gebruik alleen letters en spaties!</span>';
    $formIsCorrect = false;
  } else { $naam_err = '';  }

  if (!filter_var($email_input, FILTER_VALIDATE_EMAIL)) {
    $email_err = '<span style="color:red;">Voer een geldig mailadres in!</span>';
    $formIsCorrect = false;
  } else {
    $email_err = '';
  }

  $containsDigit = preg_match('/\d/', $wachtwoord_input);
  if ($containsDigit == 0) {
    $wachtwoord_err = '<span style="color:red;">Gebruik minimaal een cijfer in je wachtwoord!</span>';
    $formIsCorrect = false;
  } else { $wachtwoord_err = '';  }

  if (!strcmp($wachtwoord_input, $herhaalwachtwoord_input) == 0) {
    $herhaalWachtwoord_err = '<span style="color:red;">Wachtwoorden komen niet overeen!</span>';
    $formIsCorrect = false;
  } else { $herhaalWachtwoord_err = '';  }

  $myfile = fopen("Users/users.txt", "r");

  while (!feof($myfile)) {
    $line = fgets($myfile);
    if (str_contains($line, $email_input)) {
      $emailBestaatAl_err = '<span style="color:red;">Er bestaat al een account met dit emailadres!</span>';
      $formIsCorrect = False;
      break;
    } else {
      $emailBestaatAl_err = '';
    }
  }
  fclose($myfile);

  $errors = array($naam_err, $email_err, $wachtwoord_err, $herhaalWachtwoord_err, $emailBestaatAl_err);

  if ($formIsCorrect == True){
    $newUserInfo = $email_input . '|' . $naam_input . '|' . $wachtwoord_input ."\n";
    $myfile2 = fopen("Users/users.txt", "a");
    fwrite($myfile2, $newUserInfo);
    fclose($myfile2);
    $register_validation=array('login', $errors, count($errors));
  }
  else {
    $register_validation=array('register', $errors, count($errors));
  }
  

  return $register_validation;
}
