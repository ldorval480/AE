<?

$con = new mysqli('localhost', 'root', '', "academicenrichment");

if ($con->connect_errno)
{
    die('Could not connect: ' . $con->connect_error);
}

$text = $_GET['term'];

$sql = "SELECT FirstName, LastName FROM staff
        WHERE (FirstName LIKE '%$text%' and LastName LIKE '%$text%')
        OR FirstName LIKE '%$text%'
        OR LastName LIKE '%$text%'
        ORDER BY LastName ASC";

$result = $con->query($sql);
$teachers = array();

while ($row = $result->fetch_array(MYSQL_ASSOC))
{
    $teachers[] = $row['FirstName']." ".$row['LastName'];
}


$result->free_result();
$con->close();

echo json_encode($teachers);
?>