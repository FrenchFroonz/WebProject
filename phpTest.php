<!DOCTYPE html>
<html>

	<sideBar>
			<a href="siteWeb.html" class="home"><img src="home.png" alt="Home" width="30" height="30"></a>
			<a href="barre.php">Bunch</a>
			<a href="page3.html">of</a>
			<a href="phpTest.php">options</a>
		
	</sideBar>

	<div class = "main">

		<head>
			<meta charset="utf-8" />
			<title>Botrytis cinerea</title>
			<link rel="stylesheet" type="text/css" href="style.css" />
		</head>

	<body>
				<header>
				<h1>Botrytis cinerea genome analysis</h1>
				<div class="info">
					<p class="welcome">Welcome to the genome of the fungus Botrytis cinerea</p>

				</div>
			</header>
			<nav>
				<ul>
					<!--<li><a href="#">Acceuil</a></li>-->
					<li><a href="#">Page1</a></li>
					<li><a href="#">Page2</a></li>
					<li><a href="#">Page3</a></li>
				</ul>
			</nav>
			
				<section>
					<h2>Calculate GC content</h2>
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

						<p>Your sequence</p><br>
						<textarea rows = "10" cols="50" name="seq" ><?php echo $seq?></textarea>
						<input type="submit" value="Calculate GC ratio">

					<br>
					</form>
					<br>
				 
				</section>



				
	
		


	<?php 
	$ng=0;
	$nc=0;
	$gc=NULL;
	$seq_exists=0;
	$valid_sequence=0;
	if((isset($_POST['seq'])) && ($_POST['seq']!= '')){

		$seq2=$_POST['seq'];
		$seq=strtoupper($seq2);
		
		if(preg_match("/^[ACTG]+$/", $seq)){
			$seq_exists=1;
			$valid_sequence=1;
			for($i=0; $i<=strlen($seq); $i++){
				if($seq[$i]=='G'){$ng++;}
				else if ($seq[$i]=='C'){$nc++;}
				$gc=($ng+$nc)/strlen($seq);
			}
		}
		else{$valid_sequence=0;}
		
	}

	?>


	<?php 
			if($valid_sequence==1){
			echo "GC content is at : $gc";
		}
		
	?>

	</div>
	<logo>
		<img src="LogoUPSUD.png" alt="U-PSud" width="200" height="130">
	</logo>
				<footer>
					<p>Eventuallity of a footer</p>

				</footer>
	
	</body>
	</html>

