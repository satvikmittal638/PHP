
<?php
$serverName = "localhost";
$username = "root";
$password = "";
$conn;
makeConn($serverName,$username, $password);

createDb($serverName, $username, $password,"satvik");
makeTable("CREATE TABLE TBL1(
        ID INTEGER PRIMARY KEY AUTO_INCREMENT,
        NAME VARCHAR(20) NOT NULL,
        CLASS INT(1) NOT NULL,
        AADHAR_NO INT(12) UNIQUE
    )");

// TODO resolve unknown column error when using name
// insert(["class", "aadhar_no"], [ 12, 938299], "`tbl1`");
select("tbl1");

update("tbl1", "aadhar_no", "`ID` = 4", 98765);

delete("tbl1", "`id`= 4", null);
 
?>



<?php
// Functions
    function makeConn($serverName,$username, $password){
        global $conn;
        $conn = mysqli_connect($serverName,$username, $password);
        
        // Checking for a successfull connection
        if($conn){
            echo "Connection was made successfully";
        }else{
            die("Sorry we failed to connect ".mysqli_connect_error());
        }
        echo "<br>";
    }

    function createDb($serverName, $username, $password, $dbName){
        global $conn;
        $createDbQuery = "CREATE DATABASE ".$dbName;
        $dbIsCreated = mysqli_query($conn, $createDbQuery);

        // Checking for successful database creation
        if($dbIsCreated){
            echo "Database was created successfully";
        }
        else{
            echo "Database wasn't created successfully due to ".mysqli_error($conn);
        }
        mysqli_select_db($conn, $dbName);
        echo "<br>";
    }

    function makeTable($query){
        global $conn;
        $isTableMade = mysqli_query($conn, $query);

        if($isTableMade){
            echo "Table was made successfully";
        }
        else{
            echo "Table couldn't be created due to ".mysqli_error($conn);
        }
        echo "<br>";
    }

    function insert($columns, $values, $tableName){
        global $conn;
        
        $query = "INSERT INTO $tableName(";

        // Attaching columns
        foreach ($columns as $index => $column) {
            $query .= "`".$column."`";
            // To prevent a comma after the last column name
            if($index!=count($columns)-1){
                 $query.=",";
            }
        }
        $query.=") values (";

        // Attaching values
        foreach ($values as $index => $value) {
            if(is_string($value) && (strtolower($value) != "null"))
                $query.="`"."$value"."`";
            else
                $query.="$value";

            if($index!=count($values)-1){
                $query = $query.",";
            }
            
        }

        $query.=")";
        echo $query."<br>";
        $queryIsExecuted = mysqli_query($conn, $query);

        if($queryIsExecuted){
            echo "Data was inserted successfully";
        }else{
            echo "Sorry the data couldn't be inserted due to ".mysqli_error($conn);
        }

        echo "<br>";
    }

    function select($tableName){
        global $conn;
        $query = "SELECT * FROM "."`".$tableName."`";
        $dataFetched = mysqli_query($conn, $query);
        $numOfRows = mysqli_num_rows($dataFetched);
        if($numOfRows > 0)
        {
            echo "$numOfRows rows were fetched<br>";
            // loops automatically stops if the onditions becomes null
            while($row = mysqli_fetch_assoc($dataFetched)){
                var_dump($row);
                echo "<br>";
                echo  json_encode($row)."<br>";
            }
        }else{
            echo "Sorry, no records are available yet";
        }
    }

    function update($tableName, $column, $condition, $newValue){
        global $conn;
        if(is_string($newValue)){
            $newValue = "`$newValue`";
        }
        $query = "UPDATE `$tableName` SET `$column` = $newValue WHERE $condition";
        $isUpdated = mysqli_query($conn, $query);
        $affectedRows = mysqli_affected_rows($conn);
        if($isUpdated){
            echo "$affectedRows row(s) were updated successfully";
        }else{
            echo "We couldn't update due to ".mysqli_error($conn);
        }

    }

    function delete($tableName, $condition, $limit){
        global $conn;
        $query = "DELETE FROM `$tableName` WHERE $condition ";
        if(is_integer($limit)){
            $query .= "LIMIT $limit";
        }
        $result = mysqli_query($conn, $query);

        if($result){
            $affectedRows = mysqli_affected_rows($conn);
            echo "$affectedRows rows were deleted successfully";
        }else{
            echo mysqli_error($conn);
        }

    }
?>