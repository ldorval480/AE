<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tom
 * Date: 2/22/13
 * Time: 3:56 PM
 * To change this template use File | Settings | File Templates.
 */
class createConnection
{
    var $host="localhost";
    var $username="root";    // specify the sever details for mysql
    Var $password="";
    var $database="academinenrichment";
    var $myconn;

    public function connectToDatabase()
    {
        $conn= mysql_connect($this->host,$this->username,$this->password);

        if(!$conn)// testing the connection
        {
            die ("Cannot connect to the database");
        }

        else
        {

            $this->myconn = $conn;

            echo "Connection established";

        }

        return $this->myconn;
    }

    function selectDatabase() // selecting the database.
    {
        mysql_select_db($this->database);  //use php inbuild functions for select database

        if(mysql_error()) // if error occured display the error message
        {

            echo "Cannot find the database ".$this->database;

        }
        echo "Database selected..";
    }

    function closeConnection() // close the connection
    {
        mysql_close($this->myconn);

        echo "Connection closed";
    }
}
