<?php
require_once 'database-logs.php';
require_once 'database-functions.php';

class InputHandler {
    private $indexArray = [];
    private $valuesArray =[];
    private $db ;

    public function __construct($indexArray,$valuesArray){
        $db = new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
        $this->indexArray = $indexArray;
        $this->valuesArray =$valuesArray;
    }

    public function checkEmpty(){
        $emptyIndex = array();
        forEach($this->valuesArray as $index => $val){
            if(empty($val)){
                array_push($emptyIndex,$index);
            }
        }
        return $emptyIndex;
    }

        
    public function insertInputs($tableName){
        $return_result =  $db->insertData($tableName,$valuesArray);
 
        if($return_result["success"]!=true){
            print_r($return_result);
        }
     }
    
}