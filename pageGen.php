<?php
require_once('formgen.php');
class PageGen extends controller
{

    protected function __construct()
    {}

    public function showPage($requestedPage, $validations_array = '', $maxAantalMogelijkeErrors = '')
    {
        if (!strcmp(gettype($requestedPage), "array"))
        {
            
            $array = $requestedPage; 
            $requestedPage = $array[0];
            $validations_array = $array[1];
            $maxAantalMogelijkeErrors =  $array[2];
        }
        $this->startDocument();
        $this->showHeadSection($requestedPage);
        $this->showMenu($requestedPage);
        $this->showcontent($requestedPage, $validations_array, $maxAantalMogelijkeErrors);
        $this->showFooter();
        $this->endDocument();
    }

    private function startDocument()
    {
        echo '<!doctype html> 
        <html>';
    }

    private function showHeadSection($requested_page)
    {

        echo '<head>
        <link rel="stylesheet" href="CSS\stylesheet.css">
        <ul class="Header">
        <h1>';

        switch ($requested_page) {
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

    private function showMenu($requested_page)
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

    private function showContent($page, $validations_array, $maxAantalMogelijkeErrors)
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

        $ContactPage_fields = array
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

        $LoginSQLPage_fields = array
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

        switch($page){
        	case 'home';
                echo 'Welkom op de home pagina!';
            break;

            case 'about';
                echo 'Welkom op de about pagina! <br> Ik ben Rob etc etc.';
             break; 
        
            case 'bedankt';
                echo 'Bedankt voor het invullen, wij nemen contact met u op. <br> <br> Mvg, Picobello B.V.';
            break;
        
            case 'contact';
                $formGen = new FormGen();
                $formGen->generateForm($ContactPage_fields, $page, $validations_array, $maxAantalMogelijkeErrors);
        	break;
        
        	case 'login':
                $formGen = new FormGen();
                $formGen->generateForm($LoginPage_fields, $page, $validations_array, $maxAantalMogelijkeErrors);
        	break;
            
            case 'register':
                $formGen = new FormGen();
                $formGen->generateForm($RegisterPage_fields, $page, $validations_array, $maxAantalMogelijkeErrors);
            break;
            
            case 'loginsql':
                $formGen = new FormGen();
                $formGen->generateForm($LoginSQLPage_fields, $page, $validations_array, $maxAantalMogelijkeErrors);
            break;
            
        }

        echo '    </body>' . PHP_EOL; 
    }

    private function showFooter(){
        echo '<footer>
          <p>Je bent gebleven bij de register met sql, er staat comentaar in de onderste functie in het "validatePOSTrequest" file!   . Created by RobHesseling. &copy;2022</p>
          </footer>';
    }
    
    private function endDocument(){
        echo  '</html>';
    }
}
