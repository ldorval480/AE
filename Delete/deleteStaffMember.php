<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/common.css">
    <title>Academic Enrichment</title>
</head>
<body>

    <?
        $con = new mysqli('localhost', 'root', '', "academicenrichment");
        if ($con->connect_errno)
        {
            die('Could not connect: ' . $con->connect_error);
        }

        $sql = "DELETE FROM user WHERE Staff_ID =". $_GET['id'];

        if(!$con->query($sql))
        {
            die('Error: '. $con->error);
        }

        $sql = "DELETE FROM staff WHERE ID =". $_GET['id'];

        if(!$con->query($sql))
        {
            die('Error: '. $con->error);
        }
        echo "<p>Staff Member Deleted</p>";
        echo "<a href='../View/Form/viewStaffForm.phtml'>Back to Staff</a>";

        $con->close();

    ?>

</body>
</html>