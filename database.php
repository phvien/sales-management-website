<?php
  global $conn;

  function connect_db()
  {
  	global $conn;
  	if (!$conn)
  	{
        $conn = mysqli_connect('localhost', 'root', '', 'webquanlybanhang') or die ('Can not connect to database');
        mysqli_set_charset($conn, 'utf8');
    }
  }

  function disconnect_db()
  {
  	global $conn;
  	if ($conn){
        mysqli_close($conn);
    }
  }

?>