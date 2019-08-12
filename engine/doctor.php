<?php   
require_once 'database-logs.php';
require_once 'database-functions.php';
class Doctor {

    // Parameters ..

    private $db ;

    private $full_name_doctor , $gender_doctor;

    //default constructor
    public  function __construct(){
            // to allocate memory
    }
    // constructor that init's a doctor with ID 
    public static function initDoctorWithId($id_doctor){
        $instance = new self();
        $instance->id_doctor=$id_doctor;
        $instance->db = new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
        $instance->initDoctor();

        return $instance;
    }

    public static function initDoctorWithNothing(){
        $instance = new self();
        $instance->db = new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
        return $instance;

    }

    function initDoctor(){
        $doctor = $db->selectData("doctors","*","id_doctor='"+$this->id_doctor+"';")[0];
        $this->full_name_doctor = $doctor["full_name_doctor"];
        $this->gender_doctor= $doctor["gender_doctor"];
    }

    function getDoctorById($id_doctor){
        return Doctor::initDoctorWithId($id_doctor);
    }

    


    /**
     * Get the value of full_name_doctor
     */ 
    public function getFull_name_doctor()
    {
        return $this->full_name_doctor;
    }

    /**
     * Get the value of gender_doctor
     */ 
    public function getGender_doctor()
    {
        return $this->gender_doctor;
    }
}


?>