<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/add-student.css">

    <style type="text/css" media="print">
       /*put if*/  .printbutton {
            visibility: hidden;
            display: none;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="../css/add-student.css">
    <title>Teacher Report</title>
</head>
<div id="teacherReport">
    <h1>Teacher Report</h1>
</div>
<body>

<?php
    //connect to database
    $con = new mysqli('localhost', 'root', '', "academicenrichment");
    if ($con->connect_errno){
        die('Could not connect: ' . $con->connect_error);
    }
    // Collects data from teacher table
    $data = mysql_query("SELECT * FROM teacher") or die(mysql_error());
    //And we will then temporally put this information into an array to use:

    // puts teacher info into the $info array
    $info = mysql_fetch_array( $data );  // Collects data from teacher table

    Print "<table border cellpadding=3>";
    Print "<tr>";
    Print "<th>First Name</th> <td>";
    Print "<th>Last Name</th> <td>";
    Print "<th>Email</th> <td>";

    while($info = mysql_fetch_array( $data ))
    {
        Print "<th>First Name</th> <td>".$info['Teacher_FirstName'] . "</td> ";
        Print "<th>Last Name</th> <td>".$info['Teacher_LastName'] . " </td>";
        Print "<th>Email</th> <td>".$info['Teacher_Email'] . " </td></tr>";
    }
    Print "</table>";

    $con->close();
?>
        <!-- <form action ="../Submit/submitTeacher.php" method="POST"> -->
        <div class="buttons">
            <script>
                document.write("<input type='button' " + "onClick='window.print()' " +
                "class='printbutton' " + "value='Print'/>");
            </script>
            <input type="button" value="Export">
            <input type="button" value="Back">
        </div>
</div>
</body>
</html>