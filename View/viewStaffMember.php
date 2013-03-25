<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/views.css">
    <title>View Student</title>
</head>

<body>
<div class="wrapper">
    <div class="breadcrumbs">
        <a href="viewStaff.php">< Staff</a>
    </div>
    <h1>View Staff Member</h1>
    <?
    $con = new mysqli('localhost', 'root', '', "academicenrichment");

    if ($con->connect_errno)
    {
        die('Could not connect: ' . $con->connect_error);
    }

    $myQuery = "SELECT * FROM staff
                        WHERE ID ='". $_GET['id']."'";

    $result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);

    $row = $result->fetch_array(MYSQLI_ASSOC);

    ?>

    <div class="list">
        <ul>
            <li>
                <span class="title">Name: </span>
                <span class="text"><?= $row['FirstName']." ".$row['LastName'] ?></span>
            </li>
            <li>
                <span class="title">Email: </span>
                <span class="text"><?= $row['StaffEmail'] ?></span>
            </li>
            <li>
                <span class="title">Teacher: </span>
                <span class="text">
                    <?if($row['TeacherFlag']){
                    echo "<span class='y'>Yes</span>";
                }else{
                    echo "<span class='n'>No</span>";
                }?>
                </span>
            </li>
            <li>
                <span class="title">Admin: </span>
                <span class="text">
                    <?if($row['AdminFlag']){
                        echo "<span class='y'> Yes</span>";
                    }else{
                        echo "<span class='n'> No</span>";
                    }?>
                </span>
            </li>
            <li>
                <span class="title">CEA: </span>
                <span class="text">
                    <?if($row['CeaFlag']){
                    echo "<span class='y'>Yes</span>";
                }else{
                    echo "<span class='n'>No</span>";
                }?>
                </span>
            </li>
        </ul>
    </div>
    <a class="edit-button" href=<?= "../Edit/editStaffMember.php?id=".$_GET['id']?>>Edit</a>
    <a class="delete-button" onclick="return confirm('Are you sure?');" href=<?= "../Delete/deleteStaffMember.php?id=".$_GET['id']?>>Delete</a>


    <? $con->close(); ?>
</div>
</body>
</html>