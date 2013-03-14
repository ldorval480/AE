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
        ?>
        <form action="../Submit/viewStudents.php" method="POST">
        <select name="grade">
            <option value="8">8th Gr</option>
            <option value="9">9th Gr</option>
            <option value="10">10th Gr</option>
            <option value="11">11th Gr</option>
            <option value="12">12th Gr</option>
            <option value="all">All</option>
        </select>

        <input type="submit" value="Submit">
        </form>
        <?
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