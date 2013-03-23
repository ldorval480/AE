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

$myQuery = "SELECT ID FROM student
            WHERE FullName ='".$_POST['student_name']."'";

$result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);
if($result->num_rows < 0)
{
    echo "<p>Student does not exist please <a href='../Add/addStudent.phtml'>add student</a> or <a href='../Add/addDetention.php'> try again</a></p>";
}
$row = $result->fetch_array(MYSQL_ASSOC);
$sID = $row['ID'];

$result->free_result();

$myQuery = "SELECT ID FROM staff
            WHERE FullName ='".$_POST['teacher_name']."'";
$result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);
$row = $result->fetch_array(MYSQL_ASSOC);
$tID = $row['ID'];
if($result->num_rows < 0)
{
    echo "<p>Teacher does not exist please <a href='../Add/addDetention.php'>try again</a></p>";
}
else{
    $sql ="INSERT INTO detention (StartDate, Block, Student_ID, Teacher_ID, Description)
VALUES ('date(Y/m/d)', '$_POST[block]', '$sID', '$tID', '$_POST[description]')
";

    if (!$con->query($sql))
    {
        die('Error: ' . $con->error);
    }
    echo "<p>Detention record added</p>";

    $con->close();
}


?>

<a href="../Manage/manageDetention.phtml">Return to Student page.</a>

</body>
</html>

