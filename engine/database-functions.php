<?php

/// TODO 
/* Add Insert Delete Update Select functions */
require_once "errors.php";
class DatabaseUtility {
    private $host ,$username,$password,$options,$databaseConnection;

    // Constructor , use it to initialize the info of the database connection /// 
    function __construct($host,$username,$password){
        
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->options = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
    }
    ///  A function that connects to database using the information provided in the constructor 
     private function _connect(){
        try {

           return  new PDO($this->host,$this->username,$this->password,$this->options);
        } catch (Exception $e) {
                echo $e->getMessage();
        }
    }

    /// A function used to disconnect the database provided in args .. 
     function _disconnect(){
            $this->databaseConnection = null;
    }
    /// A function that takes 
    private function private_insertData ($table ,$stringColumns, $prepareValues , $arrayData ){
        //connect to database ..    
        $this->databaseConnection = $this->_connect();


        //creér la valeur de saisie
        $insert_string = "INSERT INTO ".$table."(".$stringColumns.") VALUES (".$prepareValues.")";

        //prepare the request
        $prepared_stm = $this->databaseConnection->prepare($insert_string);
        try {
            //execute request
            $prepared_stm->execute($arrayData);
        }
         catch (Exception $e){
             //return false in case of errors 
            return $this->returnResult(true,errors::sqlinsert,$e->getMessage());
        }


        // return true if everything is cool 

        return $this->returnResult(true,errors::sqlsuccess,"");
    }

   public function convertArrayToString($arrayData){
        //init values 
        $stringColumns ="";
        $prepareValues="";
        //copie values 
        foreach($arrayData as $key => $value){
                $stringColumns = $stringColumns.$key.",";
                $prepareValues = $prepareValues.":".$key.",";
            }
            // remove the last added , 
        $stringColumns = rtrim($stringColumns,",");
        $prepareValues = rtrim($prepareValues,",");

        $return_array = array(
            "stringColumns" => $stringColumns,
            "prepareValues" => $prepareValues
        );
    
        return $return_array;
    }
    public function insertData($table ,$arrayData){
    
        $string_prepared_values = $this->convertArrayToString($arrayData);

        return $this->private_insertData($table,$string_prepared_values['stringColumns'],$string_prepared_values['prepareValues'],$arrayData);

    }
    
    public function selectData($table,$stringvalues,$condition=1,$limit=""){
        //connection
        $this->databaseConnection = $this->_connect();

        //query string
        $selectString ="SELECT  $stringvalues FROM $table  WHERE $condition  $limit";
        //prepare statement
        $prepared_stm = $this->databaseConnection->prepare($selectString);
        
        //variable to store selected data
        $selectedValues =  array();
        try {
            $result = $prepared_stm->execute();
            
            // PUSH results to selected data array 
            while($result_row = $prepared_stm->fetch(PDO::FETCH_ASSOC) )
                    array_push($selectedValues ,$result_row);
        }catch(Exception $e){
            //return errors with msg
            return $this->returnResult(false,errors::sqlselect,$e->getMessage());
        }

        //disconnect database
        
        //return values
        return array(
            "success"  => true,
            "result" => $selectedValues
        );
    
    }


    public function deleteData($table ,$condition){
        //connection
            $this->databaseConnection = $this->_connect();
        //query string duh .. 
            $queryString = "DELETE from $table WHERE $condition" ;
        //prepare statement 
            $prepared_stm = $this->databaseConnection->prepare($queryString);

            try{
                // execute statement and catch possible errorss ... 
                $prepared_stm->execute();

            }
            catch(Exception $e){ //  return delete errors 
                return $this->returnResult(false,errors::sqldelete,$e->getMessage());
            }
            //disconnect
            
            //return result //
            return $this->returnResult(true,errors::sqlsuccess,"");

    }
    
    private function private_updateData($table ,$condition,$stringColumns){
        // connection
        $this->databaseConnection = $this->_connect();
        //string query 
        $stringQuery = "UPDATE $table set $stringColumns WHERE $condition";
        //prepare statement
        $prepared_stm = $this->databaseConnection->prepare($stringQuery);

        try {
            //execute statement 
            $prepared_stm->execute($arrayData);
        } catch(Exception $e){
            //return errors 
            return $this->returnResult(false,errors::updateData,$e->getMessage());
        }
        //disconnect database 
        
        //return success 
        return $this->returnResult(true,errors::sqlsuccess,"");
    }

    public function updateData($table , $condition, $arrayData){
        //init string columns
        $stringColumns ="";
        //copie values to the string 
        foreach($arrayData as $key => $value )
            $stringColumns = $stringColumns ."$key = :$key , ";
        //remove last ' , ' 
            $stringColumns = rtrim($stringColumns ,",");
        //call the private function 
        $this->private_updateData($table,$condition,$stringColumns,$arrayData);
    

    }

    function returnResult($success_value  , $errors,$msg){

        return array(
            "success" => $success_value,
            $errors => $msg
        );
    }

    function getLastInsertedId(){

        return $this->databaseConnection->lastInsertId();
    }


    function customQuery($stringQuery){
      
        $this->databaseConnection = $this->_connect();

        $prepared_stm = $this->databaseConnection->prepare($stringQuery);

        try{
            $selectedValues = array();

             $prepared_stm->execute();

            while($result_row = $prepared_stm->fetch(PDO::FETCH_ASSOC) )
            array_push($selectedValues ,$result_row);

            return array(
                "success" => true,
                "result" => $selectedValues
            );
        }
        catch(Exception $e){
           
            echo $e->getMessage();
        }
        
    }

}


?>