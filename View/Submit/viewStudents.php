<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../css/view-student.css">
        <title>View Student</title>
    </head>

    <body>
    <div class="view-students">
        <?
        $con = new mysqli('localhost', 'root', '', "academicenrichment");
        if ($con->connect_errno)
        {
            die('Could not connect: ' . $con->connect_error);
        }

        if($_POST['grade'] === 'all')
        {
            echo "<h1>All Students</h1>";
            $myQuery = "SELECT FirstName, LastName, ID FROM student ORDER BY LastName asc";
        }else{
            echo "<h1>Grade ".$_POST['grade']." Students</h1>";
            $myQuery = "SELECT FirstName, LastName, ID FROM student
                    WHERE Grade='".$_POST['grade']."' ORDER BY LastName asc";
        }

        if($result = $con->query($myQuery))
        {
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                printf("<a href='../viewStudent.php?id=%s'>%s, %s</a>",$row["ID"], $row["LastName"], $row["FirstName"]);
            }

        }

        $con->close();
        ?>
    </div>
    </body>
</html>