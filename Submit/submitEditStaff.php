<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/add-student.css">
    <title>Edit Staff</title>
</head>

<body>
<?
$con = new mysqli('localhost', 'root', '', "academicenrichment");
if ($con->connect_errno)
{
    die('Could not connect: ' . $con->connect_error);
}

    $admin = false;
    $teacher = false;
    $cea = false;

    if(isset($_POST['role'])){ $admin = true;}
    if(isset($_POST['teach'])){ $teacher = true;}
    if(isset($_POST['cea'])){ $cea = true;}

    if($admin == false && $teacher == false && $cea == false)
    {
        echo "<p>Must have a role</p>";
        echo "<FORM><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'></FORM>";
    }else{

        $sql ="UPDATE staff
            SET FirstName='".$_POST['first_name']."' , LastName='".$_POST['last_name']."' , TeacherEmail='".$_POST['email'].
            "' , AdminFlag='".$admin."' , TeacherFlag='".$teacher."' , CeaFlag='".$cea."'
            WHERE ID=".$_GET['id'];


        if (!$con->query($sql))
        {
            die('Error: ' . $con->error);
        }
        echo "<p>Staff Record Updated</p>";

        $con->close();
        echo "<a href='../View/viewStaff.php'>Return to Staff page.</a>";

    }


?>
</body>
</html>