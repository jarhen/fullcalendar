<?php 
	include'connect.php';
		 echo $title   = $_POST['title'];
		 echo $e_start = date("Y-m-d H:s i" , strtotime($_POST['e_start']));
		 echo $e_end   = date("Y-m-d H:s i" , strtotime($_POST['e_end']));
		 echo $desc    = $_POST['desc'];
		 
		 $result = $dbh->prepare("INSERT INTO fc(title, event_start, event_end , description)
		 VALUES(:title, :e_start, :e_end, :desc)");

        $result->bindParam(':title', $title);
		$result->bindParam(':e_start', $e_start);
		$result->bindParam(':e_end', $e_end);
		$result->bindParam(':desc', $desc);
        $result->execute();
?>