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

  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  
  <label for="naam">Naam :</label>
  <input type="text" name="naam"><br>
  
  <label for="email">email :</label>
  <input type="text" name="email"><br>

  <label for="tel">tel :</label>
  <input type="tel" name="tel"><br><br>
  
  <p>Communicatie voorkeur:</p>

  <input type="radio" id="voorkeur" name="voorkeur" value="Email">
  <label for="voorkeur">Email</label><br>

  <input type="radio" id="voorkeur" name="voorkeur" value="Tel">
  <label for="voorkeur">Tel</label><br><br><br>

  <p><label for="bericht">Waarover wilt u contact opnemen?</label></p>
  <textarea type="bericht" name="bericht" rows="4" cols="50"></textarea>
  <br>

  <input type="submit" value="Submit">


  </form>
 
 <!--   Deze php code is code voor de volgende opdracht. Dit is nog niet af.
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $naam = htmlspecialchars($_REQUEST['naam']); 
      $email = htmlspecialchars($_REQUEST['email']); 
      $tel = htmlspecialchars($_REQUEST['tel']); 
      $bericht = htmlspecialchars($_REQUEST['bericht']); 
  
      $formulierIsCorrect = True;
    if (empty($naam)) {
      $formulierIsCorrect = False;
      echo "naam is empty";} 
    else {
      ; }
    if (empty($email)) {
      $formulierIsCorrect = False;
      echo "email is empty";} 
    else {
      ; }
    if (empty($tel)) {
      $formulierIsCorrect = False;
      echo "tel is empty";} 
     else {
      ; }
    if ($formulierIsCorrect == False) {
      echo "Het formulier is niet correct ingevuld! <br>";
      echo htmlspecialchars($_GET['naam']);    } 
    else {
      echo '<script>alert("Dankuwel voor het invullen van het formulier")</script>'; }
  
    }
  ?>
 -->
 
</body>
<footer>
  <p>Created by Rob Hesseling. &copy; 2022</p>
</footer>


</html>