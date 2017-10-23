<?php

class Database
{
	public function __construct($DB_NAME)
	{
            $this->con =  mysql_connect(DB_HOST,DB_USER,DB_PASS);
            if (!$this->con)
            {
                die('Could not connect: ' . mysql_error());
            }
            mysql_select_db($DB_NAME, $this->con);
	}
        
        public function query($sql)
        {
            $result = mysql_query($sql);
            return $result;
        }


        public function select($table, $columns, $where=NULL)
        {
            $fieldNames = $columns;
            if($columns != '*'){
                  $fieldNames = implode(",", $columns);
                  $query = "SELECT $fieldNames FROM $table ";
            }
            else{
                $query = "SELECT * FROM $table ";
            }
            if(isset($where))
            { 
                $query .= "WHERE $where ";
                
            }
            $ret = mysql_query($query);
            $retArray = Array();
            while($row = mysql_fetch_array($ret))
            {
                array_push($retArray, $row); 
            }
            return $retArray;
        }
        
	public function insert($table, $data)
	{
		ksort($data);
		
		$fieldNames = implode(', ', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));
		foreach ($data as $key => $value) {
                    $fieldValues = str_replace(":$key", "'".$value."'", $fieldValues);
		}
		$sth = "INSERT INTO $table ($fieldNames) VALUES ($fieldValues)";
                $result = mysql_query($sth);
                return $result;
	}
	
	public function update($table, $data, $where)
	{
		ksort($data);
		$fieldDetails = NULL;
		foreach($data as $key=> $value) {
			$fieldDetails .= "$key=:$key,";
		}
		$fieldDetails = rtrim($fieldDetails, ',');
		
		$sth = "UPDATE $table SET $fieldDetails WHERE $where";
		
		foreach ($data as $key => $value) {
			$sth = str_replace(":$key", "'".$value."'", $sth);
		}
                $result = mysql_query($sth);
                return $result;
	}
	
        public function delete($table, $where)
        {
            $q = "DELETE FROM $table WHERE $where";
            $result = mysql_query($q);
            return $result;
        }
}