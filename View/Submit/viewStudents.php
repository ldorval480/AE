<html>
    <head>
        <title>View Student</title>
    </head>

    <body>
        <?php
        $con = new mysqli('localhost', 'root', '', "academicenrichment");
        if ($con->connect_errno)
        {
            die('Could not connect: ' . $con->connect_error);
        }

        if($_POST['grade'] === 'all')
        {
            $myQuery = "SELECT Student_FirstName, Student_LastName, Student_ID FROM student";
        }else{
            $myQuery = "SELECT Student_FirstName, Student_LastName, Student_ID FROM student
                    WHERE Grade='".$_POST['grade']."'";
        }

        if($result = $con->query($myQuery))
        {
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                printf("<a href='../viewStudent.php?id=%s'>%s, %s</a>",$row["Student_ID"], $row["Student_FirstName"], $row["Student_LastName"]);
            }

        }

        $con->close();
        ?>
    </body>
</html>