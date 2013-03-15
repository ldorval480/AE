<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/add-student.css">
        <title>Add Teacher</title>
    </head>

    <body>
    <?
        $con = new mysqli('localhost', 'root', '', "academicenrichment");
        if ($con->connect_errno)
        {
            die('Could not connect: ' . $con->connect_error);
        }

        $myQuery = "SELECT FirstName, LastName FROM staff
                    WHERE FirstName ='".$_POST['first_name']."'
                    AND LastName ='".$_POST['last_name']."'";

        $result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);
        if($result->num_rows > 0)
        {
            echo "<p>Teacher already exists</p>";
            echo "<a href='../Manage/manageStaff.phtml'>Return to Teacher page.</a>";
        }else{
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

            $sql ="INSERT INTO staff (FirstName, LastName, TeacherEmail, AdminFlag, TeacherFlag, CeaFlag)
        VALUES ('$_POST[first_name]', '$_POST[last_name]', '$_POST[teacher_email]', '".$admin."', '".$teacher."', '".$cea."')";

            if (!$con->query($sql))
            {
                die('Error: ' . $con->error);
            }
            echo "<p>Teacher record added</p>";

            $con->close();
            echo "<a href='../Manage/manageStaff.phtml'>Return to Teacher page.</a>";
            }

        }

    ?>
    </body>
</html>