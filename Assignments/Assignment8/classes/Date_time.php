<?php
    require_once "Db_conn.php";
    require_once "Db_methods.php";
    class Date_time{
        public $dateTime;

        public function __construct($dateTime){
            $this->dateTime = strtotime($_POST['dateTime']);
        }

        public function checkSubmit(){
            if (!empty($_POST['Note'])&&!empty($_POST['dateTime'])){
                $dbConn=new Db_conn();
                $dbConn->dbOpen();
                $pdoMethods=new PdoMethods();
                $sql= "INSERT INTO Assignment_8 (timestamp, note) VALUES (:dateTime, :Note)";
                $stmt=$dbConn->conn->prepare($sql);
                $stmt->bindParam(':dateTime', $this->dateTime);
                $stmt->bindParam(':Note',$_POST['Note']);
                $stmt->execute();
            } else if(empty($_POST['Note'])) {
                echo "Text not present.";
            } else if(empty($_POST['dateTime'])){
                echo "Date and time not present.";
            }
        }
    }
?>