<?php
include 'includes/dbh.php';
include 'includes/action.php';
?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_head.php";?>
<body id="body">
    <div class="container">
        <!-- top navbar -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_top_navbar.php";?>
        <main>
            <div class="main__container">
                <table>
                    <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Job</th>
                        <th>Salary</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                    <?php
                        // calling viewEmployee method
                        $myrow = $obj->viewEmployee("Employee");
                        foreach($myrow as $row){
                            // breaking point
                            ?>
                            <tr>
                                <td><?php echo $row['FirstName'];?></td>
                                <td><?php echo $row['LastName'];?></td>
                                <td><?php echo $row['Phone'];?></td>
                                <td><?php echo $row['Job'];?></td>
                                <td><?php echo $row['Salary'];?></td>
                                <td>
                                    <a class="edit_btn" href="payroll.php?update=1&id=<?php echo $row["Employee_ID"]; ?>">Edit</a>
                                </td>
                                <td>
                                    <a class="del_btn" href="includes/action.php?delete=1&id=<?php echo $row["Employee_ID"]; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
                
                <?php
                    if(isset($_GET["update"])){
                        // Get the Employee_ID for the employee record to be edited
                        $id = $_GET["id"] ?? null;
                        $where = array("Employee_ID" => $id);
                        // Call the selectEmployee method that displays the record to be edited
                        $row = $obj->selectEmployee("Employee", $where);
                        ?>
                            <form action="includes/action.php" method="post">
                                <div class="input-group">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="">First Name</label>
                                    <input type="text" name="FirstName" value="<?php echo $row["FirstName"]; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="">Last Name</label>
                                    <input type="text" name="LastName" value="<?php echo $row["LastName"]; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="">Phone</label>
                                    <input type="text" name="Phone" value="<?php echo $row["Phone"]; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="">Job</label>
                                    <input type="text" name="Job" value="<?php echo $row["Job"]; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="">Salary</label>
                                    <input type="text" name="Salary" value="<?php echo $row["Salary"]; ?>">
                                </div>
                                <div class="input-group">
                                    <button type="submit" name="edit" class="btn" value="">Update</button>
                                </div>
                            </form>
                        <?php
                    }else{
                        ?>
                            <form action="includes/action.php" method="post">
                                <div class="input-group">
                                    <label for="">First Name</label>
                                    <input type="text" name="FirstName" value="">
                                </div>
                                <div class="input-group">
                                    <label for="">Last Name</label>
                                    <input type="text" name="LastName" value="">
                                </div>
                                <div class="input-group">
                                    <label for="">Phone</label>
                                    <input type="text" name="Phone" value="">
                                </div>
                                <div class="input-group">
                                    <label for="">Job</label>
                                    <input type="text" name="Job" value="">
                                </div>
                                <div class="input-group">
                                    <label for="">Salary</label>
                                    <input type="text" name="Salary" value="">
                                </div>
                                <div class="input-group">
                                    <button type="submit" name="save" class="btn">Save</button>
                                </div>
                            </form>
                        <?php
                    }
                        ?>
            </div>
        </main>
        <!-- sidebar nav -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_side_bar.php";?>
    </div>
</body>
</html>