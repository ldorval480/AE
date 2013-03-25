<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/common.css">
</head>
<body>
<?php
$con = new mysqli('localhost', 'root', '', "academicenrichment");
if ($con->connect_errno)
{
    die('Could not connect: ' . $con->connect_error);
}

list($sFN, $sLN) = explode(' ', $_POST['student_name']);

$myQuery = "SELECT ID FROM student
            WHERE FirstName ='".$sFN."'
            AND LastName = '".$sLN."'";

$result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);
if($result->num_rows < 0)
{
    echo "<p>Student does not exist please <a href='../Add/addStudent.phtml'>add student</a> or <a href='../Add/addDetention.php'> try again</a></p>";
    exit();
}
$row = $result->fetch_array(MYSQL_ASSOC);
$sID = $row['ID'];

$result->free_result();

list($sFN, $sLN) = explode(' ', $_POST['teacher_name']);

$myQuery = "SELECT ID FROM staff
            WHERE FirstName ='".$sFN."'
            AND LastName = '".$sLN."'";

$result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);
$row = $result->fetch_array(MYSQL_ASSOC);
$tID = $row['ID'];


if($result->num_rows < 0)
{
    echo "<p>Teacher does not exist please <a href='../Add/addDetention.php'>try again</a></p>";
    exit();
}
else{
    $date = date('Y/m/d');
    $sql ="INSERT INTO detention (StartDate, Block, Subject_ID, Student_ID, Teacher_ID, Description)
VALUES ('$date', '$_POST[block]', '$_POST[subject]', '$sID', '$tID', '$_POST[description]')
";

    if (!$con->query($sql))
    {
        die('Error: ' . $con->error);
    }
    echo "<p>Detention record added</p>";

    $result = $con->query("SELECT MAX(ID) FROM detention");

    $row = $result->fetch_array(MYSQLI_ASSOC);


    $acceptable_extensions[0] = "pdf";
    $acceptable_extensions[1] = "jpg";
    $acceptable_extensions[2] = "gif";
    $acceptable_extensions[3] = "doc";
    $acceptable_extensions[4] = "ppt";
    $acceptable_extensions[5] = "xls";
    $acceptable_extensions[6] = "xsl";
    $acceptable_extensions[7] = "PDF";
    $acceptable_extensions[8] = "JPG";
    $acceptable_extensions[9] = "GIF";
    $acceptable_extensions[10] = "DOC";
    $acceptable_extensions[11] = "PPT";
    $acceptable_extensions[12] = "XLS";
    $acceptable_extensions[13] = "XSL";
    $acceptable_extensions[14] = "txt";
    $acceptable_extensions[15] = "TXT";
    $acceptable_extensions[16] = "csv";
    $acceptable_extensions[17] = "CSV";
    $acceptable_extensions[18] = "docx";
    $acceptable_extensions[19] = "DOCX";

    $validated = 1;

    if($_FILES && $_FILES['file']['name']){

        //make sure the file has a valid file extension

        $file_info = pathinfo($_FILES['file']['name']);
        $acceptable_ext = 0;

        for($x = 0; $x < count($acceptable_extensions); $x++){

            if($file_info['extension'] == $acceptable_extensions[$x]){
                $acceptable_ext = 1;

            }
        }

        if(!$acceptable_ext){
            $validated = 0;
        }
    }else{
        $validated = 0;
    }

    if($validated){

        // Get important information about the file and put it into variables

        $fileName = $_FILES['file']['name'];
        $tmpName  = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // Slurp the content of the file into a variable

        $fp = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
        fclose($fp);

        if(!get_magic_quotes_gpc()){
            $fileName = addslashes($fileName);
        }

        $file_info = pathinfo($_FILES['file']['name']);

        $sql = "INSERT INTO assignment (Detention_ID, File_Name, File_Type, File_Size, File_Content, File_Extension)
             VALUES ('".$row['MAX(ID)']."','".$fileName."', '".$fileType."', '".$fileSize."', '".$content."', '".$file_info['extension']."')";



        $result = $con->query($sql);

        // If the query was successful, give success message

        if(!$result){
            echo "Could not add this file.\n";
            exit;
        }
        else{
            echo  "New file successfully added.\n";
        }

    }else{
        echo "Invalid file.\n";
        exit;
    }

}


?>

<a href="../Manage/manageDetention.phtml">Return to Manage Academic Enrichment Referrals page.</a>

</body>
</html>

