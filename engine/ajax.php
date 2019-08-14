<?php
require_once "patient.php";
require_once "inputHandler.php";

if($_POST["type"] == "addPatient"){
    $valueArray = array($_POST["lastName"], $_POST["firstName"], $_POST["birthdate"], $_POST["gender"], $_POST["address"], $_POST["phone"]);
    $indexArray = array("lastName", "firstName", "birthDate", "gender", "address", "phone");

    $inputHundler = new InputHandler($indexArray, $valueArray);

    if($inputHundler->checkEmpty() != array()) {
        echo "notcreated";
    }else {
        echo "created";
        /*$patient = new Patient();
        $patient->addPatient($valueArray);
    */
    }
}


?>