<?php
function keepValue($NameOfValue){
  $keepValue = isset($_POST[$NameOfValue]) ? htmlspecialchars($_POST[$NameOfValue], ENT_QUOTES) : '';
  return $keepValue;
}


function showRegisterContent(){
  $keepValueNaam = keepValue('naam');
  $keepValueEmail = keepValue('email');
  $keepValueWachtwoord = keepValue('wachtwoord');
  $keepValueherhaalWachtwoord = keepValue('herhaalWachtwoord');
  
      echo '<p>Dit is de register page!</p>
        <form method="post" action="'.$_SERVER['PHP_SELF'].'">
        <input type="hidden" name="page" value = "register">
        <label for="naam">Naam:</label>  
        <input type="text" name="naam" value="'. $keepValueNaam .'" required> '. $_SESSION["registerPageErrors"]['naam_err'] .' <br> 
      
        <label for="email">Email:</label> 
        <input type="text" name="email" value="'. $keepValueEmail .'" required> '. $_SESSION["registerPageErrors"]['email_err'] .' <br>
                
        <label for="wachtwoord">Wachtwoord:</label> 
        <input type="text" name="wachtwoord" value="'. $keepValueWachtwoord .'" required> '. $_SESSION["registerPageErrors"]['wachtwoord_err'] .' <br><br>
                
        <label for="herhaalWachtwoord">Herhaal wachtwoord:</label> 
        <input type="text" name="herhaalWachtwoord" value="'. $keepValueherhaalWachtwoord .'" required> '. $_SESSION["registerPageErrors"]['herhaalWachtwoord_err'] .'<br><br> 
        ' . $_SESSION["registerPageErrors"]['emailBestaatAl_err'] . ' <br><br>
                
        <input type="submit" value="Register">
        </form>';  
  


}

?>