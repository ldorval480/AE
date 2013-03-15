<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/view-student.css">
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



        $myQuery = "SELECT FirstName, LastName, ID FROM staff ORDER BY LastName asc";


    if($result = $con->query($myQuery))
    {
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            printf("<a href='../viewStaffMember.php?id=%s'>%s, %s</a>",$row["ID"], $row["LastName"], $row["FirstName"]);
        }

    }

    $con->close();
    ?>
</div>
</body>
</html>