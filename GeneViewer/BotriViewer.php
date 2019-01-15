<!DOCTYPE php>

<!http://127.0.0.1/Projet_Web/InfoGene.php>


<html lang="fr">
 	<head>
    	<meta charset="UTF-8">
    	<title> Informations Gene </title>
    	<link rel="stylesheet" href="BotriViewer.css">
<!-- 
    	<script type="text/javascript">			 
			function afficher_div(id)
			{ 

			// document.getElementById(id).style.visibility="visible";
			}
		</script>
 -->
	</head>

	<div id="loading">
  		<img id="loading-image" src="ajax-loader.gif" alt="Loading..." />
  		<p> Please wait while page is loading ... 
  		</p>
  	</div>

	<body>
	
	<?php
		
		/** Variables pour la Database **/
		$username = 'root';
		$password = 'root';
		// $organism = 'WebDB';
		// if (isset($_GET['organism']))
		// 	$organism = $_GET['organism'];
		

		/** Initialisation des variables **/
		$gene_seq = '';
		$gene_exist = 0;
		$gene_id = '';
		$function = '';
		$start = '';
		$stop = '';
		$strand = '';
		$length = '';
		$supercontig = '';
		$type = '';
		if (isset($_GET['type']))
			$type = $_GET['type'];
		
		try {
			$bdd = new PDO('mysql:host=localhost;port=8889;dbname=WebDB',$username,$password);		
		}
		catch (Exception $e) {
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
		// $org_search = $bdd->query("SHOW DATABASES;");
		// $org_arr = array();
		// while ($data = $org_search->fetch())
		// {
		// 	if ($data['Database'] != 'Projet_Web' && $data['Database'] != 'information_schema' && $data['Database'] != 'performance_schema' && $data['Database'] != 'mysql' && $data['Database'] != 'sys') {
		// 		array_push($org_arr, $data['Database']);
		// 	}
		// }
		// $org_search->closeCursor();

		// database = WebDB
		
		$gene_arr = array();
		// if (($organism != "") && ($type != "")) {
		if ($type != "") {
			try {
				// $bdd = new PDO('mysql:host=localhost;dbname='.$organism.';charset=utf8',$username,$password);
				$bdd = new PDO('mysql:host=localhost;port=8889;dbname=WebDB',$username,$password);		
			}
			catch (Exception $e) {
				print "Erreur !: " . $e->getMessage() . "<br/>";
				die();
			}
			
			$answer = $bdd->query("SELECT Nom FROM $type;");
			while ($data = $answer->fetch()) {
				array_push($gene_arr, $data['Nom']);
			}
			$answer->closeCursor();
		}
		
		if (isset($_GET['gene_id']) && ($_GET['gene_id'] != "")) {
			$gene_id = $_GET['gene_id'];
			$gene_id = preg_replace("/(\r\n|\n|\r| )/", "", $gene_id);	// retire les sauts de ligne
			$gene_id = strtoupper($gene_id);
			$gene_exist = 1;
			
			try 
			{
				$bdd = new PDO('mysql:host=localhost;port=8889;dbname=WebDB',$username,$password);		
			}
			catch (Exception $e)
			{
				print "Erreur !: " . $e->getMessage() . "<br/>";
				die();
			}
			
			if ($type == 'gene') {
				$gene_id = preg_replace("/T/", "G", $gene_id);
				$seq_research = $bdd->query("SELECT Sequence FROM $type WHERE Nom = '$gene_id';");

			}
			elseif (($type == 'transcript') || ($type == 'Proteine')) {
				$gene_id = preg_replace("/G/", "T", $gene_id);
				$seq_research = $bdd->query("SELECT sequence FROM $type WHERE prot_id = '$gene_id';");

			
			// $seq_research = $bdd->query("SELECT Sequence FROM $type WHERE Nom = '$gene_id';");
			$data_seq = $seq_research->fetch();
			$gene_seq = $data_seq['Sequence'];
			$seq_research->closeCursor();
		}
		


		// gene seq contains the sequence of targeted gene 
	  


	?>


	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">	
	<br><br> 
	<!-- <div style="float:left;margin-left:15%;" value="<?php echo $org;?>"/>
		Choisir un organisme : <br>
		<select name="organism" id="organism">
			<?php
			// foreach($org_arr as $org) {
				//echo '<option>'.'Botritis'.'</option>';
			// }
			?>
		</select>
	</div>
	<script type="text/javascript">
		document.getElementById('organism').value = "<?php echo $_GET['organism'];?>";
	</script> -->
	
	<div style="float:right;margin-right:10%;" value="<?php echo $type;?>"/>
		Entrer un identifiant de gène : <br>
		<select name="gene_id" id="gene_id">
			<?php
			foreach($gene_arr as $gene) {
				echo '<option>'.$gene.'</option>';
			}
			?>
		</select>
<!--
		<input type="search" name="gene_id" placeholder="Recherche..." value="<?php echo $gene_id;?>"/> 
		<input type="submit" name="search" value="Valider" onClick="afficher_div('sortie_gene_id')"/>
-->
	</div>
	
	<script type="text/javascript">
		document.getElementById('gene_id').value = "<?php echo $_GET['gene_id'];?>";
	</script>
	
	<div align="center">
		Choisir un type de séquence : <br>
		<select name="type" id="type">
			<option>gene</option>
			<option>transcript</option>
			<option>Proteine</option>
			<option>contig</option>
		</select>
		<!-- onClick="afficher_div('sortie_gene_id')" -->
		<input type="submit" name="choose" value="Valider"/>
		<br><br>
	<script type="text/javascript">
		document.getElementById('type').value = "<?php echo $_GET['type'];?>";
	</script>
		Séquence :<br>
		<textarea rows="10" cols="60" readonly = "readonly" name="gene_seq" style="font-family:courier"><?php echo $gene_seq;?></textarea>
	</div>


  <script language="javascript" type="text/javascript">
     	// $(window).load(function() {
     		// $('#loading').hide();
  		// });
  		window.onload = function(){ document.getElementById("loading").style.display = "none" }
  </script>

  </body>

</html>

