<?php   

class Doctor {
   function __construct($id_doctor){
        $this->id_doctor = $id_doctor;
        $db = new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
        initDoctor();
    }

    function initDoctor(){
        $doctor = $db->selectData("doctors","*","id_doctor='"+$this->id_doctor+"';")[0];
        $this->full_name_doctor = $doctor["full_name_doctor"];
        $this->gender_doctor= $doctor["gender_doctor"];
    }

    function getDoctorById($id_doctor){
        return new Doctor($id_doctor);
    }

    

}


?>