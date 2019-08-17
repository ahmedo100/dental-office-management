<?php
//// The names that should be put inside the form when adding a patient ////

//// full_name_patient , address_patient , gender_patient , ////

/// phone_number_patient , birthdate_patient , id_doctor///

require_once "database-functions.php";
require_once "database-logs.php";

class Patient {
  
  public $db;
  public $full_name_patient , $phone_number_patient , $gender_patient ,$address_patient ,$id_patient , $birthdate_patient ;

  function  __construct(){
    }

  public static function initPatientWithId($id_patient){
    $instance = new self();
    $instance->db =  new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
    $instance->id_patient = $id_patient;
    $instance->initPatient();
    return $instance;
  }

  public static function initPatientWithNothing(){
    $instance = new self();
    $instance->db =  new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
    return $instance;
  }

  public static function initPatientWithArray($array){
      $instance = new self();

         $instance->id_patient = $array["id_patient"];
         $instance->full_name_patient = $array["full_name_patient"];
         $instance->birthdate_patient = $array["birthdate_patient"];
         $instance->gender_patient = $array["gender_patient"] == '1'  ? 'Homme' : 'Femme';
         $instance->phone_number_patient = $array["phone_number_patient"];
         $instance->address_patient = $array["address_patient"];

      return $instance;
  }
  function initPatient(){
    $patient=  $this->db->selectData("patients","*","id_patient='$this->id_patient';")["result"][0];
        $this->full_name_patient= $patient["full_name_patient"];
        $this->birthdate_patient= $patient["birthdate_patient"];
        $this->phone_number_patient= $patient["phone_number_patient"];
        $this->gender_patient = $patient["gender_patient"] == '1'  ? 'Homme' : 'Femme';
        $this->address_patient = $patient["address_patient"];
  }

  function getPatientById($id_patient){
    return  Patient::initPatientWithId($id_patient);
  }

  function getAllPatients(){
      $id_doctor=1;
     $tmp_patient_array =  $this->db->selectData("patients","*","id_doctor='$id_doctor'");
     $patient_array = array();
     forEach($tmp_patient_array["result"]  as $tmp_array){
         array_push($patient_array,Patient::initPatientWithArray($tmp_array));
      }
     return $patient_array;
  }

  function addPatient($patient_arr){
      $return_result = $this->db->insertData("patients",$patient_arr);


      return true;
  }
    function displayPatient(){

        return " <div class='col-md-4 col-sm-4  col-lg-3'>
    <div class='profile-widget'>
        <div class='doctor-img'>
            <a class='avatar' href='profile.php?id_patient=$this->id_patient'><img alt='' src='assets/img/user.jpg'></a>
        </div>
        <div class='dropdown profile-action'>
            <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
            <div class='dropdown-menu dropdown-menu-right'>
                <a class='dropdown-item' href='edit-doctor.html'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                <a class='dropdown-item' href='#' data-toggle='modal' data-target='#delete_doctor'><i class='fa fa-trash-o m-r-5'></i> Supprimer</a>
            </div>
        </div>
        <h4 class='doctor-name text-ellipsis'><a href='profile.php'>$this->full_name_patient</a></h4>
        <div class='doc-prof'>$this->birthdate_patient</div>
        <div class='user-country'>
            <i class='fa fa-phone'></i> $this->phone_number_patient
        </div>
    </div>
</div>";
}

function displayContactInformations(){
    return "
    <div class='profile-info-left'>
           <h3 class='user-name m-t-0 mb-0'>$this->full_name_patient</h3>
           <ul class='personal-info'>
                  <li>
                    <span class='title'>Téléphone:</span>
                    <span class='text'>$this->phone_number_patient</span>
                  </li>
                  <li>
                     <span class='title'>Date de naissance:</span>
                     <span class='text'>$this->birthdate_patient</span>
                  </li>
                  <li>
                    <span class='title'>Adresse:</span>
                    <span class='text'>$this->address_patient</span>
                  </li>
                  <li>
                    <span class='title'>Sexe:</span>
                    <span class='text'>$this->gender_patient</span>
                  </li>
           </ul>

       </div>";
}


    function displaySelectItemPatient(){
        return "<option value='$this->id_patient'>$this->full_name_patient</option>";
    }


function toString (){
      return "id_patient = " . $this->id_patient;
}






// Getters // 
  /**
   * Get the value of full_name_patient
   */ 
  public function getFull_name_patient()
  {
    return $this->full_name_patient;
  }

  /**
   * Get the value of phone_number_patient
   */ 
  public function getPhone_number_patient()
  {
    return $this->phone_number_patient;
  }

  /**
   * Get the value of gender_patient
   */ 
  public function getGender_patient()
  {
    return $this->gender_patient;
  }

  /**
   * Get the value of address_patient
   */ 
  public function getAddress_patient()
  {
    return $this->address_patient;
  }
}


?>