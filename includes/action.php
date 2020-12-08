<?php
    include_once "database.php";
    class CrudOperation extends Database{
        // Insertion method 
        public function insertionMethod($table, $fields){
            // "INSERT INTO table_name (, , ) VALUES ('','')";
            $sql = "";
            $sql .="INSERT INTO " . $table;
            $sql .= " (".implode(",", array_keys($fields)).") VALUES ";
            $sql .= "('".implode("','", array_values($fields))."')";
            // Execute the query
            $query = $this->connect()->query($sql);
            if($query){
                return true;
            }
        }
        // Method to Fetching data from the database
        public function viewMethod($table){
            // Writing the query
            $sql = "SELECT * FROM " . $table;
            $array = array();
            // Query execution
            $query = $this->connect()->query($sql);
            while($row = mysqli_fetch_assoc($query)){
                $array[] = $row;
            }
            return $array;
        }
        // Method to edit data 
        public function selectMethod($table,$where){
            $sql = "";
            $condition = "";
            foreach($where as $key => $value){
                // id = '5' AND FirstName = 'somename'
                // Concatenate the condition to dynamically generate id when edit button is clicked
                $condition .= $key . "='" . $value . "' AND ";
            }
            // Remove the last 5 characters from the condition
            $condition = substr($condition, 0, -5);
            // SELECT query
            $sql .= "SELECT * FROM " .$table. " WHERE " . $condition;
            // Execute SELECT query
            $query = $this->connect()->query($sql);
            $row = mysqli_fetch_array($query);
            return $row;           
        }
        // Method to update data
        public function updateMethod($table, $where, $fields){
            $sql = "";
            $condition = "";
            foreach($where as $key => $value){
                // id = '5' AND FirstName = 'somename'
                // Concatenate the condition to dynamically generate id when edit button is clicked
                $condition .= $key . "='" . $value . "' AND ";
            }
            $condition = substr($condition, 0, -5);
            foreach($fields as $key => $value){
                // UPDATE table SET FirstName = '', LastName = '' WHERE id = '';
                $sql .= $key . "='" . $value . "', ";
            }
            // Remove extra , and space from the sql query above
            $sql = substr($sql, 0, -2);
            // Full/concatenated query to be executed
            $sql = "UPDATE " . $table . " SET " . $sql . " WHERE " . $condition;
            // Execute the query
            if($query = $this->connect()->query($sql)){
                return true;
            }
        }
        // Deletion method
        public function deleteMethod($table, $where){
            $sql = "";
            $condition = "";
            foreach($where as $key => $value){
                $condition .= $key . "='" . $value . "' AND ";
            }
            $condition = substr($condition, 0, -5);
            $sql = "DELETE FROM " . $table . " WHERE " . $condition;
            if($query = $this->connect()->query($sql)){
                return true;
            }
        }
    }


    $employeeObject = new CrudOperation();

    // Handle the save button for form submission
    if(isset($_POST["save"])){
        $myArray = array(
            "FirstName" => $_POST["FirstName"],
            "LastName" => $_POST["LastName"],
            "Phone" => $_POST["Phone"],
            "Job" => $_POST["Job"],
            "Salary" => $_POST["Salary"]
        );
        // Call the insertion method to add record to the database
        if($employeeObject->insertionMethod("Employee", $myArray)){
            header("location: ../payroll.php?msg=Insertion was successfull!");
        };
    }
    // Handle the edit button for record editing
    if(isset($_POST["edit"])){
        $id = $_POST["id"];
        $where = array("Employee_ID" => $id);
        $myArray = array(
            "FirstName" => $_POST["FirstName"],
            "LastName" => $_POST["LastName"],
            "Phone" => $_POST["Phone"],
            "Job" => $_POST["Job"],
            "Salary" => $_POST["Salary"]
        );
        if($employeeObject->updateMethod("Employee", $where, $myArray)){
            header("location: ../payroll.php?msg=Updated Successfully!");
        }
    }

    // Check if delete button was triggered
    if(isset($_GET["delete"])){
        $id = $_GET["id"] ?? null;
        $where = array("Employee_ID" => $id);
        if($employeeObject->deleteMethod("Employee", $where)){
            header("location: ../payroll.php?msg=Record deleted successfully!");
        }
    }

    // FEED CONSUMPTION

    // New object to call methods on FeedConsumption table
    $feedConsumptionObject = new CrudOperation();

    if(isset($_POST["feedconssave"])){
        $foreignID = $_POST["Employee"];
        // $assignedEmp = $_POST["Employee"];
        $myArray = array(
            "ConsDate" => $_POST["ConsDate"],
            "Quantity" => $_POST["Quantity"],
            "Price" => $_POST["Price"],
            // "Employee" => $foreignID
            "Employee" => $foreignID
        );
        // Call the insertion method to add record to the database
        if($feedConsumptionObject->insertionMethod("FeedConsumption", $myArray)){
            header("location: ../feedConsumption.php?msg=Insertion was successfull!");
        };
    }

    // Handle the edit button for record editing
    if(isset($_POST["feedconsedit"])){
        $id = $_POST["id"];
        $where = array("FeedConsumption_ID" => $id);
        $myArray = array(
            "ConsDate" => $_POST["ConsDate"],
            "Quantity" => $_POST["Quantity"],
            "Price" => $_POST["Price"],
            "Employee" => $_POST["Employee"]
        );
        if($feedConsumptionObject->updateMethod("FeedConsumption", $where, $myArray)){
            header("location: ../feedConsumption.php?msg=Updated Successfully!");
        }
    }
    // Check if delete button was triggered
    if(isset($_GET["feedconsdelete"])){
        $id = $_GET["id"] ?? null;
        $where = array("FeedConsumption_ID" => $id);
        if($feedConsumptionObject->deleteMethod("FeedConsumption", $where)){
            header("location: ../feedConsumption.php?msg=Record deleted successfully!");
        }
    }
?>