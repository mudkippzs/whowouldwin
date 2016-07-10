<?php
include_once './resources/config.php'; 
update_user_activity();
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Bangers|Boogaloo|Open+Sans:400,300,400italic,700,800,800italic,700italic,600italic,600,300italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">		
		<link rel="stylesheet" href="http://code.cloudcms.com/alpaca/1.5.17/bootstrap/alpaca.min.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="http://code.cloudcms.com/alpaca/1.5.17/bootstrap/alpaca.min.js"></script>
		  <script>
			  $(function() {
				$( "#tabs" ).tabs({active: 0});
			  });
		  </script>
	
		<title><?php echo PAGETITLE ?></title>
		
	</head>
	
	<body>
	
	<header>
	
		<div class="wrapper">
			
			
			
			<div class="header_inner clearfix">
				
				<div class="logo">
					<a href="/index.php">
						<span>W</span>ho<span>W</span>ould<span>W</span>in
					</a>
				</div>
				<!-- .logo -->
				
				<nav>
					
				</nav>
			
			</div>
			<!-- .header_inner -->
		
		</div>
		<!-- .wrapper -->
		
	</header>
	
	<?php
	if(isset($_GET['n']) && $_GET['n'] != ''){
		$array = array();
		$note = str_replace('', ',', $_GET['n']);
		$array = explode(',',$note);
		if(count($array) < 255){
			$note = $_GET['n'];
			echo "<div id='notification_header'>";
			echo $note;
			echo "</div>";
		}	
		
	}
	?>
	