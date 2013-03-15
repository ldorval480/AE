<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/add-student.css">
    <title>Edit Student</title>
</head>

<body>
<h1>Edit Student</h1>
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

<form action =<?="../Submit/submitEditStaff.php?id=".$_GET['id']?> method="POST">
<div class="form-piece">
    <label>First Name:</label>
    <input type="text" name="first_name" value=<?= $row['FirstName'] ?>>
</div>

<div class="form-piece">
    <label>Last Name:</label>
    <input type="text" name="last_name" value=<?= $row['LastName'] ?>>
</div>

<div class="form-piece">
    <label>Email:</label>
    <input type="text" name="grade" value=<?= $row['TeacherEmail'] ?>>
</div>

<h4>Roles:</h4>
<div class="form-piece">
    <label>Admin:</label>
    <?if($row['AdminFlag'] == true):?>
    <input type="checkbox" name="admin" value="admin" checked >
    <?else:?>
    <input type="checkbox" name="admin" value="admin">
    <?endif;?>
</div>

<div class="form-piece">
    <label>Admin:</label>
    <?if($row['TeacherFlag'] == true):?>
    <input type="checkbox" name="teach" value="teach" checked >
    <?else:?>
    <input type="checkbox" name="teach" value="teach">
    <?endif;?>
</div>

<div class="form-piece">
    <label>Admin:</label>
    <?if($row['CeaFlag'] == true):?>
    <input type="checkbox" name="cea" value="cea" checked >
    <?else:?>
    <input type="checkbox" name="cea" value="cea">
    <?endif;?>
</div>

<input type="submit" value="Submit">
</form>
</body>
</html>