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

        $myQuery = "SELECT FirstName, LastName FROM teacher
                    WHERE FirstName ='".$_POST['first_name']."'
                    AND LastName ='";
    ?>
    </body>
</html>