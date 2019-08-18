<?php
//// The names that should be put inside the form when adding a patient ////

//// full_name_patient , address_patient , gender_patient , ////

/// phone_number_patient , birthdate_patient , id_doctor///

require_once "database-functions.php";
require_once "database-logs.php";

class Appointment {

    public $db;
    public $id_appointment, $id_patient, $full_name_patient, $age_patient,  $date_appointment, $hour_appointment, $timestamp_appointment , $message_appointment;

    function  __construct(){
    }
    public static function initAppointmentWithId($id_appointment){
        $instance = new self();
        $instance->db =  new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
        $instance->id_appointment = $id_appointment;
        $instance->initAppointment();
        return $instance;
    }

    public static function initAppointmentWithNothing(){
        $instance = new self();
        $instance->db =  new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
        return $instance;
    }

    public static function initAppointmentWithArray($array){
        $instance = new self();

        $instance->id_patient = $array["id_patient"];
        $instance->id_appointment = $array["id_appointment"];
        $instance->full_name_patient = $array["full_name_patient"];
        $instance->timestamp_appointment = $array["timestamp_appointment"];
        $instance->age_patient = floor((time() - strtotime($array["birthdate_patient"])) / 31556926);
        $instance->date_appointment = date('m/d/Y', $array["timestamp_appointment"]);
        $instance->hour_appointment = date('H:i', $array["timestamp_appointment"]);
        $instance->message_appointment = $array["message_appointment"];

        return $instance;
    }

    function initAppointment(){
        $appointment=  $this->db->selectData("appointment, patients","*","id_appointment='$this->id_appointment';")["result"][0];
        $this->id_appointment= $appointment["id_appointment"];
        $this->id_patient= $appointment["id_patient"];
        $this->timestamp_appointment = $appointment["timestamp_appointment"];
        $this->full_name_patient = $appointment["full_name_patient"];
        $this->message_appointment = $appointment["message_appointment"];
        $this->date_appointment = date('m/d/Y', $this->timestamp_appointment);
        $this->hour_appointment = date('H:i', $this->timestamp_appointment);

    }

    function getAppointmentById($id_appointment){
        return  Appointment::initAppointmentWithId($id_appointment);
    }

    function getAllAppointments(){
        $id_doctor=1;
        $tmp_appointment_array =  $this->db->selectData("appointment, patients","*","appointment.id_doctor='$id_doctor' && appointment.id_patient = patients.id_patient");
        $appointment_array = array();
        forEach($tmp_appointment_array["result"]  as $tmp_array){
            array_push($appointment_array,Appointment::initAppointmentWithArray($tmp_array));
        }
        return $appointment_array;
    }

    function getAllAppointmentsPatient($id_patient){
        $id_doctor = 1;
        $tmp_appointment_array =  $this->db->selectData("appointment, patients","*","appointment.id_doctor='$id_doctor' && appointment.id_patient = patients.id_patient && appointment.id_patient =".$id_patient);
        $appointment_array = array();
        forEach($tmp_appointment_array["result"]  as $tmp_array){
            array_push($appointment_array,Appointment::initAppointmentWithArray($tmp_array));
        }
        return $appointment_array;

    }

    function displayAppointmentPatient(){
        echo "
             <li>
                <div class=\"experience-user\">
                      <div class=\" before-circle\"></div>
                </div>
                <div class=\"experience-content\">
                      <div class=\"timeline-content\">
                          <a href=\"#/\" class=\"name\">$this->date_appointment</a>
                          <div>$this->message_appointment</div>
                      </div>
                </div>
             </li>
     
        ";
    }

    function addAppointment($appointment_arr){
        $return_result = $this->db->insertData("appointment",$appointment_arr);
        return true;
    }

    function updateAppointment($appointment_arr){
        $return_result = $this->db->updateData("appointment" ,"id_appointment = ".$appointment_arr["id_appointment"], $appointment_arr);
        return true;
    }





}


?>