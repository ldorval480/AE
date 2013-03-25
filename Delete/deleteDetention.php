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
$sql = "DELETE FROM assignment WHERE Detention_ID =".$_GET['id'];

if(!$con->query($sql))
{
    die('Error: '. $con->error);
}

$sql = "DELETE FROM detention WHERE ID =". $_GET['id'];

if(!$con->query($sql))
{
    die('Error: '. $con->error);
}
echo "<p>Detention Deleted</p>";
echo "<a href='../View/Form/viewDetentionsForm.phtml'>Back to Referrals</a>";

$con->close();

?>

</body>
</html>