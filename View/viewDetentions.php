<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/views.css">
    <title>View Staff</title>
</head>

<body>
<div class="view-students">
    <?
    $con = new mysqli('localhost', 'root', '', "academicenrichment");
    if ($con->connect_errno)
    {
        die('Could not connect: ' . $con->connect_error);
    }

    ?>

    <form action="viewDetentions.php" method="POST">
        <select name="detention-select">
            <option value="complete">Completed</option>
            <option value="incomplete">Not Completed</option>
            <option value="all" selected >All</option>
        </select>

        <input type="submit" value="Submit">
    </form>

    <?
    if($_POST['detention-select'] === 'all')
    {
        echo "<h1>All</h1>";
        $myQuery = "SELECT detention.ID, student.LastName, student.FirstName, detention.StartDate, detention.CompletionFlag, subject.Name
                    FROM student
                    INNER JOIN detention
                    ON student.ID = detention.Student_ID
                    INNER JOIN SUBJECT
                    ON subject.ID = detention.Subject_ID
                    ORDER BY detention.StartDate";
    }elseif($_POST['detention-select'] == "complete"){
        echo "<h1>Complete</h1>";
        $myQuery = "SELECT detention.ID, student.LastName, student.FirstName, detention.StartDate, detention.CompletionFlag, subject.Name
                    FROM student
                    INNER JOIN detention
                    ON student.ID = detention.Student_ID
                    INNER JOIN SUBJECT
                    ON subject.ID = detention.Subject_ID
                    WHERE detention.CompletionFlag = true
                    ORDER BY detention.StartDate";
    }else if($_POST['detention-select'] == "incomplete") {
        echo "<h1>Incomplete</h1>";
        $myQuery = "SELECT detention.ID, student.LastName, student.FirstName, detention.StartDate, detention.CompletionFlag, subject.Name
                    FROM student
                    INNER JOIN detention
                    ON student.ID = detention.Student_ID
                    INNER JOIN SUBJECT
                    ON subject.ID = detention.Subject_ID
                    WHERE detention.CompletionFlag = false
                    ORDER BY detention.StartDate";}





    if($result = $con->query($myQuery))
    {
        ?>
        <html>
                <table>
                    <tr>
                        <th>Student</th>
                        <th>Date Referred</th>
                        <th>Subject</th>
                        <th>Complete</th>
                    </tr>
                        <?while($row = $result->fetch_array(MYSQLI_ASSOC)):?>
                        <tr>
                            <td><a href=<?='viewDetention.php?id='.$row['ID']?>><?=$row['LastName'].", ".$row['FirstName']?></a></td>
                            <td><?= $row['StartDate']?></td>
                            <td><?= $row['Name']?></td>
                            <td>
                                <?if($row['CompletionFlag'] == true):?>
                                <span class="y">Yes</span>
                                <?else:?>
                                <span class="n">No</span>
                                <?endif;?>
                            </td>
                        </tr>
                        <?endwhile;?>
                </table>
            </html>
    <?

    }

    $con->close();
    ?>
</div>
</body>
</html>