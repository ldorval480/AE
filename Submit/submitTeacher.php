<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/add-student.css">
        <title>Add Teacher</title>
    </head>

    <body>
    <?
        $con = new mysqli('localhost', 'root', '', "academicenrichment");
        if ($con->connect_errno)
        {
            die('Could not connect: ' . $con->connect_error);
        }

        $myQuery = "SELECT FirstName, LastName FROM teacher
                    WHERE FirstName ='".$_POST['first_name']."'
                    AND LastName ='".$_POST['last_name']."'";

        $result = $con->query($myQuery) or die($myQuery."<br/><br/>".mysql_error());
        if($result->num_rows > 0)
        {
            echo "<p>Teacher already exists</p>";
        }else{
            if($_POST['admin'] == "admin"){
                $admin = true;
            }else{
                $admin = false;
            }

            $sql ="INSERT INTO teacher (FirstName, LastName, TeacherEmail, AdminFlag)
        VALUES ('$_POST[first_name]', '$_POST[last_name]', '$_POST[teacher_email]', ".$admin.")
        ";

            if (!$con->query($sql))
            {
                die('Error: ' . $con->error);
            }
            echo "<p>Teacher record added</p>";

            $con->close();
        }

    ?>
    <a href="../index.phtml">Return to Main page.</a>
    </body>
</html>