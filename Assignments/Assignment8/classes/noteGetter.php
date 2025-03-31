<?php
    require_once "Db_conn.php";
    require_once "Db_methods.php";
class NoteGetter{
    public $begDate="";
    public $endDate="";

    public function __construct($begDate, $endDate){
        $this->begDate=strtotime($_POST['begDate']);
        $this->endDate=strtotime($_POST['endDate']);
    }

    public function getNotes(){
        $dbConn=new Db_conn();
        $dbConn->dbOpen();
        $pdoMethods=new PdoMethods();
        $sql="SELECT timestamp, note FROM Assignment_8 WHERE timestamp >= :begDate AND timestamp <= :endDate";
        $stmt=$dbConn->conn->prepare($sql);
        //echo "Beginning date:" . $this->begDate . "<br>";
        //echo "End date:" . $this->endDate . "<br>";
        $stmt->bindParam(':begDate',$this->begDate, PDO::PARAM_INT);
        $stmt->bindParam(':endDate',$this->endDate, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result)>0){
            echo "<table class=" . "table" . ">
                    <tr>
                        <th scope=" . "col" . ">Time and Date</th>
                        <th scope=" . "col" . ">Notes</th>
                    </tr>";

        foreach($result as $row){
            echo "<tr>
                    <td>" . date("Y-m-d H:i:s", $row["timestamp"]) . "</td>
                    <td>" . $row["note"] . "</td>
                </tr>";
        }
        echo "</table>";
    }else{
        echo "No results found.";
    }
    }
}


?>