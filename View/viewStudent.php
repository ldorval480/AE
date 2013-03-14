<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/view-student.css">
        <title>View Student</title>
    </head>

    <body>
        <h1>View Student</h1>
        <?
            $con = new mysqli('localhost', 'root', '', "academicenrichment");

            if ($con->connect_errno)
            {
                die('Could not connect: ' . $con->connect_error);
            }

            $myQuery = "SELECT * FROM student
                        WHERE ID ='". $_GET['id']."'";

            $result = $con->query($myQuery) or die($myQuery."<br/><br/>".mysql_error());

                $row = $result->fetch_array(MYSQLI_ASSOC);

        ?>

        <div class="list">
            <ul>
                <li>
                    <span class="title">Name: </span>
                    <span class="text"><?= $row['FirstName']." ".$row['LastName'] ?></span>
                </li>
                <li>
                    <span class="title">Grade: </span>
                    <span class="text"><?= $row['Grade'] ?></span>
                </li>
                <li>
                    <span class="title">Student Email: </span>
                    <span class="text"><?= $row['StudentEmail'] ?></span>
                </li>
                <li>
                    <span class="title">Parent Email: </span>
                    <span class="text"><?= $row['ParentEmail']?></span>
                </li>
                <li>
                    <span class="title">Second Parent Email: </span>
                    <span class="text"><?= $row['ParentEmail2']?></span>
                </li>
            </ul>
        </div>
        <a class="edit-button" href=<?= "../Edit/editStudent.php?id=".$_GET['id']?>>Edit</a>


        <? $con->close(); ?>
    </body>
</html>