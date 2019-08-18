<?php
    require_once "patient.php";
    require_once "appointment.php";
    require_once "TableHundler.php";
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


function displayAppointmentTable(){
        $tmp = Appointment::initAppointmentWithNothing();
        $values = $tmp->getAllAppointments();
        $header = array("Patient", "Age", "Date", "Hour", "Message");
        $index = array("full_name_patient", "age_patient", "date_appointment", "hour_appointment", "message_appointment");
        $options = array(
            array(
                "name" => "Modifier",
                "redirect" => "edit-appointment.php",

            )  ,
            array(
                "name" => "Supprimer",
                "data-target" => "#delete_appointment"
            )
        );
        $table_hundler = new TableHundler($header, $index, $values, $options);
        echo $table_hundler->displayTable();
}

function displayAppointmentsPatient($id_patient){
    $tmp = Appointment::initAppointmentWithNothing();
    $appointments = $tmp->getAllAppointmentsPatient($id_patient);

    foreach($appointments as $appointment){
        echo $appointment->displayAppointmentPatient();
    }
}



?>