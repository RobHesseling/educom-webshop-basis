<?php
//==============================================
// MAIN APP
//==============================================

session_start();

$requested_page = getRequestedPage();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  echo $requested_page;


  if (!strcmp($requested_page, 'logout')){
    unset($_SESSION['userInfo']);
    showPage('home');
    
  }
  else {
    showPage($requested_page);
  }
  
} 


else {
	$validations_array = validateRequestedPage($requested_page);
  $page = $validations_array[0];
  $errors = $validations_array[1];
  $maxAantalMogelijkeErrors =  $validations_array[2];
	showPage($page, $errors, $maxAantalMogelijkeErrors);

}


//==============================================
// FUNCTIONS
//==============================================
function showPage($requested_page, $validations_array = '', $maxAantalMogelijkeErrors = '' ){
	startDocument();
	showHeadSection($requested_page);
	showmenu($requested_page);
	showcontent($requested_page, $validations_array, $maxAantalMogelijkeErrors);
	showFooter();
	endDocument();
}
//==============================================
function getRequestedPage() 
{  
   $requested_type = $_SERVER['REQUEST_METHOD']; 
 
   if ($requested_type == 'POST') 
   { 
       $requested_page = getArrayVar($_POST, 'page', 'home');
   } 
   else 
   { 
       $requested_page = getArrayVar($_GET, 'page', 'home');
   } 
    
   return $requested_page; 
} 
//==============================================
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
} 
//==============================================
function showHeadSection($requested_page) 
{ 

  echo '<head>
  <link rel="stylesheet" href="CSS\stylesheet.css">
  <ul class="Header">
    <h1>';
    
    switch ($requested_page)
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
      case 'bedankt':
            echo 'BEDANKT ';
            break;
   }
    
    echo '</h1>
  </ul/>
  </head>';


}
//==============================================
function showMenu($requested_page)
{
  if(isset($_SESSION['userInfo'])){
    $menuContent=array("home"=>"Home","about"=>"About","contact"=>"Contact","logout"=>'Logout['. $_SESSION["userInfo"]["userName"] .']');
  }
  else {
    $menuContent=array("home"=>"Home","about"=>"About","contact"=>"Contact","login"=>'Login',"register"=>'Register');
  }
    echo '<link rel="stylesheet" href="CSS\stylesheet.css">
    <ul class="Menu">';
    foreach($menuContent as $menu => $content){
      echo '<a href="index.php?page=' . $menu . '">'. $content . ' | </a>';  
    }
    echo '</ul>'; 
}
//==============================================
function validateRequestedPage($requested_page)
{
  switch ($requested_page)
  {
    case 'contact':
      require_once('validations.php');
        $array = validateContact();
      break; 
    case 'login':
      require_once('validations.php');
        $array = validateLogin();
      break;
    case 'register':
      require_once('validations.php');
        $array = validateRegister();
      break;
    case 'logout':
      require_once('validations.php');
        $array = validateLogout();
      break;
    
  }
  
  return $array;
}
//==============================================
function showContent($page, $validations_array, $maxAantalMogelijkeErrors)
{
  echo '    <body>' . PHP_EOL;
  $LoginPage_fields = array
  ( 
    'email' 		=> array('type' => 'text', 		
              'label'=> 'email',
              'placeholder' => 'Email:'
              ),
    'wachtwoord' 		=> array('type' => 'password', 		
              'label'=> 'wachtwoord',
              'placeholder' => 'Wachtwoord:'
              )
  );
  
  $contactPage_fields = array
  ( 
    'aanhef' 		=> array('type' => 'dropdown', 		
              'label'=> 'aanhef',
              'extraText' => '<br> Aanhef:',
              'optie1'=> 'Dhr.',
              'optie2'=> 'Mvr.'
              
              ),
              
    'naam' 		=> array('type' => 'text', 		
              'label'=> 'naam',
              'placeholder' => 'Naam:'
              ),
              
    'email' 		=> array('type' => 'text', 		
              'label'=> 'email',
              'placeholder' => 'Email:'
              ),
              
    'telefoonnummer' 		=> array('type' => 'text', 		
              'label'=> 'telefoonnummer',
              'placeholder' => 'Telefoonnummer:'
              ),
              
    'voorkeur' 		=> array('type' => 'radio', 		
              'label'=> 'voorkeur',
              'placeholder' => 'Email',
              'extraText' => '<br> Kies een communicatie voorkeur:<br>'
              ),
              
    'voorkeur2' 		=> array('type' => 'radio', 		
              'label'=> 'voorkeur',
              'placeholder' => 'Telefoon'
              ),
              
    'bericht' 		=> array('type' => 'textarea', 		
              'label'=> 'bericht',
              'extraText' => '<br> Waarover wilt u contact opnemen:<br>'
              )
  );
   
  $RegisterPage_fields = array
  (         
    'naam' 		=> array('type' => 'text', 		
              'label'=> 'naam',
              'placeholder' => 'Naam:'
              ),
    'email' 		=> array('type' => 'text', 		
              'label'=> 'email',
              'placeholder' => 'Email:'
              ),

    'wachtwoord' 		=> array('type' => 'password', 		
                        'label'=> 'wachtwoord',
                        'placeholder' => 'Wachtwoord:'
                        ),

    'herhaalWachtwoord' 		=> array('type' => 'password', 		
                        'label'=> 'herhaalwachtwoord',
                        'placeholder' => 'Herhaal wachtwoord:'
                        )                   

  );

  switch($page){
	  case 'home';
      echo 'Welkom op de home pagina!';
      break;
    
    case 'about';
      echo 'Welkom op de about pagina! <br> Ik ben Rob etc etc.';
    break; 
    
    case 'bedankt';
      echo 'Bedankt voor het invullen, wij nemen contact met u op. Mvg, Picobello B.V.';
    break;

    case 'contact';
		require_once('form_gen.php');
      generate_form($contactPage_fields, $page, $validations_array, $maxAantalMogelijkeErrors);
	  break;
	  
	  case 'login':
		require_once('form_gen.php');
      generate_form($LoginPage_fields, $page, $validations_array, $maxAantalMogelijkeErrors);
	  break;
	  
    case 'register':
      require_once('form_gen.php');
        generate_form($RegisterPage_fields, $page, $validations_array, $maxAantalMogelijkeErrors);
      break;
    
  }
   
    echo '    </body>' . PHP_EOL; 
}
//==============================================
function startDocument(){
  echo '<!doctype html> 
  <html>';
}
//==============================================
function endDocument(){
  echo  '</html>';
}
//==============================================
function showFooter(){
  echo '<footer>
    <p>Created by RobHesseling. &copy;2022</p>
    </footer>';
}
//==============================================
?>