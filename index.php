<?php

//==============================================
// MAIN APP
//==============================================

$page = getRequestedPage(); 
showResponsePage($page); 

//==============================================
// FUNCTIONS
//==============================================

function getRequestedPage() 
{  
   $requested_type = $_SERVER['REQUEST_METHOD']; 
 
   if ($requested_type == 'POST') 
   { 
       $requested_page = getPostVar('page','contact'); 
   } 
   else 
   { 
       $requested_page = getUrlVar('page','home');
   } 
   //var_dump($requested_page);
   //echo'<hr>';
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
  
    //   see https://www.php.net/manual/en/function.filter-input.php 
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
  // Zelf invullen
} 
//==============================================
function showMenu()
{
  $page = getRequestedPage();
  echo '
  <ul class="Menu">
    <a href="index.php?page=home">Home</a>
    <a href="index.php?page=about">About</a>
    <a href="index.php?page=contact">Contact</a>
  </ul>
';
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
   }
}
//==============================================
function showFooter() 
{
  echo '<footer>
    <p>Created by RobHesseling. &copy;2022</p>
  </footer>';
}
//==============================================
?>