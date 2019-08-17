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
            if(empty($val) && in_array($index,$this->indexArray)){
                array_push($emptyIndex,$index);
            }
        }
        return $emptyIndex;
    }

        

    
}