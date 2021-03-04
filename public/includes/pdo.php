<?php

class dbase
{

    //Connection Properties

    private $host = "127.0.0.1";
    private $user = "root";
    private $pwd = "root";
    private $dbname = "virtualines";

    //Connection Handler

    private $dbh;

    //Error Handler
    private $error;

    //Statement Handler
    private $stmt;

    //Open our Connection

    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . "; dbname=" . $this->dbname;

        //echo $dsn;

        $options = array(

            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        //Procedural Way
        // $con = mysqli_connect($host, $user, $pwd, $dbname);

        //PDO 
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pwd, $options);
        } catch (PDOException $errorobj) {

            $this->error = $errorobj->getMessage();

            echo $this->error;
        }
    }

    //Method to handle query statement
    public function query($query){      //query("SELECT * FROM users")

       //Prepares a statement for execution and returns a statement object     
       $this->stmt = $this->dbh->prepare($query);

    }

    //Method to handle bind values, but statement has to be correct!!!!

    //Binds a value to a parameter
    public function bind($param, $value, $type){

        $this->stmt->bindValue($param,$value,$type);

    }   


    //Method to execute/run our statement

    public function execute(){

        return $this->stmt->execute();

    }

    //Method to fetch single value
    
    public function fetchSingle(){

        $this->execute();

        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Method to fetch multiple values
    public function fetchMultiple(){
        $this->execute();

        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

$dbclass = new dbase;
