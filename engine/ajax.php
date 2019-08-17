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
        $patient = Patient::initPatientWithNothing();
        $valueArray = array(
            "id_doctor" => "1",
            "full_name_patient" => $_POST["lastName"]." ".$_POST["firstName"],
            "birthdate_patient" => date("Y-m-d", strtotime($_POST["birthdate"])),
            "phone_number_patient" => $_POST["phone"],
            "address_patient" => $_POST["address"],
            "gender_patient" => $_POST["gender"]
        );
        $patient->addPatient($valueArray);
        echo "created";


    }
}


?>