<?php
require_once 'database-logs.php';
require_once 'database-functions.php';

class TableHundler
{
    private $indexArray = [];
    private $valuesArray =[];
    private $header =[];
    private $options;
    private $db ;

    public function __construct($header, $indexArray,$valuesArray, $options = array()){
        $db = new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
        $this->header = $header;
        $this->indexArray = $indexArray;
        $this->valuesArray =$valuesArray;
        $this->options = $options;
    }

    public function displayTable(){
        $head = "<tr>";
        $body = "";
        foreach ($this->header as $index){
            $head .= "<th>$index</th>";
        }

        $head .= "</tr>";

        foreach ($this->valuesArray as $key => $value){
            $body .= "<tr>";
            $array = (array)$value;
            foreach ($this->indexArray as $i)
            $body .= "<td>$array[$i]</td>";
           
            if ($this->options != $array) {
                $body .= "<td class=' dontprint text-right'>
											<div class='dropdown dropdown-action'>
												<a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
												<div class='dropdown-menu dropdown-menu-right'>";

                foreach ($this->options as $option) {
                    if(isset($option["redirect"]))
                    $body .= "<a class='dropdown-item' href='" . $option['redirect'] . "?id_appointment=" . $array['id_appointment'] . "'><i class='fa fa-pencil m-r-5'></i>" . $option["name"] . "</a>";
                    else if(isset($option["data-target"]))
                        $body .= "<a class='dropdown-item' href='#' data-toggle='modal' data-target='".$option['data-target']."'><i class='fa fa-trash-o m-r-5'></i> Delete</a>";
                }
                $body .= "</div></div></td>";
            }
            $body .= "</tr>";
        }

        return "
        	<table class='table table-striped custom-table'>
			   <thead>$head</thead>
				<tbody>$body</tbody>
			</table>
        ";

    }

}