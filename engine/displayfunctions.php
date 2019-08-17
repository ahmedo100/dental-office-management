<?php
    require_once "patient.php";
    function displayAllPatients(){
        $tmp = Patient::initPatientWithNothing();
        $patients = $tmp->getAllPatients();

        foreach($patients as $patient){
            echo $patient->displayPatient();
        }
    }
?>