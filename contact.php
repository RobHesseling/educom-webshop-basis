<?php
function showContactContent(){
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $naam = htmlspecialchars($_REQUEST['naam']); 
      $email = htmlspecialchars($_REQUEST['email']); 
      $tel = htmlspecialchars($_REQUEST['tel']); 
      $bericht = htmlspecialchars($_REQUEST['bericht']); 
      $formulierIsCorrect = True; # Deze boolean is standaard true, vervolgens wordt er gekeken of er iets niet is ingevuld. Is dit het geval dan wordt de boolean false.
    }
 if ($_SERVER["REQUEST_METHOD"] == "GET") 
 {
   
 }
  echo '<p>Welkom op de contact pagina!</p>

  <label for="aanhef">Aanhef :</label>
  <select name="cars" id="cars">
    <option value="Dhr.">Dhr.</option>
    <option value="Mvr.">Mvr.</option>
  </select>
  
  <span class="error"></span>
  <form method="post" action="'. $_SERVER['PHP_SELF'] .'">
  
  <label for="naam">Naam:</label>  
  <input type="text" name="naam" value="';
  
  echo isset($_POST['naam']) ? htmlspecialchars($_POST['naam'], ENT_QUOTES) : '';

  echo '" required>';
  
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
      if (!preg_match("/^[a-zA-Z-' ]*$/",$naam)){
        echo '<span style="color:red;">Gebruik alleen letters en spaties!</span>';
        $formulierIsCorrect = false;
      }
    } 
    else {;}
    
  echo ' <br>
  
  <label for="email">Email:</label>
  <input type="text" name="email" value="';
  
  echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : '';
  
  echo '" required>';

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo '<span style="color:red;">Voer een geldig mailadres in!</span>';
        $formulierIsCorrect = false;
      }
    } 
    else {;}
    
  echo '<br>

  <label for="tel">Tel:</label>
  <input type="tel" name="tel" value="';
  
  echo isset($_POST['tel']) ? htmlspecialchars($_POST['tel'], ENT_QUOTES) : '';
  
  echo '" required>
  <br><br>
  
  <p>Communicatie voorkeur:</p>

  
  <input type="radio" name="voorkeur" value="email" ';
  if(isset($_POST['voorkeur']) && $_POST['voorkeur'] =='email' ){echo "checked";}
  
  echo 'required> Email<br>
  <input type="radio" name="voorkeur" value="tel" ';
  
  if(isset($_POST['voorkeur']) && $_POST['voorkeur'] =='tel' ){echo "checked";}
  
  echo ' required>Tel<br><br>
  

  <p><label for="bericht">Waarover wilt u contact opnemen?</label></p>
  <textarea id="textArea1" type="bericht" name="bericht" required>';
  
  if(isset($_POST['bericht'])) { echo htmlentities ($_POST['bericht']); }
  
  echo '</textarea><br>

  <input type="submit" value="Submit">


  </form>';
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($formulierIsCorrect == True) {
      echo '<script>alert("Dankuwel voor het invullen van het formulier")</script>'; }
    else { ; }
   }
   else {;}
} 
?>