<?php
require_once "patient.php";
require_once "Appointment.php";
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


/**!
 * Nouveau rendez-vous
 */
if($_POST["type"] == "addAppointment") {
    $valueArray = array($_POST["id-patient"], $_POST["date-appointment"], $_POST["hour-appointment"], $_POST["message-appointment"]);
    $indexArray = array("id-patient", "date-appointment", "hour-appointment", "message-appointment");

    $inputHundler = new InputHandler($indexArray, $valueArray);

    if ($inputHundler->checkEmpty() != array()) {
        echo "notcreated";
    } else {

        $timeStr = str_replace(" PM", "", $_POST["hour-appointment"]);
        $dateTime = new DateTime(date("Y-m-d", strtotime(str_replace('/', '-', $_POST["date-appointment"] )))." ".$timeStr, new DateTimeZone('UTC'));
        $timestamp = $dateTime->getTimestamp();

        $appointment = Appointment::initAppointmentWithNothing();
        $valueArray = array(
            "id_doctor" => "1",
            "id_patient" => $_POST["id-patient"],
            "timestamp_appointment" => $timestamp,
            "message_appointment" => $_POST["message-appointment"],
        );
        $appointment->addAppointment($valueArray);
        echo "created";


}
}

/**!
 * Modifer rendez-vous
 */
if($_POST["type"] == "editAppointment") {
    $valueArray = array($_POST["date-appointment"], $_POST["hour-appointment"], $_POST["message-appointment"]);
    $indexArray = array( "date-appointment", "hour-appointment", "message-appointment");

    $inputHundler = new InputHandler($indexArray, $valueArray);

    if ($inputHundler->checkEmpty() != array()) {
        echo "notupdated";
    } else {

        $timeStr = str_replace(" PM", "", $_POST["hour-appointment"]);
        $dateTime = new DateTime(date("Y-m-d", strtotime(str_replace('/', '-', $_POST["date-appointment"] )))." ".$timeStr, new DateTimeZone('UTC'));
        $timestamp = $dateTime->getTimestamp();

        $appointment = Appointment::initAppointmentWithNothing();
        $valueArray = array(
            "id_doctor" => "1",
            "id_appointment" => $_POST["id-appointment"],
            "timestamp_appointment" => $timestamp,
            "message_appointment" => $_POST["message-appointment"],
        );
        $appointment->updateAppointment($valueArray);
        echo "updated";


    }
}



    if($_POST["type"] == "calendar_items"){
        $tmp = Appointment::initAppointmentWithNothing();
        $values = $tmp->getAllAppointments();
        $events = array();

        foreach ($values as $value){

            $datetimeFormat = 'Y-m-d H:i:s';
            $date = new \DateTime();
            $date->setTimestamp($value->timestamp_appointment);

            array_push($events , array(
                'title' => $value->full_name_patient,
                'start' => $date->format($datetimeFormat),
                'classNam' => 'bg-success'

            ));

        }



        echo json_encode($events);
    }


if($_POST["type"] == "getAppointment"){
    $tmp = Appointment::initAppointmentWithNothing();
    echo json_encode($tmp->getAppointmentById($_POST["id-appointment"]));
}


?>