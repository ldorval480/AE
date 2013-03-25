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
            echo "<p>Staff member already exists</p>";
            echo "<a href='../Manage/manageStaff.phtml'>Return to Staff page.</a>";
        }else{
            $admin = false;
            $teacher = false;
            $cea = false;

            if(isset($_POST['admin'])){ $admin = true;}
            if(isset($_POST['teach'])){ $teacher = true;}
            if(isset($_POST['cea'])){ $cea = true;}

            if($admin == false && $teacher == false && $cea == false)
            {
                echo "<p>Must have a role</p>";
                echo "<FORM><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'></FORM>";
            }else{
            $sql ="INSERT INTO staff (FirstName, LastName, StaffEmail, AdminFlag, TeacherFlag, CeaFlag)
        VALUES ('$_POST[first_name]', '$_POST[last_name]', '$_POST[email]', '$admin', '$teacher', '$cea')";



            if (!$con->query($sql))
            {
                die('Error: ' . $con->error);
            }
            echo "<p>Staff record added</p>";

                $result = $con->query("SELECT MAX(ID) FROM staff");

                $row = $result->fetch_array(MYSQLI_ASSOC);

                $defaultPassword = $_POST['last_name']."_".$row['MAX(ID)'];

                $encrypted_password = md5($defaultPassword);

                $foundUsername = false;
                $count = 0;
                $user = "";

                while($foundUsername == false)
                {
                    $user = strtolower(substr($_POST['first_name'], 0, $count+1).$_POST['last_name']);

                    $myQuery = "SELECT ID FROM user WHERE Username = '". $user."'";

                    $result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);

                    if($result->num_rows <= 0){
                        $foundUsername = true;
                    }
                    $count++;
                }

                $sql = "INSERT INTO user (Staff_ID, Password, Username)
                    VALUES('".$row['MAX(ID)']."', '".$encrypted_password."', '".$user."')";

                if (!$con->query($sql))
                {
                    die('Error: ' . $con->error);
                }

            $con->close();
            echo "<a href='../Manage/manageStaff.phtml'>Return to Staff page.</a>";
            }

        }

    ?>
    </body>
</html>