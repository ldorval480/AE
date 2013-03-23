<?

$con = new mysqli('localhost', 'root', '', "academicenrichment");

if ($con->connect_errno)
{
    die('Could not connect: ' . $con->connect_error);
}

$text = $_GET['term'];

$result = $con->query("SELECT FullName FROM student WHERE FullName LIKE '%$text%' ORDER BY FullName ASC");
$students = array();

while ($row = $result->fetch_array(MYSQL_ASSOC))
{
    $students[] = $row['FullName'];
}


$result->free_result();
$con->close();

echo json_encode($students);
?>