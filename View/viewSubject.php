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

    $myQuery = "SELECT * FROM subject
                        WHERE ID ='". $_GET['id']."'";

    $result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);

    $row = $result->fetch_array(MYSQLI_ASSOC);

    ?>

    <div class="list">
        <ul>
            <li>
                <span class="title">Name: </span>
                <span class="text"><?= $row['Name'] ?></span>
            </li>
        </ul>
    </div>
    <a class="delete-button" onclick="return confirm('Are you sure?');" href=<?= "../Delete/deleteSubject.php?id=".$_GET['id']?>>Delete</a>


    <? $con->close(); ?>
</div>
</body>
</html>