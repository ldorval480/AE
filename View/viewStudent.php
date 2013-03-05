<html>
    <head>
        <title>View Student</title>
    </head>

    <body>
        <h1>View Student</h1>
        <?php
            $con = new mysqli('localhost', 'root', '', "academicenrichment");

            if ($con->connect_errno)
            {
                die('Could not connect: ' . $con->connect_error);
            }

            $myQuery = "SELECT * FROM student
                        WHERE Student_ID ='". $_GET['id']."'";

            $result = $con->query($myQuery) or die($myQuery."<br/><br/>".mysql_error());

                $row = $result->fetch_array(MYSQLI_ASSOC);

        ?>

        <ul>
            <li>
                <span class="title">Name: </span>
                <span class="text"><?= $row['Student_FirstName']." ".$row['Student_LastName'] ?></span>
            </li>
            <li>
                <span class="title">Grade: </span>
                <span class="text"><?= $row['Grade'] ?></span>
            </li>
            <li>
                <span class="title">Student Email: </span>
                <span class="text"><?= $row['Student_Email'] ?></span>
            </li>
            <li>
                <span class="title">Parent Email: </span>
                <span class="text"><?= $row['Parent_Email']?></span>
            </li>
        </ul>

        <? $con->close(); ?>
    </body>
</html>