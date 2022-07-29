<?php
//==============================================
// MAIN APP
//==============================================
session_start();
$requested_page = getRequestedPage(); 
$response_page  = validateRequest($requested_page);
showResponsePage($response_page);

//==============================================
// FUNCTIONS
//==============================================

function validateRequest($page){

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($page)
   {
       case 'login':
          if(!isset($_SESSION['userInfo'])){
            $email_input = htmlspecialchars($_REQUEST['email']); 
            $wachtwoord_input = htmlspecialchars($_REQUEST['wachtwoord']);
          
            $myfile = fopen("Users/users.txt", "r");

            while(!feof($myfile)){
              $line = fgets($myfile);
              if (str_contains($line, $email_input) && str_contains($line, $wachtwoord_input)) { 
                $login = True;
                $login_err = '';
                $fileArray= explode("|",$line);

                $userInfo=array("userEmail"=>$fileArray[0],"userName"=>$fileArray[1]);
                $_SESSION["userInfo"] = $userInfo;
                break;
              }  
              else {
                $login_err = '<span style="color:red;">Email-wachtwoord combinatie bestaat niet!</span>';
                $login = False;
              }
            }
            fclose($myfile);
            
            $_SESSION["loginPageError"] = $login_err;
            
            if($login == True){
              $page = 'home';
            }
            else{
              $page = 'login';
            }
          }
          else {
            unset($_SESSION['userInfo']);
            $page = 'home';
          }
          break;
       case 'register':
          $naam_input = htmlspecialchars($_REQUEST['naam']); 
          $email_input = htmlspecialchars($_REQUEST['email']); 
          $wachtwoord_input = htmlspecialchars($_REQUEST['wachtwoord']);
          $herhaalwachtwoord_input = htmlspecialchars($_REQUEST['herhaalWachtwoord']);
          $formIsCorrect = True;

          if (!preg_match("/^[a-zA-Z-' ]*$/",$naam_input)){
            $naam_err = '<span style="color:red;">Gebruik alleen letters en spaties!</span>';
            $formIsCorrect = False;
          }
          if (!filter_var($email_input, FILTER_VALIDATE_EMAIL)){
            $email_err = '<span style="color:red;">Voer een geldig mailadres in!</span>';
            $formIsCorrect = False;
          } 

          $containsDigit = preg_match('/\d/', $wachtwoord_input);
          if ($containsDigit == 0){
            $wachtwoord_err = '<span style="color:red;">Gebruik minimaal een letter in je wachtwoord!</span>';
            $formIsCorrect = False;
          }

          if (!strcmp($wachtwoord_input, $herhaalwachtwoord_input) == 0){
            $herhaalWachtwoord_err = '<span style="color:red;">Wachtwoorden komen niet overeen!</span>';
            $formIsCorrect = False;
          }
          
          
          
          $myfile = fopen("Users/users.txt", "r");

            while(!feof($myfile)){
              $line = fgets($myfile);
              if (str_contains($line, $email_input)) { 
                $emailBestaatAl_err = '<span style="color:red;">Er bestaat al een account met dit emailadres!</span>';
                $formIsCorrect = False;
                break;
              }  
              else {
                $emailBestaatAl_err = '';
              }
            }
            fclose($myfile);
          
          $registerPageErrors=array("naam_err"=>$naam_err,"email_err"=>$email_err,"wachtwoord_err"=>$wachtwoord_err,"herhaalWachtwoord_err"=>$herhaalWachtwoord_err,"emailBestaatAl_err"=>$emailBestaatAl_err);
          $_SESSION["registerPageErrors"] = $registerPageErrors;
          
          
          if ($formIsCorrect == True){
            $newUserInfo = $email_input . '|' . $naam_input . '|' . $wachtwoord_input ."\n";
              $myfile2 = fopen("Users/users.txt", "a");
              fwrite($myfile2, $newUserInfo);
              fclose($myfile2);
              $page = 'login';
          }
          
          
          
          break;
          
          
       case 'logout':
          unset($_SESSION['registerPageErrors']);
          unset($_SESSION['userInfo']);
          session_destroy();
          $page = 'home';
          break;
    }
  }
  else {
    $_SESSION["loginPageError"] = "";
    $registerPageErrors=array("naam_err"=>"","email_err"=>"","wachtwoord_err"=>"","herhaalWachtwoord_err"=>"","emailBestaatAl_err"=>"");
    $_SESSION["registerPageErrors"] = $registerPageErrors;
  }

  $result = $page;
  return $result;
}

function getRequestedPage() 
{  
   $requested_type = $_SERVER['REQUEST_METHOD']; 
 
   if ($requested_type == 'POST') 
   { 
       $requested_page = getPostVar('page', 'home'); 
   } 
   else 
   { 
       $requested_page = getUrlVar('page','home');
   } 

   return $requested_page; 
} 
//==============================================
function showResponsePage($page) 
{ 
   beginDocument(); 
   showHeadSection($page); 
   showBodySection($page); 
   endDocument(); 
}     
//==============================================
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
} 
//==============================================
function getPostVar($key, $default='') 
{ 
/*
    echo '1 '; var_dump(  $_POST);
    echo'<hr>';
    echo '2 ' . $key;
    echo'<hr>';
    echo '3 ' . $default; 
    echo'<hr>';*/
    return getArrayVar($_POST, $key, $default);

    // Or use the modern variant below, a better way than accessing super global "$_POST"
  
    // see https://www.php.net/manual/en/function.filter-input.php 
       //for extra options 
    
       //$value = filter_input(INPUT_POST, $key); 
       //echo'<hr>';
       //var_dump($value);
       //echo'<hr>';
       //return isset($value) ? $value : $default;
    
} 
//==============================================
function getUrlVar($key, $default='') 
{ 
    return getArrayVar($_GET, $key, $default);
} 
//==============================================
function beginDocument() 
{ 
   echo '<!doctype html> 
<html>'; 
} 
//==============================================
function showHeadSection($page) 
{ 

  echo '<head>
  <link rel="stylesheet" href="CSS\stylesheet.css">
  <ul class="Header">
    <h1>';
    
    switch ($page)
   {
       case 'home':
          echo 'HOME';
          break;
       case 'about':
          echo 'ABOUT';
          break;
       case 'contact':
          echo 'CONTACT';
          break;
       case 'login':
          echo 'LOGIN';
          break;
       case 'register':
          echo 'REGISTER';
          break;
       case 'logout':
          echo 'LOGOUT';
          break;
   }
    
    echo '</h1>
  </ul/>
</head>';


}
//==============================================
function showBodySection($page) 
{ 
   echo '    <body>' . PHP_EOL;
   showHeader($page);
   showMenu(); 
   showContent($page); 
   showFooter(); 
   echo '    </body>' . PHP_EOL; 
} 
//==============================================
function endDocument() 
{ 
   echo  '</html>'; 
} 
//==============================================
function showHeader($page) 
{ 
  
} 
//==============================================
function showMenu()
{
  if(isset($_SESSION['userInfo']))
    echo '
        <ul class="Menu">
        <a href="index.php?page=home">Home</a>
        <a href="index.php?page=about">About</a>
        <a href="index.php?page=contact">Contact</a>
        <a href="index.php?page=logout">Logout['. $_SESSION["userInfo"]['userName'] .']</a>
        </ul> ';
  else{ echo '
        <ul class="Menu">
        <a href="index.php?page=home">Home</a>
        <a href="index.php?page=about">About</a>
        <a href="index.php?page=contact">Contact</a>
        <a href="index.php?page=login">Login</a>
        <a href="index.php?page=register">Register</a>
        </ul> ';}
      

   
  
}
//==============================================
function showContent($page)
{
   switch ($page)
   {
       case 'home':
          require_once('home.php');
            showHomeContent();
          break;
       case 'about':
          require_once('about.php');
            showAboutContent();
            break;
       case 'contact':
          require_once('contact.php');
            showContactContent();
          break;
       case 'login':
          require_once('login.php');
            showLoginContent();
          break;
       case 'register':
          require_once('register.php');
            showRegisterContent();
          break;
       case 'logout':
          require_once('logout.php');
            showLogoutContent();
          break;
   }
}
//==============================================
function showFooter() 
{
  echo '<footer>
    <p>Created by RobHesseling. &copy;2022</p>
  </footer>';
}
?>