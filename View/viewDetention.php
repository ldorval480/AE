<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/views.css">
    <title>View Academic Enrichment Referral</title>
</head>

<body>
<div class="wrapper">
    <div class="breadcrumbs">
        <a href="../View/Form/viewDetentionsForm.phtml">< Referrals</a>
    </div>
    <h1>View Academic Enrichment Referral</h1>
    <?
    $con = new mysqli('localhost', 'root', '', "academicenrichment");

    if ($con->connect_errno)
    {
        die('Could not connect: ' . $con->connect_error);
    }


    $myQuery = "SELECT s.LastName as S_LastName, s.FirstName as S_FirstName, d.StartDate, d.EndDate, d.CompletionFlag, d.Block, d.Description, su.Name, t.FirstName as T_FirstName, t.LastName as T_LastName
                FROM student s
                INNER JOIN detention d
                ON s.ID = d.Student_ID
                INNER JOIN SUBJECT su
                ON su.ID = d.Subject_ID
                INNER JOIN staff t
                ON t.ID = d.Teacher_ID
                WHERE d.ID ='". $_GET['id']."'";

    $result = $con->query($myQuery) or die($myQuery."<br/><br/>".mysql_error());

    $row = $result->fetch_array(MYSQLI_ASSOC);

    ?>

    <div class="list">
        <ul>
            <li>
                <span class="title">Student: </span>
                <span class="text"><?= $row['S_FirstName']." ".$row['S_LastName'] ?></span>
            </li>
            <li>
                <span class="title">Teacher: </span>
                <span class="text"><?= $row['T_FirstName']." ".$row['T_LastName']?></span>
            </li>
            <li>
                <span class="title">Subject: </span>
                <span class="text"><?= $row['Name'] ?></span>
            </li>
            <li>
                <span class="title">Block: </span>
                <span class="text"><?= $row['Block'] ?></span>
            </li>
            <li>
                <span class="title">Description: </span>
                <span class="text"><?= $row['Description']?></span>
            </li>
            <li>
                <span class="title">Referral Date: </span>
                <span class="text"><?= $row['StartDate'] ?></span>
            </li>
            <li>
                <span class="title">Completion Date: </span>
                <span class="text"><?= $row['EndDate'] ?></span>
            </li>
            <li>
                <span class="title">Complete: </span>
                <span class="text">
                    <? if($row['CompletionFlag'] == true): ?>
                        <span class="y">Yes</span>
                    <? else: ?>
                        <span class="n">No</span>
                    <? endif; ?>
                </span>
            </li>
        </ul>

        <?
        $myQuery = "SELECT * FROM Assignment
            WHERE Detention_ID = ".$_GET['id'];

        $result = $con->query($myQuery);

        if(!$result || $result->num_rows <= 0){
            echo "There are no files associated with this referral";
        }

        while($curr_file = $result->fetch_array(MYSQLI_ASSOC))
        {
            echo "<a href='downloadFile.php?id=".$curr_file['ID']."'>".$curr_file['File_Name']."</a>";
        }
        ?>

    </div>
    <a class="edit-button" href=<?= "../Edit/editDetention.php?id=".$_GET['id']?>>Edit</a>
    <a class="delete-button" onclick="return confirm('Are you sure?');" href=<?= "../Delete/deleteDetention.php?id=".$_GET['id']?>>Delete</a>


    <? $con->close(); ?>
</div>
</body>
</html>