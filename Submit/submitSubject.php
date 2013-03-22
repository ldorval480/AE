<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/common.css">
</head>
<body>
<?php
$con = new mysqli('localhost', 'root', '', "academicenrichment");
if ($con->connect_errno)
{
    die('Could not connect: ' . $con->connect_error);
}

$myQuery = "SELECT Name FROM subject
            WHERE Name ='".$_POST['name']."'";

$result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);
if($result->num_rows > 0)
{
    echo "<p>Subject already exists</p>";

}else{
    $sql ="INSERT INTO subject (Name)
VALUES ('$_POST[name]')";

    if (!$con->query($sql))
    {
        die('Error: ' . $con->error);
    }
    echo "<p>Subject record added</p>";

    $con->close();
}


?>

<a href="../Manage/manageSubject.phtml">Return to Subject page.</a>

</body>
</html>

