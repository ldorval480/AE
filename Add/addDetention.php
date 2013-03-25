
<html>
    <body>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/add-detention.css">
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
        <title>Add Referral</title>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>

        <script type="text/javascript">
            $(function(){
                $("#student_name").autocomplete({
                    source: "studentComplete.php",
                    minLength: 0
                });
            });

            $(function(){
                $("#teacher_name").autocomplete({
                    source: "teacherComplete.php",
                    minLength: 0
                });
            });
        </script>
    </head>

    <?
        $con = new mysqli('localhost', 'root', '', "academicenrichment");

        if ($con->connect_errno)
        {
            die('Could not connect: ' . $con->connect_error);
        }

        $myQuery = "SELECT * FROM subject ORDER BY name asc";

        $result = $con->query($myQuery) or die($myQuery."<br/><br/>". $con->error);

    ?>


    <div id="addDetention">
        <div class="breadcrumbs">
            <a href="../index.phtml">Home</a> > <a href="../Manage/manageDetention.phtml">Manage Detention</a>
        </div>

            <h1>Academic Enrichment</h1>

            <h3>To refer a student please fill out the form below:</h3>

            <form action ="../Submit/submitDetention.php" method="POST" enctype="multipart/form-data">
                <div class="form-piece">
                        <label>Student:</label>
                        <input name="student_name" id="student_name">
                </div>

                <div class="form-piece">
                    <label>Teacher:</label>
                    <input name="teacher_name" id="teacher_name">
                </div>

                <div class="form-piece">
                    <label>Subject:</label>
                    <select name="subject">
                        <?while ($row = $result->fetch_assoc()):?>
                        <option value=<?= $row['ID']; ?>><?=$row['Name']?></option>
                        <?endwhile;?>
                    </select>
                </div>

                <div class="form-piece">
                    <label>Block:</label>
                    <select name="block">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                    </select>
                </div>

                <div class="form-piece">
                    <label>Description:</label>
                    <textarea  name="description"></textarea>
                </div>

                <label for="file">Filename: (Max 2M)</label>
                <input type="file" name="file[]" id="file" multiple />


            <input type="submit" value="Submit">
        </form>


        </div>

    </body>
</html>