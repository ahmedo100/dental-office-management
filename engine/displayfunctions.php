<?php
    require_once "patient.php";
    function displayAllPatients(){
        $tmp = Patient::initPatientWithNothing();
        $patients = $tmp->getAllPatients();

        foreach($patients as $patient){
            echo $patient->displayPatient();
        }
    }

function displaySelectPatients(){
    $tmp = Patient::initPatientWithNothing();
    $patients = $tmp->getAllPatients();

    foreach($patients as $patient){
        echo $patient->displaySelectItemPatient();
    }
}



function displayProfileInfo($id_patient){
       $tmp = Patient::initPatientWithNothing();
        $patient = $tmp->getPatientById($id_patient);;
        echo $patient->displayContactInformations();

   }



?>