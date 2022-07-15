<?php
function keepValue($NameOfValue){
  $keepValue = isset($_POST[$NameOfValue]) ? htmlspecialchars($_POST[$NameOfValue], ENT_QUOTES) : '';
  return $keepValue;
}

function HTMLBedankjePage(){
 echo '<p>Bedankt voor het invullen van het formulier! Wij nemen z.s.m. contact met u op!</p>';
}

function HTMLContactPage($keepValueNaam, $naam_err, $keepValueEmail, $email_err, $keepValueTel, $tel_err ,$email_Checked, $tel_Checked, $bericht, $bericht_err){
  echo '<p>Welkom op de contact pagina!</p>

                <label for="aanhef">Aanhef :</label>
                <select name="cars" id="cars">
                <option value="Dhr.">Dhr.</option>
                <option value="Mvr.">Mvr.</option>
                </select>
  
                <span class="error"></span>
                <form method="post" action="'.$_SERVER['PHP_SELF'].'">
  
                <label for="naam">Naam:</label>  
                <input type="text" name="naam" value="'. $keepValueNaam .'" required>  '. $naam_err.'  <br>
  
                <label for="email">Email:</label> 
                <input type="text" name="email" value="'. $keepValueEmail .'" required> '.$email_err.' <br>
                <label for="tel">Tel:</label>
                <input type="tel" name="tel" value="'. $keepValueTel . '" required> '.$tel_err.'
                <br><br>
  
                <p>Communicatie voorkeur:</p>

                <input type="radio" name="voorkeur" value="email" '.$email_Checked.' required> Email<br>
                <input type="radio" name="voorkeur" value="tel" '.$tel_Checked.' required>Tel<br><br>
  

                <p><label for="bericht">Waarover wilt u contact opnemen?</label></p>
                <textarea id="textArea1" type="bericht" name="bericht" required>'.$bericht.'</textarea><br>'.$bericht_err.'<br><br>

                <input type="submit" value="Submit">
                </form>';
}

function showContactContent(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $naam = htmlspecialchars($_REQUEST['naam']); 
      $email = htmlspecialchars($_REQUEST['email']); 
      $tel = htmlspecialchars($_REQUEST['tel']); 
      $bericht = htmlspecialchars($_REQUEST['bericht']); 
      $email_Checked= '';
      $tel_Checked= '';
      $formIsCorrect = True;
      $tel_err ='';
        if (!preg_match("/^[a-zA-Z-' ]*$/",$naam)){
          $naam_err = '<span style="color:red;">Gebruik alleen letters en spaties!</span>';
          $formIsCorrect = False;
          } else {$naam_err = '';}

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $email_err = '<span style="color:red;">Voer een geldig mailadres in!</span>';
          $formIsCorrect = False;
          } else {$email_err = '';}
          
        if(isset($_POST['bericht'])) 
        {
          $bericht =  htmlentities ($_POST['bericht']);
        }
        
        if(isset($_POST['voorkeur']) && $_POST['voorkeur'] == 'email' ){
         $email_Checked =  'checked';}
        
        if(isset($_POST['voorkeur']) && $_POST['voorkeur'] == 'tel' ){
          $tel_Checked = 'checked';}
        
        
        $validateTel = is_numeric($tel);
        if (!$validateTel == true || strlen($tel) < 10 || strlen($tel) > 10){  
          $tel_err = '<span style="color:red;">Voer een geldig telefoonnummer in! (Bijv; "0612345678")</span>';
          $formIsCorrect = False; }
        
        $keepValueNaam = keepValue('naam');
        $keepValueEmail = keepValue('email');
        $keepValueTel = keepValue('tel');
        
        $validateBericht = str_replace(' ', '', $bericht);
        $berichtLen = strlen($validateBericht);
        
        if($berichtLen < 10){
           $bericht_err = '<span style="color:red;">Minimaal 10 karakters!</span>';
          $formIsCorrect = False;
        }
        
        
        
        
        if($formIsCorrect == True){
          HTMLBedankjePage();
        }
        else{HTMLContactPage($keepValueNaam, $naam_err, $keepValueEmail, $email_err, $keepValueTel, $tel_err ,$email_Checked, $tel_Checked, $bericht, $bericht_err);}
        
      } 
    else{
      $naam_err = '';
      $email_err = '';
      $bericht = '';
      $dankjewel = '';
      $keepValueNaam = '';
      $keepValueEmail ='';
      $keepValueTel = '';
      $email_Checked= '';
      $tel_Checked= '';
      $bericht_err = '';
      $tel_err ='';
      HTMLContactPage($keepValueNaam, $naam_err, $keepValueEmail, $email_err, $keepValueTel, $tel_err ,$email_Checked, $tel_Checked, $bericht, $bericht_err);
    }
    
}


?>
