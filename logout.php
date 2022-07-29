 <?php


function showLogoutContent(){
      
    echo '<p>Klik op de knop om uit te loggen!</p>
         <form method="post" action="'.$_SERVER['PHP_SELF'].'">
                 <input type="hidden" name="page" value = "logout">

         <input type="submit" value="Logout">
         </form>';
  
    
}



?>