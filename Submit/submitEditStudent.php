<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/common.css">
</head>
<body>
<?
$con = new mysqli('localhost', 'root', '', "academicenrichment");
if ($con->connect_errno)
{
    die('Could not connect: ' . $con->connect_error);
}


    $sql ="UPDATE student
            SET FirstName='".$_POST['first_name']."' , LastName='".$_POST['last_name']."' , Grade='".$_POST['grade'].
            "' , StudentEmail='".$_POST['student_email']."' , ParentEmail='".$_POST['parent_email']."' , ParentEmail2='".$_POST['parent_email2']."'
            WHERE ID=".$_GET['id'];

    if (!$con->query($sql))
    {
        die('Error: ' . $con->error);
    }
    echo "<p>Student record changed</p>";

    $con->close();


?>

<a href="../View/Form/viewStudentsForm.phtml">Return to Students.</a>

</body>
</html>

