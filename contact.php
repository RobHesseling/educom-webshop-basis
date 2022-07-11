
<?php
    # Als er een post request gedaan wordt. Vervolgens worden er variabelen gemaakt van de waardes.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $naam = htmlspecialchars($_REQUEST['naam']); 
      $email = htmlspecialchars($_REQUEST['email']); 
      $tel = htmlspecialchars($_REQUEST['tel']); 
      $bericht = htmlspecialchars($_REQUEST['bericht']); 
      //$formulierIsCorrect = True; # Deze boolean is standaard true, vervolgens wordt er gekeken of er iets niet is ingevuld. Is dit het geval dan wordt de boolean false.
      $GLOBALS['formulierIsCorrect'] = "True"; 

    }
?>
<!DOCTYPE html>
<html>
<head>
<style>
.Header {
  font-size: 48px;
  text-align: center;
}

.Menu {
  border:1px solid black;  
  text-decoration: none;
  color: white;
  background-color: blue;
  font-size: 24px;
}

.error{
  color: red;
}
</style>
  <title>Contact</title>  
  <link rel="stylesheet" href="CSS\stylesheet.css"> 

  <ul class='Header'>
    <h1>CONTACT</h1>
  </ul>
  
</head> 
<body>
  <ul class='Menu'>
    <a href="index.html">Home</a>
    <a href="about.html">About</a>
    <a href="contact.php">Contact</a>
  </ul>

  <p>Welkom op de contact pagina!</p>

  <label for="aanhef">Aanhef :</label>
  <select name="cars" id="cars">
    <option value="Dhr.">Dhr.</option>
    <option value="Mvr.">Mvr.</option>
  </select>
  
  <span class="error"></span>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  
  <label for="naam">Naam:</label>  
  <input type="text" name="naam" value="<?php echo isset($_POST['naam']) ? htmlspecialchars($_POST['naam'], ENT_QUOTES) : ''; ?>" required>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      if (!preg_match("/^[a-zA-Z-' ]*$/",$naam)){
        echo '<span style="color:red;">Gebruik alleen letters en spaties!</span>';
        $formulierIsCorrect = false;
      }
    } 
    else {;}
  ?> <br>
  
  <label for="email">Email:</label>
  <input type="text" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>" required>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo '<span style="color:red;">Voer een geldig mailadres in!</span>';
        $formulierIsCorrect = false;
      }
    } 
    else {;}
  ?><br>

  <label for="tel">Tel:</label>
  <input type="tel" name="tel" value="<?php echo isset($_POST['tel']) ? htmlspecialchars($_POST['tel'], ENT_QUOTES) : ''; ?>" required>
  <br><br>
  
  <p>Communicatie voorkeur:</p>

  
  <input type="radio" name="voorkeur" value="email" <?php if(isset($_POST['voorkeur']) && $_POST['voorkeur'] =='email' ){echo "checked";}?> required> Email<br>
  <input type="radio" name="voorkeur" value="tel" <?php if(isset($_POST['voorkeur']) && $_POST['voorkeur'] =='tel' ){echo "checked";}?> required>Tel<br><br>
  

  <p><label for="bericht">Waarover wilt u contact opnemen?</label></p>
  <textarea id="textArea1" type="bericht" name="bericht" required><?php if(isset($_POST['bericht'])) { 
         echo htmlentities ($_POST['bericht']); }?></textarea><br>

  <input type="submit" value="Submit">


  </form>
 

   <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($formulierIsCorrect == True) {
      echo '<script>alert("Dankuwel voor het invullen van het formulier")</script>'; }
    else { ; }
   }
   else {;}
  ?>

 
</body>
<footer>
  <p>Created by Rob Hesseling. &copy; 2022</p>
</footer>


</html>