<!DOCTYPE html>
<html id="full">
<head>
	<title><?php echo $title; ?> - Biro Administrasi Pembangunan</title>
	<!-- <meta http-equiv="refresh" content="10"> -->
	<!-- w3schools -->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<!-- jQuery Full Screen -->
	<script src="<?php echo base_url(); ?>assets/js/fullscreen.dg.js"></script>
	<!-- jQuery Full Screen -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.fullscreen.js"></script>
	<!-- jQuery Auto Scroll -->
	<script src="<?php echo base_url(); ?>assets/js/verticalScroller.js"></script>
</head>
<body>
	<!-- Container Table -->
	<div class="w3-container">
		<!-- Quote -->
		<div class="w3-panel w3-sand w3-large w3-serif">
		  <p>
		  	<h1><a onclick="toggleFullScreen()"><i class="fa fa-calendar"></i></a> AGENDA HARI INI</h1>
		  	<h2><?php echo longdate_indo(date('Y-m-d')); ?></h2>
		  </p>
		</div>
		<!-- End Quote -->
		<!-- Agenda Table -->
		<div id="cubo" class="AutoScroll">
			<table class="my-table AutoScroll" width="100%">
			    <thead>
			      <tr>
			          <th width="1%">No</th>
			          <th width="40%" style="text-align: center;">Kegiatan</th>
			          <th width="2%" style="text-align: center;">Tempat</th>
			          <th width="1%" style="text-align: center;">Waktu</th>
			          <th style="text-align: center;" width="1%">Pejabat</th>
			      </tr>
			    </thead>
			    <tbody id="container" class="scroller">
			    </tbody>
			</table>
		</div>
		<!-- End Agenda Table -->
		<button id="tombol" onclick="toggleFullScreenNew();" style="position:fixed;bottom: 0;">asdasdasda</button>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
	<!-- Container Table -->
	<!-- Footer -->
	<div class="w3-container w3-blue footer">
		<div class="waktu">
			<h2 id="waktu"></h2>
		</div>
		<div class="text-berjalan">
			<h2>
				<marquee>SELAMAT DATANG DI BIRO ADMINISTRASI PEMBANGUNAN SEKRETARIAT DAERAH PROVINSI SUMATERA BARAT</marquee>
			</h2>
		</div>
	</div>
	<!-- End Footer -->
</body>
	<script type="text/javascript">
	// 1 detik = 1000
	window.setTimeout("waktu()",1000);

	function waktu() {   
		var tanggal = new Date();  
		setTimeout("waktu()",1000);  
		document.getElementById("waktu").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
	}

	function toggleFullScreenNew() {
	  if (!document.fullscreenElement &&    // alternative standard method
	      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
	    if (document.documentElement.requestFullscreen) {
	      // document.documentElement.requestFullscreen();
	    } else if (document.documentElement.msRequestFullscreen) {
	      document.documentElement.msRequestFullscreen();
	    } else if (document.documentElement.mozRequestFullScreen) {
	      document.documentElement.mozRequestFullScreen();
	    } else if (document.documentElement.webkitRequestFullscreen) {
	      document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
	    }
	  } else {
	    if (document.exitFullscreen) {
	      document.exitFullscreen();
	    } else if (document.msExitFullscreen) {
	      document.msExitFullscreen();
	    } else if (document.mozCancelFullScreen) {
	      document.mozCancelFullScreen();
	    } else if (document.webkitExitFullscreen) {
	      document.webkitExitFullscreen();
	    }
	  }
	}
	$(document).ready(function () {
		// $('#full').fullscreen();
		$('#tombol').trigger('click');
		// toggleFullScreen();
		toggleFullScreenNew();
	    setInterval('agenda()', 1000);
	})

	var ob1 = new Scroller('#cubo');
    // $("#id-2").scroller();

	function agenda()
	{
		var waktu_lengkap;
		var waktu_split;
		var waktu;
		$.ajax({
	        url : "<?php echo base_url('welcome/akses_agenda/');?>",
	        type: "GET",
	        dataType: "HTML",
	        success: function(data)
	        {
	        	$('#container').html(data);
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            // alert('Error get data from ajax');
	        }
	    });
	}
	</script>
	<div style="display: none;">
	<audio controls autoplay>
	  <!-- <source src="https://www.w3schools.com/tags/horse.ogg" type="audio/ogg"> -->
	  <source src="<?php echo base_url(); ?>assets/mp3/Instrument-Memories-Minang-(Audio Only).mp3" type="audio/mpeg">
	  Your browser does not support the audio element.
	</audio>
	</div>
</html>