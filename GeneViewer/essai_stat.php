<?php
	include('connect_db.php');
	
	$sql =  'SELECT count(sequence) from gene';
	foreach  ($dbh->query($sql) as $row) {
		print "Nombre de séquences : ".$row['count(sequence)'] . "<br>";
  }
  
    		$sql =  'SELECT AVG(Taille) from summaryGene';
	foreach  ($dbh->query($sql) as $row) {
		print "Taille moyenne des séquences : ".$row['AVG(Taille)'] . "<br>";
  }
	
		$sql =  'SELECT min(Taille) from summaryGene';
	foreach  ($dbh->query($sql) as $row) {
		print "Taille minimale de séquences : ".$row['min(Taille)'] . "<br>";
  }
  
  		$sql =  'SELECT max(Taille) from summaryGene';
	foreach  ($dbh->query($sql) as $row) {
		print "Taille minimale de séquences : ".$row['max(Taille)'] . "<br>";
  }
  
    	$sql =  'SELECT ROUND(STD(Taille),3) from summaryGene';
	foreach  ($dbh->query($sql) as $row) {
		print "Ecart-type des tailles des séquences : ".$row['ROUND(STD(Taille),3)'] . "<br>";
  }
  


  

	
?>
