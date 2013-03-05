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

$myQuery = "SELECT Student_FirstName, Student_LastName FROM student
            WHERE Student_FirstName ='".$_POST['first_name']."'
            AND Student_LastName ='".$_POST['last_name']."'";

$result = $con->query($myQuery) or die($myQuery."<br/><br/>".mysql_error());
if($result->num_rows > 0)
{
    echo "<p>Student already exists</p>";

}else{
    $sql ="INSERT INTO student (Student_FirstName, Student_LastName, Grade, Student_Email, Parent_Email)
VALUES ('$_POST[first_name]', '$_POST[last_name]', '$_POST[grade]', '$_POST[student_email]', '$_POST[parent_email]')
";

    if (!$con->query($sql))
    {
        die('Error: ' . $con->error);
    }
    echo "<p>Student record added</p>";

    $con->close();
}


?>

<a href="../index.phtml">Return to Main page.</a>

</body>
</html>

