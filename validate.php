<?php
require_once('validatePOSTRequest.php');
class Validate extends Controller{
    public function __construct()
    {
        
    }

    protected function validate($requestedPage){
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $reponsePage = $this->validateGETRequest($requestedPage);
        }
        else {
            $reponsePage = $this->validatePOSTRequest($requestedPage);
        }

        return $reponsePage;
    }

    private function validateGETRequest($requestedPage){
        if (!strcmp($requestedPage, 'logout')){
            unset($_SESSION['userInfo']);
            $reponsePage = 'home';
        }
        else{
            $reponsePage = $requestedPage;
        }
        return $reponsePage;
    }

    private function validatePOSTRequest($requestedPage){
        switch ($requestedPage)
        {     
            case 'contact':
                $ValidatePOSTRequestObject = new ValidatePOSTRequest();
                $validationArray = $ValidatePOSTRequestObject->validateContact();
                break; 
            case 'login':
                $ValidatePOSTRequestObject = new ValidatePOSTRequest();
                $validationArray =$ValidatePOSTRequestObject->validateLoginSQL();
                break;
            case 'register':
                $ValidatePOSTRequestObject = new ValidatePOSTRequest();
                $validationArray =$ValidatePOSTRequestObject->validateRegisterSQL();
                break;
        }
        return $validationArray;
    }
}

?>