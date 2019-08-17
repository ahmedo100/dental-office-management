<?php

    require_once "patient.php";

    $patient = Patient::initPatientWithNothing();
    print_r($patient->getAllPatients());

?>