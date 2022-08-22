<?php

function generate_form($Page_fields, $page, $validation_array, $maxAantalMogelijkeErrors)
{
	echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '" >
            <input type="hidden" name="page" value = "' . $page . '">';

	$x = 0;
	foreach ($Page_fields as $fieldnaam => $fieldinfo) {
		switch ($fieldinfo['type']) {
			case 'text':
				echo $fieldinfo['extraText'] . '   <label for="'. $fieldinfo['label'] .'">'. $fieldinfo['placeholder'] .'</label>  
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
				echo $fieldinfo['extraText'] . '<label for="' . $fieldinfo['label'] . '">' . $fieldinfo['placeholder'] . '</label>
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
				echo $fieldinfo['extraText'] . '<input type="' . $fieldinfo['type'] . '" name="' . $fieldinfo['label'] . '" value="' . $fieldinfo['placeholder'] . '"  required> 
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










	/*
	echo '<br>in de generate_form';
  echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'" >
                <input type="hidden" name="page" value = "contact">';
	
	$x = 0;
	foreach ($Page_fields as $fieldnaam => $fieldinfo){

		   switch($fieldinfo['type']){
			 case 'text':
			   echo $fieldinfo['extraText'] . '   <label for="'. $fieldinfo['label'] .'">'. $fieldinfo['placeholder'] .'</label>  
			   <input type="'. $fieldinfo['type'] .'" name="'. $fieldinfo['label'] .'" value="' . keepValue($fieldinfo['label']) . '" required> '. $_SESSION[$page. 'Validation'][$x] .' <br>' ;
			   $x = $x + 1;
			 break;
			 
			 case 'textarea':
			   echo $fieldinfo['extraText'] . ' <textarea id="'. $fieldinfo['label'] .'" type="'. $fieldinfo['type'].'" name="'. $fieldinfo['label'] .'" required>' ;
			   if(isset($_POST[$fieldinfo['label']])) { 
				 echo htmlentities ($_POST[$fieldinfo['label']]); }
				 echo '</textarea> '. $_SESSION[$page. 'Validation'][$x] . '<br>';
				 $x = $x + 1;
			 break;
			 
			 case 'dropdown':
			   echo $fieldinfo['extraText'] . '<label for="'. $fieldinfo['label'] .'">'. $fieldinfo['placeholder'] .'</label>
			   <select name="'. $fieldinfo['label'] .'" id="'. $fieldinfo['label'] .'">
			   <option value="'. $fieldinfo['optie1'] .'">'. $fieldinfo['optie1'] .'</option>
			   <option value="'. $fieldinfo['optie2'] .'">'. $fieldinfo['optie2'] .'</option>  </select> <br>';
			   $x = $x + 1;
			 break;
			 
			 case 'password':
			   echo $fieldinfo['extraText'] . '   <label for="'. $fieldinfo['label'] .'">'. $fieldinfo['placeholder'] .'</label>  
			   <input type="'. $fieldinfo['type'] .'" name="'. $fieldinfo['label'] .'" value="' . keepValue($fieldinfo['label']) . '" required>'. $_SESSION[$page. 'Validation'][$x] .' <br>' ;
			   $x = $x + 1;
			 break;
			 
			 case 'radio';
			   echo $fieldinfo['extraText'] . '<input type="'. $fieldinfo['type'] .'" name="'. $fieldinfo['label'] .'" value="'. $fieldinfo['placeholder'] .'"  required> 
			   '. $fieldinfo['placeholder'] .'<br>';
			   
			 break; 
			 
		   }	
		
	}
	echo '<br> <input type="submit" value="Submit">
	</form>';
	
}


function keepValue($NameOfValue)
{
  $keepValue = isset($_POST[$NameOfValue]) ? htmlspecialchars($_POST[$NameOfValue], ENT_QUOTES) : '';
  return $keepValue;
}
*/
