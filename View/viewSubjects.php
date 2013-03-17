<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/views.css">
    <title>View Subject</title>
</head>

<body>
<div class="view-students">
    <?
    $con = new mysqli('localhost', 'root', '', "academicenrichment");
    if ($con->connect_errno)
    {
        die('Could not connect: ' . $con->connect_error);
    }



    $myQuery = "SELECT * FROM subject ORDER BY Name asc, Block asc";


    if($result = $con->query($myQuery))
    {
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            printf("<a href='viewSubject.php?id=%s'>%s, %s</a>",$row["ID"], $row["Name"], $row["Block"]);
        }

    }

    $con->close();
    ?>
</div>
</body>
</html>