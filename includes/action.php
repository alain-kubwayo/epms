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
        $myArray = array(
            "ConsDate" => $_POST["ConsDate"],
            "Quantity" => $_POST["Quantity"],
            "Price" => $_POST["Price"],
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

    // FEED PURCHASE

    // Create object for feed purchase
    $feedPurchaseObject = new CrudOperation();

    // Handle the save button for form submission
    if(isset($_POST["feedpurchsave"])){
        $myArray = array(
            "Date" => $_POST["Date"],
            "Quantity" => $_POST["Quantity"],
            "Price" => $_POST["Price"]
        );
        // Call the insertion method to add record to the database
        if($feedPurchaseObject->insertionMethod("FeedPurchase", $myArray)){
            header("location: ../feedPurchase.php?msg=Insertion was successfull!");
        };
    }
    // Handle the edit button for record editing
    if(isset($_POST["feedpurchedit"])){
        $id = $_POST["id"];
        $where = array("FeedPurchase_ID" => $id);
        $myArray = array(
            "Date" => $_POST["Date"],
            "Quantity" => $_POST["Quantity"],
            "Price" => $_POST["Price"]
        );
        if($feedPurchaseObject->updateMethod("FeedPurchase", $where, $myArray)){
            header("location: ../feedPurchase.php?msg=Updated Successfully!");
        }
    }

    // Check if delete button was triggered
    if(isset($_GET["feedpurchdelete"])){
        $id = $_GET["id"] ?? null;
        $where = array("FeedPurchase_ID" => $id);
        if($feedPurchaseObject->deleteMethod("FeedPurchase", $where)){
            header("location: ../feedPurchase.php?msg=Record deleted successfully!");
        }
    }

    // BIRDS PURCHASE

    // Create object for feed purchase
    $birdsPurchaseObject = new CrudOperation();

    // Handle the save button for form submission
    if(isset($_POST["birdspurchsave"])){
        $myArray = array(
            "Date" => $_POST["Date"],
            "NumberOfBirds" => $_POST["NumberOfBirds"],
            "Price" => $_POST["Price"]
        );
        // Call the insertion method to add record to the database
        if($birdsPurchaseObject->insertionMethod("BirdsPurchase", $myArray)){
            header("location: ../birdsPurchase.php?msg=Insertion was successfull!");
        };
    }
    // Handle the edit button for record editing
    if(isset($_POST["birdspurchedit"])){
        $id = $_POST["id"];
        $where = array("BirdsPurchase_ID" => $id);
        $myArray = array(
            "Date" => $_POST["Date"],
            "NumberOfBirds" => $_POST["NumberOfBirds"],
            "Price" => $_POST["Price"]
        );
        if($birdsPurchaseObject->updateMethod("BirdsPurchase", $where, $myArray)){
            header("location: ../birdsPurchase.php?msg=Updated Successfully!");
        }
    }

    // Check if delete button was triggered
    if(isset($_GET["birdspurchdelete"])){
        $id = $_GET["id"] ?? null;
        $where = array("BirdsPurchase_ID" => $id);
        if($birdsPurchaseObject->deleteMethod("BirdsPurchase", $where)){
            header("location: ../birdsPurchase.php?msg=Record deleted successfully!");
        }
    }

    // BIRDS MORTALITY

    // Create object for feed purchase
    $birdsMortalityObject = new CrudOperation();

    // Handle the save button for form submission
    if(isset($_POST["birdsmortsave"])){
        $myArray = array(
            "Date" => $_POST["Date"],
            "Deaths" => $_POST["Deaths"]
        );
        // Call the insertion method to add record to the database
        if($birdsMortalityObject->insertionMethod("BirdsMortality", $myArray)){
            $_SESSION['msg'] = "Added new record!";
            header("location: ../birdsMortality.php");
        };
    }
    // Handle the edit button for record editing
    if(isset($_POST["birdsmortedit"])){
        $id = $_POST["id"];
        $where = array("BirdsMortality_ID" => $id);
        $myArray = array(
            "Date" => $_POST["Date"],
            "Deaths" => $_POST["Deaths"]
        );
        if($birdsMortalityObject->updateMethod("BirdsMortality", $where, $myArray)){
            header("location: ../birdsMortality.php?msg=Updated Successfully!");
        }
    }

    // Check if delete button was triggered
    if(isset($_GET["birdsmortdelete"])){
        $id = $_GET["id"] ?? null;
        $where = array("BirdsMortality_ID" => $id);
        if($birdsPurchaseObject->deleteMethod("BirdsMortality", $where)){
            header("location: ../birdsMortality.php?msg=Record deleted successfully!");
        }
    }

    // EGG SALES

    // Create object for egg sales
    $salesObject = new CrudOperation();

    // Handle the save button for form submission
    if(isset($_POST["salessave"])){
        $myArray = array(
            "Date" => $_POST["Date"],
            "NumberOfEggs" => $_POST["NumberOfEggs"],
            "Revenue" => $_POST["Revenue"]
        );
        // Call the insertion method to add record to the database
        if($salesObject->insertionMethod("Sales", $myArray)){
            header("location: ../sales.php?msg=Insertion was successfull!");
        };
    }
    // Handle the edit button for record editing
    if(isset($_POST["salesedit"])){
        $id = $_POST["id"];
        $where = array("Sales_ID" => $id);
        $myArray = array(
            "Date" => $_POST["Date"],
            "NumberOfEggs" => $_POST["NumberOfEggs"],
            "Revenue" => $_POST["Revenue"]
        );
        if($salesObject->updateMethod("Sales", $where, $myArray)){
            header("location: ../sales.php?msg=Updated Successfully!");
        }
    }

    // Check if delete button was triggered
    if(isset($_GET["salesdelete"])){
        $id = $_GET["id"] ?? null;
        $where = array("Sales_ID" => $id);
        if($birdsPurchaseObject->deleteMethod("Sales", $where)){
            header("location: ../sales.php?msg=Record deleted successfully!");
        }
    }

    // EGG PRODUCTION

    // Create object for egg production
    $productionObject = new CrudOperation();

    // Handle the save button for form submission
    if(isset($_POST["productionsave"])){
        $myArray = array(
            "Date" => $_POST["Date"],
            "NumberOfEggs" => $_POST["NumberOfEggs"]
        );
        // Call the insertion method to add record to the database
        if($productionObject->insertionMethod("Production", $myArray)){
            header("location: ../production.php?msg=Insertion was successfull!");
        };
    }
    // Handle the edit button for record editing
    if(isset($_POST["productionedit"])){
        $id = $_POST["id"];
        $where = array("Production_ID" => $id);
        $myArray = array(
            "Date" => $_POST["Date"],
            "NumberOfEggs" => $_POST["NumberOfEggs"]
        );
        if($productionObject->updateMethod("Production", $where, $myArray)){
            header("location: ../production.php?msg=Updated Successfully!");
        }
    }

    // Check if delete button was triggered
    if(isset($_GET["productiondelete"])){
        $id = $_GET["id"] ?? null;
        $where = array("Production_ID" => $id);
        if($productionObject->deleteMethod("Production", $where)){
            header("location: ../production.php?msg=Record deleted successfully!");
        }
    }

    // INSIGHTS

    // Returning the total number of birds purchased
    $databaseObject = new Database();
    $query = "SELECT SUM(NumberOfBirds) AS sum FROM `BirdsPurchase`"; 
    $result = $databaseObject->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
        $totalNumberOfBirds = $row['sum'];
    };

    // Returning the total number of eggs
    $query = "SELECT SUM(NumberOfEggs) AS sum FROM `Production`";
    $result = $databaseObject->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
        $totalNumberOfEggs = $row['sum'];
    }

    // Returning the mortality rate

    $query = "SELECT SUM(Deaths) AS sum FROM `BirdsMortality`";
    $result = $databaseObject->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
        $totalDeaths = $row['sum'];
    }

    if($totalDeaths <= $totalNumberOfBirds){
        $mortalityRate = round($totalDeaths / $totalNumberOfBirds * 100 , 1);
        $totalNumberOfBirds = $totalNumberOfBirds - $totalDeaths;
    }else{
        $mortalityRate = 0;
    }
    $remainingBirds = $totalNumberOfBirds - $totalDeaths;
    
    // Returning the total number of wages
    $query = "SELECT SUM(Salary) AS sum FROM `Employee`";
    $result = $databaseObject->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
        $totalWages = $row['sum'];
    }

    // Returning total revenue
    $query = "SELECT SUM(Revenue) AS sum FROM `Sales`";
    $result = $databaseObject->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
        $sales = $row['sum'];
    }

    // Returning remaining feed in the stock
    $query = "SELECT SUM(Quantity) AS sum FROM `FeedPurchase`";
    $result = $databaseObject->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
        $totalFeedPurchased = $row['sum'];
    }

    $query = "SELECT SUM(Quantity) AS sum FROM `FeedConsumption`";
    $result = $databaseObject->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
        $totalFeedConsumed = $row['sum'];
    }
    $remainingFeed = $totalFeedPurchased - $totalFeedConsumed;

    // Returning number of eggs available for sale
    $query = "SELECT SUM(NumberOfEggs) AS sum FROM `Production`";
    $result = $databaseObject->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
        $totalEggsProduced = $row['sum'];
    }

    $query = "SELECT SUM(NumberOfEggs) AS sum FROM `Sales`";
    $result = $databaseObject->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
        $totalEggsSold = $row['sum'];
    }
    $remainingEggs = $totalEggsProduced - $totalEggsSold;

    // Getting the total number of employees working in the farm
    $query = "SELECT COUNT(*) AS sum FROM `Employee`";
    $result = $databaseObject->connect()->query($query);
    while($row = mysqli_fetch_assoc($result)){
        $totalNumberOfEmployees = $row['sum'];
    }

?>