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
 			width: 50%;
		}
		.judul{
			font-size: 50px;
			color: white;
			text-align: center; 
		}
</style>
</head>
<body>

	<div class="container" style="margin-top: 80px">

		<div>
			 <div class="emosmile">
				<img class="imgsurvey" src="<?php echo base_url('assets/touch-sangat-puas.png'); ?>">   
				<?php $puas[0] ?>
			</div>
			<div class="emosmile">
				<img class="imgsurvey" src="<?php echo base_url('assets/touch-puas.png'); ?>">  
			</div>
			<div class="emosmile">
				<img class="imgsurvey" src="<?php echo base_url('assets/touch-agak-puas.png'); ?>" >  
			</div>
			<div class="emosmile">
				<img class="imgsurvey" src="<?php echo base_url('assets/touch-tidak-puas.png'); ?>" >  
			</div>
			<div class="emosmile">
				<img class="imgsurvey" src="<?php echo base_url('assets/touch-sangat-marah.png'); ?>" >  
			</div>
		</div>


		<?php echo $this->session->flashdata('notif') ?>
		<a href="<?php echo base_url() ?>survey/tambah" class="btn btn-md btn-success">Input Survey</a>
		<hr>
		<!-- table -->
		<div>
			<table id="table" class="table table-striped table-bordered table-hover">
			    <thead>
			      <tr>
			        <th>No.</th>
			        <th>Id Survey</th>
			        <th>Kantor</th>
			        <th>Tanggal</th>
			        <th>Hasil</th> 
			        <th>Options</th> 
			      </tr>
			    </thead>
			    <tbody>

			    <?php
			    	$no = 1; 
			    	foreach($data_survey as $hasil){ 
			    ?>
			      
			      <tr>
			        <td><?php echo $no++ ?></td>
			        <td><?php echo $hasil->id ?></td>
			        <td><?php echo $hasil->kantor ?></td>
			        <td><?php echo $hasil->waktu_survey ?></td>
			        <td><?php echo $hasil->hasil_survey ?></td> 
			        <td>
			        	<a href="<?php echo base_url() ?>survey/edit/<?php echo $hasil->id ?>" class="btn btn-sm btn-success">Edit</a>
			        	<a href="<?php echo base_url() ?>survey/hapus/<?php echo $hasil->id ?>" class="btn btn-sm btn-danger">Hapus</a>
			        </td>
			      </tr>

			    <?php } ?>

			    </tbody>
			  </table>
		</div>

	</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
	$('#table').DataTable( {
    autoFill: true
} );
</script>
</body>
</html>