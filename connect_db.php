		<?php
		
		try {
			$dbh = new PDO('mysql:host=localhost;port=8889;dbname=WebDB', 'root', 'root');
			print "Connection OK!";
			//~ $dbh = null;
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
		
		?>
	  
