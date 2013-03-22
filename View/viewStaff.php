<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/views.css">
    <title>View Staff</title>
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

    <form action="viewStaff.php" method="POST">
        <label>Role: </label>
        <select name="role">
            <option value="TeacherFlag">Teacher</option>
            <option value="AdminFlag">Admin</option>
            <option value="CeaFlag">CEA</option>
            <option value="all">All</option>
        </select>

    <input type="submit" value="Submit">
    </form>

    <?
    if($_POST['role'] === 'all')
    {
        echo "<h1>All Staff</h1>";
        $myQuery = "SELECT FirstName, LastName, ID FROM staff ORDER BY LastName asc";
    }else{
        if($_POST['role'] == "TeacherFlag"){echo "<h1>Teachers</h1>";
        }else if($_POST['role'] == "AdminFlag") {  echo "<h1>Admins</h1>";
        }else if($_POST['role'] == "CeaFlag") { echo "<h1>CEAs</h1>"; }
        $myQuery = "SELECT FirstName, LastName, ID FROM staff
                    WHERE ".$_POST['role']."= true ORDER BY LastName asc";
    }



    if($result = $con->query($myQuery))
    {
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            printf("<a href='viewStaffMember.php?id=%s'>%s, %s</a>",$row["ID"], $row["LastName"], $row["FirstName"]);
        }

    }

    $con->close();
    ?>
</div>
</body>
</html>