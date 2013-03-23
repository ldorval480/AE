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

$myQuery = "SELECT FirstName, LastName FROM student
            WHERE FirstName ='".$_POST['first_name']."'
            AND LastName ='".$_POST['last_name']."'";

$result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);
if($result->num_rows > 0)
{
    echo "<p>Student already exists</p>";

}else{
    $fullName = $_POST['first_name']." ".$_POST["last_name"];
    $sql ="INSERT INTO student (FirstName, LastName, Grade, StudentEmail, ParentEmail, ParentEmail2, FullName)
VALUES ('$_POST[first_name]', '$_POST[last_name]', '$_POST[grade]', '$_POST[student_email]', '$_POST[parent_email]', '$_POST[parent_email2]', '$fullName')
";

    if (!$con->query($sql))
    {
        die('Error: ' . $con->error);
    }
    echo "<p>Student record added</p>";

    $con->close();
}


?>

<a href="../Manage/manageStudent.phtml">Return to Student page.</a>

</body>
</html>

