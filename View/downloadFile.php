<?

$con = new mysqli('localhost', 'root', '', "academicenrichment");

if ($con->connect_errno)
{
    die('Could not connect: ' . $con->connect_error);
}

$myQuery = "SELECT * FROM Assignment
            WHERE ID = ".$_GET['id'];

$result = $con->query($myQuery);

if(!$result || $result->num_rows <= 0){
    echo "Invalid file chosen.";
    exit;
}
$curr_file = $result->fetch_assoc();

$size = $curr_file['File_Size'];
$type = $curr_file['File_Type'];
$name = $curr_file['File_Name'];
$content = $curr_file['File_Content'];

header("Content-length: ".$size."");
header("Content-type: ".$type."");
header('Content-Disposition: attachment; filename="'.$name.'"');
echo $content;

http_redirect("relpath", array("name" => "value"), true, HTTP_REDIRECT_PERM);

?>