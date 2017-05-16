<?php 

        require "connect.php";  
        $result = $dbh->prepare("SELECT * FROM fc");
        $result->execute();
        $event_array = array();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($record = $result->fetch()) {
            $events[] = array(
                'id' => $record['id'],
                'title' => $record['title'],
                'start' => $record['event_start'],
                'end' => $record['event_end'],
				'description' => $record['description'],
            );
        }
	 
		//echo json_encode($events);
		
    
  
?>