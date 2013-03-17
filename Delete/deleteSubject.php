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

$sql = "DELETE FROM subject WHERE ID =". $_GET['id'];

if(!$con->query($sql))
{
    die('Error: '. $con->error);
}
echo "<p>Subject Deleted</p>";
echo "<a href='../View/viewSubjects.php'>Back to Subjects</a>";

$con->close();

?>

</body>
</html>