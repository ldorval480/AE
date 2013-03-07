<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/add-student.css">
        <title>Edit Student</title>
    </head>

    <body>
        <h1>Edit Student</h1>
        <?
            $con = new mysqli('localhost', 'root', '', "academicenrichment");

            if ($con->connect_errno)
            {
                die('Could not connect: ' . $con->connect_error);
            }


            $myQuery = "SELECT * FROM student
                            WHERE ID ='". $_GET['id']."'";

            $result = $con->query($myQuery) or die($myQuery."<br/><br/>".mysql_error());

            $row = $result->fetch_array(MYSQLI_ASSOC);
        ?>

        <form action =<?="../Submit/submitEditStudent.php?id=".$_GET['id']?> method="POST">
            <div class="form-piece">
                <label>First Name:</label>
                <input type="text" name="first_name" value=<?= $row['FirstName'] ?>>
            </div>

            <div class="form-piece">
                <label>Last Name:</label>
                <input type="text" name="last_name" value=<?= $row['LastName'] ?>>
            </div>

            <div class="form-piece">
                <label>Grade:</label>
                <input type="text" name="grade" value=<?= $row['Grade'] ?>>
            </div>

            <div class="form-piece">
                <label>Student Email:</label>
                <input type="text" name="student_email" value=<?= $row['StudentEmail'] ?>>
            </div>

            <div class="form-piece">
                <label>Parent Email:</label>
                <input type="text" name="parent_email" value=<?= $row['ParentEmail'] ?>>
            </div>

            <div class="form-piece">
                <label>Second Parent Email:</label>
                <input type="text" name="parent_email2" value=<?= $row['ParentEmail2'] ?>>
            </div>

            <input type="submit" value="Submit">
        </form>
    </body>
</html>