<?php 
define('HOSTNAME','localhost');

define('DBNAME','fmf'); 

define('DBUSER','root');

define('DBPASS','');

define('DEBUG',true);

define('SQL_PROFILING',false);

if(DEBUG){

    ini_set("display_errors", 1);

    ini_set('display_startup_errors', 1);

    error_reporting(E_ALL);

}

else {

    ini_set("display_errors", "Off");

    ini_set('display_startup_errors', "Off");

    error_reporting(0);

}

$con=mysqli_connect(HOSTNAME, DBUSER, DBPASS, DBNAME);

if(!$con){ echo "error"; }

class Db{

    public $formValues;

    public $link;

    public $result;

    public $insertId;

    public $error = false;

    public $queries = array();

    

    public function __construct(){

        if(!$this->link)

            $this->link = mysqli_connect(HOSTNAME, DBUSER, DBPASS, DBNAME);

        return $this->link;

    }

    public function __destruct(){

		if($this->getError() && DEBUG)

		   echo $this->getError();

			if ($this->link)

				   $this->disconnect();

    }

    public function disconnect(){

		$this->link->close();

    }

    public function getInsertId(){

		return $this->link->insert_id;

	}

	public function dbResultArray($result){

	if(!$result)

	    return false;

        $resArray = array();

        for($count=0; $row = $result->fetch_assoc(); $count++){

            $resArray[$count] = $row;

        }

        return $resArray;

    }

    public function getValue($q){

		$this->result = $this->query($q);

		$row = ($this->result) ? $this->result->fetch_row() : false;

		$result = ($row) ? $row[0] : false;

		return $result;

    }

	public function insert($data){

        foreach($data as $table_name => $table){

        $i=0;

        foreach($table as $entity => $vals){

            $value[$i]=$vals; $field[$i]=$entity; $i++; }

            $values = "";  $fields="";

            for($j=0;$j<$i; $j++){ if($j!=$i-1){$values .= "'".$value[$j]."',";

            $fields.="`".$field[$j]."`,";} else{$values .= "'".$value[$j]."'";

            $fields .= "`".$field[$j]."`";}}

            $this->result = $this->query("insert into $table_name($fields) values($values)");

            if(!$this->result){

                $this->error = mysqli_error($this->link);

            }

            $this->insertId = $this->link->insert_id;

            return $this->insertId ;

            }

    }

    public function update($data, $where){

		foreach($data as $table_name => $table){

			$i=0;

			$updates = "";

			foreach($table as $entity => $vals){

				$updates .= "`$entity` = '".$vals."', ";

			}

			$updates = preg_replace("/, $/","",$updates);

			$this->result = $this->query("UPDATE `$table_name` SET $updates $where") or die("error ");

			return $this->result;

        }

    }

    public function getRow($q, $cache = false){

		$this->result = $this->query($q);

		return ($this->result) ? $this->result->fetch_assoc() : false;

    }

    public function getRows($q, $cache=false){

		$this->result = $this->query($q);

		return ($this->result) ? $this->dbResultArray( $this->result ) : false;

    }

    public function profiling($q){

        echo " $q; <br>";

        $this->queries[] = $q;

    }

    public function query($q){ return $this->execute($q); }

    public function execute($q){

        if(SQL_PROFILING){

            $this->profiling($q);

        }

        return $this->link->query($q);

    }

    public function executes($q){

        if(SQL_PROFILING){

            $this->profiling($q);

        }

        return $this->link->multi_query($q);

    }

	public function getError(){

		return (empty($this->link->error)) ? false : $this->link->error;

    }    

    public function displayError(){

        echo $this->error;

    }

}

$db = new Db();

?>