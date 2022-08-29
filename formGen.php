<?php

class FormGen extends PageGen{
    public function __construct()
    {
        
    }

    protected function generateForm2($Page_fields, $page, $validation_array, $maxAantalMogelijkeErrors){
        echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '" >
        <input type="hidden" name="page" value = "' . $page . '">';

        $x = 0;
        foreach ($Page_fields as $fieldnaam => $fieldinfo) {
            switch ($fieldinfo['type']) {
                case 'text':
                    echo '   <label for="'. $fieldinfo['label'] .'">'. $fieldinfo['placeholder'] .'</label>  
                       <input type="'. $fieldinfo['type'] .'" name="'. $fieldinfo['label'] .'" value="' . $_POST[$fieldinfo['label']]  . '" required> '. $validation_array[$x] .'<br><br>' ;
                       $x = $x + 1;
                    break;

                case 'textarea':
                    echo $fieldinfo['extraText'] . ' <textarea id="' . $fieldinfo['label'] . '" type="' . $fieldinfo['type'] . '" name="' . $fieldinfo['label'] . '" required>';
                    if (isset($_POST[$fieldinfo['label']])) {
                        echo htmlentities($_POST[$fieldinfo['label']]);
                    }
                    echo '</textarea> ' . $validation_array[$x] . '<br><br>';
                    $x = $x + 1;
                    break;

                case 'dropdown':
                    echo $fieldinfo['extraText'] . '<label for="' . $fieldinfo['label'] . '"></label>
                       <select name="' . $fieldinfo['label'] . '" id="' . $fieldinfo['label'] . '">
                       <option value="' . $fieldinfo['optie1'] . '">' . $fieldinfo['optie1'] . '</option>
                       <option value="' . $fieldinfo['optie2'] . '">' . $fieldinfo['optie2'] . '</option>  </select> <br><br>';
                    $x = $x + 1;
                    break;

                case 'password':
                    echo $fieldinfo['extraText'] . '   <label for="'. $fieldinfo['label'] .'">'. $fieldinfo['placeholder'] .'</label>  
                   <input type="'. $fieldinfo['type'] .'" name="'. $fieldinfo['label'] .'" value="' . $_POST[$fieldinfo['label']]  . '" required>'. $validation_array[$x] .' <br><br>' ;
                   $x = $x + 1;
                    break;

                case 'radio';
                    echo '<input type="' . $fieldinfo['type'] . '" name="' . $fieldinfo['label'] . '" value="' . $fieldinfo['placeholder'] . '"  required> 
                    ' . $fieldinfo['placeholder'] . '<br>';
                    break;
            }
        }


        while ($x < $maxAantalMogelijkeErrors){
            echo $validation_array[$x]. '<br>';
            $x = $x + 1;
        }


        echo '<br> <input type="submit" value="Submit">
            </form>';
    }


    protected function generateForm($Page_fields, $page, $validation_array, $maxAantalMogelijkeErrors){
        echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '" >
        <input type="hidden" name="page" value = "' . $page . '">';

        $x = 0;
        foreach ($Page_fields as $fieldnaam => $fieldinfo) {
            switch ($fieldinfo['type']) {
                case 'text':
                    echo '   <label for="'. $fieldinfo['label'] .'">'. $fieldinfo['placeholder'] .'</label>  
                       <input type="'. $fieldinfo['type'] .'" name="'. $fieldinfo['label'] .'" value="';
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                        echo $_POST[$fieldinfo['label']];
                    }
                    
                    echo '" required> ';
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                       echo $validation_array[$x]; 
                    }

                    echo'<br><br>' ;
                    $x = $x + 1;
                    break;

                case 'textarea':
                    echo $fieldinfo['extraText'] . ' <textarea id="' . $fieldinfo['label'] . '" type="' . $fieldinfo['type'] . '" name="' . $fieldinfo['label'] . '" required>';
                    if (isset($_POST[$fieldinfo['label']])) {
                        echo htmlentities($_POST[$fieldinfo['label']]);
                    }

                    echo '</textarea> ';
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                        echo $validation_array[$x]; 
                     }

                    echo '<br><br>';
                    $x = $x + 1;
                    break;

                case 'dropdown':
                    echo $fieldinfo['extraText'] . '<label for="' . $fieldinfo['label'] . '"></label>
                       <select name="' . $fieldinfo['label'] . '" id="' . $fieldinfo['label'] . '">
                       <option value="' . $fieldinfo['optie1'] . '">' . $fieldinfo['optie1'] . '</option>
                       <option value="' . $fieldinfo['optie2'] . '">' . $fieldinfo['optie2'] . '</option>  </select> <br><br>';
                    $x = $x + 1;
                    break;

                case 'password':
                    echo '   <label for="'. $fieldinfo['label'] .'">'. $fieldinfo['placeholder'] .'</label>  
                        <input type="'. $fieldinfo['type'] .'" name="'. $fieldinfo['label'] .'" value="';
                        
                        if ($_SERVER["REQUEST_METHOD"] == "POST"){
                            $_POST[$fieldinfo['label']]; 
                         }

                        echo '" required>';
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                        echo $validation_array[$x]; 
                    }

                    echo'<br><br>' ;
                    $x = $x + 1;
                    break;

                case 'radio';
                    echo '<input type="' . $fieldinfo['type'] . '" name="' . $fieldinfo['label'] . '" value="' . $fieldinfo['placeholder'] . '"  required> 
                    ' . $fieldinfo['placeholder'] . '<br>';
                    break;
            }
        }


        while ($x < $maxAantalMogelijkeErrors){
            echo $validation_array[$x]. '<br>';
            $x = $x + 1;
        }


        echo '<br> <input type="submit" value="Submit">
            </form>';
    }
}

?>