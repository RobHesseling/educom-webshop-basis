 <?php

function keepValue($NameOfValue){
  $keepValue = isset($_POST[$NameOfValue]) ? htmlspecialchars($_POST[$NameOfValue], ENT_QUOTES) : '';
  return $keepValue;
}

function showLoginContent(){
  
    $keepValueEmail = keepValue('email');
    $keepValueWachtwoord = keepValue('wachtwoord');
    
    echo '<p>Dit is de login page!</p>
         <form method="post" action="'.$_SERVER['PHP_SELF'].'">
         <input type="hidden" name="page" value = "login">   

         <label for="email">Email:</label>  
         <input type="text" name="email" value="'. $keepValueEmail .'" required> <br>
  
         <label for="wachtwoord">Wachtwoord:</label> 
         <input type="text" name="wachtwoord" value="'. $keepValueWachtwoord .'" required> <br><br> '. $_SESSION["loginPageError"] .' <br>
         <br>
         <input type="submit" value="Login">
         </form>';
  
    
}



?>