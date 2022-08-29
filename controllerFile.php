<?php
require_once 'pageGen.php';
require_once 'validate.php';

class Controller {

    public function __construct()
    {
    }

    public function handleRequest(){
        $requestedPage = $this->getRequestedPage();
        $responsePage = $this->validateRequest($requestedPage);
        $this->pageGenerator($responsePage);
    }

    private function getRequestedPage(){
        $requested_type = $_SERVER['REQUEST_METHOD']; 
        if ($requested_type == 'POST') 
        { 
            $requested_page = $this->getArrayVar($_POST, 'page', 'home');
        } 
        else 
        { 
            $requested_page = $this->getArrayVar($_GET, 'page', 'home');
        } 
        return $requested_page;
    }

    private function getArrayVar($array, $key, $default='') 
    { 
        return isset($array[$key]) ? $array[$key] : $default; 
    }

    private function validateRequest($requestedPage){
        $validateRequestObject = new Validate();
        $responsePage = $validateRequestObject->validate($requestedPage);
        return $responsePage;
    }

    private function pageGenerator($requestedPage){
        $fromGenObject = new PageGen();
        $fromGenObject->showPage($requestedPage);
    }

    

}
?>