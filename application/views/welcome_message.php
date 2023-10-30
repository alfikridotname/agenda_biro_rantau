<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Agenda - Biro Administrasi Pembangunan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?php echo base_url() ?>assets/home_template_elearning/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo base_url() ?>assets/home_template_elearning/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/home_template_elearning/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url() ?>assets/home_template_elearning/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo base_url() ?>assets/home_template_elearning/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
 
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="<?php echo base_url() ?>assets/logo_biro.png" style="width:300px">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
              <!--   <a href="index.html" class="nav-item nav-link">Home</a>
                <a href="about.html" class="nav-item nav-link active">About</a>
                <a href="courses.html" class="nav-item nav-link">Courses</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a> -->
            </div>
            <a href="" class="btn btn-primary px-lg-5 d-none d-lg-block" > <?php echo longdate_indo(date('Y-m-d')); ?> <br><span id="waktu"></span></a>
        </div>
    </nav>
    <!-- Navbar End -->
    
    <!-- About Start -->
   
    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="">Agenda Hari Ini</h1>
                <h6 class="section-title bg-white text-center text-primary px-3 mb-5"><?php echo longdate_indo(date('Y-m-d')); ?></h6>
            </div>
            <div class="row g-4">
                <div class="col-lg-12 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                	<?php if ($count>0) { ?>
                   <table class="table table-striped table-bordered" width="100%">
			    <thead>
			      <tr>
			          <th width="1%">No</th>
			          <th style="text-align: center;">Kegiatan</th>
			          <th width="2%" style="text-align: center;">Tempat</th>
			          <th width="1%" style="text-align: center;">Waktu</th>
			          <th >Pejabat</th>
			      </tr>
			    </thead>
			    <tbody id="container" class="scroller">
			    </tbody>
			</table>
		<?php }else{ ?>
			<div class="alert alert-info">Tidak ada agenda hari ini</div>
		<?php } ?>


                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
        

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer sticky-bottom" data-wow-delay="0.1s" style=" position: fixed; bottom: 0; ">
        
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-12 text-center text-md-start mb-3 mb-md-0" style="text-align:center">
                       <center> 
                       	&copy; <a class="border-bottom" href="#">Agenda </a> Biro Administrasi Pembangunan
 |
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> |
                        Develop By <a class="border-bottom" href="#">Alfikri</a> |
                        Edited By <a class="border-bottom" href="https://www.instagram.com/hamidseptian" target="_blank">Hamid Septian</a> 
                    </center>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


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



</body>

</html>


