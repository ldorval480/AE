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

    $myQuery = "SELECT * FROM subject ORDER BY Name asc";


    if($result = $con->query($myQuery))
    {
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                printf("<a href='viewSubject.php?id=%s'>%s</a>",$row["ID"], $row["Name"]);
            }
        }else{
            echo "<p>There are no Subjects Currently</p>";
        }

    }

    $con->close();
    ?>
</div>
</body>
</html>