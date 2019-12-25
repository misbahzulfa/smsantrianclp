<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
	<style> 
		html, body {
    		margin: 0;
    		height: 100%;
		}
		.surveybody{ 
			background-image: url("../assets/background.jpg");
			background-repeat: no-repeat;
  			background-size: 100% 100%;
		}  
		.center { 
	  		padding: 100px 0; 
	  		margin-top: 3%;
	  		margin-right: auto;
	  		margin-left: auto;
	  		margin-bottom: auto;
		}
		.emosmile{
			width:20%;
			margin: 0 auto;
			float:left;
		}
		.imgsurvey{
			display: block;
  			margin-left: auto;
  			margin-right: auto;
 			width: 100%;
		}
		.judul{
			font-size: 50px;
			color: white;
			text-align: center; 
		}
	</style>
	<script>
		$(function() { 
    		$(".hide-it").hide(5000); 
		});
	</script>
</head>
<body class="surveybody"> 
	<div class="container" >
		<p class="judul" style="color:black"><strong>Survey Kepuasan Arsip Cilacap</strong></p>
		 
		
		<div class="center"> 
			<div class="emosmile" id="d">
				<img class="imgsurvey" src="<?php echo base_url('assets/touch-sangat-puas.png'); ?>"  
			  	 onclick="window.location='<?php echo site_url("survey/sangat_puas");?>'"> 
			  	<h4 style="color: white; text-align: center;">Sangat Puas</h4>
			</div>
			<div class="emosmile" id="e">
				<img class="imgsurvey" src="<?php echo base_url('assets/touch-puas.png'); ?>"  
			  	onclick="window.location='<?php echo site_url("survey/puas");?>'"> 
			  	<h4 style="color: white; text-align: center;">Puas</h4>
			</div>
			<div class="emosmile" id="f">
				<img class="imgsurvey" src="<?php echo base_url('assets/touch-agak-puas.png'); ?>"  
			  	onclick="window.location='<?php echo site_url("survey/cukup_puas");?>'"> 
			  	<h4 style="color: white; text-align: center;">Cukup Puas</h4>
			</div>
			<div class="emosmile" id="g">
				<img class="imgsurvey" src="<?php echo base_url('assets/touch-tidak-puas.png'); ?>"  
			  	onclick="window.location='<?php echo site_url("survey/kurang_puas");?>'"> 
			  	<h4 style="color: white; text-align: center;">Kurang Puas</h4>
			</div>
			<div class="emosmile" id="h">
				<img class="imgsurvey" src="<?php echo base_url('assets/touch-sangat-marah.png'); ?>"  
			  	onclick="window.location='<?php echo site_url("survey/tidak_puas");?>'"> 
			  	<h4 style="color: white; text-align: center;">Tidak Puas</h4>
			</div>
			  
		</div>
	</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
	function tempAlert(msg,duration)
	{
	     var el = document.createElement("div");
	     el.setAttribute("style","position:absolute;top:20%;left:42%;background-color:white;");
	     el.innerHTML = msg;
	     setTimeout(function(){
	      el.parentNode.removeChild(el);
	     },duration);
	     document.body.appendChild(el);
	}

	var d = document.getElementById('d');
	d.onclick = function(){ tempAlert("Terima Kasih Sudah Survey",60000); };

	var e = document.getElementById('e');
	e.onclick = function(){ tempAlert("Terima Kasih Sudah Survey",60000); };

	var f = document.getElementById('f');
	f.onclick = function(){ tempAlert("Terima Kasih Sudah Survey",60000); };

	var g = document.getElementById('g');
	g.onclick = function(){ tempAlert("Terima Kasih Sudah Survey",60000); };

	var d = document.getElementById('h');
	h.onclick = function(){ tempAlert("Terima Kasih Sudah Survey",60000); };
</script>

</body>
</html>