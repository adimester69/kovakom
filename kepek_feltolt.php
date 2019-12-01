<?php
    // Alkalmazás logika:
    include('config.inc.php');
    $uzenet = array();

    // Űrlap ellenőrzés:
    if (isset($_POST['kuld'])) {
        //print_r($_FILES);
        foreach($_FILES as $fajl) {
            if ($fajl['error'] == 4);   // Nem töltött fel fájlt
            elseif (!in_array($fajl['type'], $MEDIATIPUSOK))
                $uzenet[] = " Nem megfelelő típus: " . $fajl['name'];
            elseif ($fajl['error'] == 1   // A fájl túllépi a php.ini -ben megadott maximális méretet
                        or $fajl['error'] == 2   // A fájl túllépi a HTML űrlapban megadott maximális méretet
                        or $fajl['size'] > $MAXMERET)
                $uzenet[] = " Túl nagy állomány: " . $fajl['name'];
            else {
                $vegsohely = $MAPPA.strtolower($fajl['name']);
                if (file_exists($vegsohely))
                    $uzenet[] = " Már létezik: " . $fajl['name'];
                else {
                    move_uploaded_file($fajl['tmp_name'], $vegsohely);
                    $uzenet[] = ' Ok: ' . $fajl['name'];
                }
            }
        }
    }
    // Megjelenítés logika:
?><!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Képek feltöltése</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="css/style.css">
  <style type="text/css">
      label { display: block; }
  </style>
</head>
<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-center">
              <li class="nav-item"><a class="nav-link" href="index.html">Kezdőlap</a></li>
              <li class="nav-item"><a class="nav-link" href="cegunk.html">Cégünkről</a>
                <li class="nav-item"><a class="nav-link" href="hirek.html">Hírek</a>
              <li class="nav-item"><a class="nav-link" href="archive.php">Archívum</a></li>
              <li class="nav-item active"><a class="nav-link" href="kepek_feltolt.html">Képek feltöltése</a></li>
              <li class="nav-item"><a class="nav-link" href="contact.html">Kapcsolatfelvétel</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-social">
              <li><a href="https://www.facebook.com"><i class="ti-facebook"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->

  <!--================ Hero sm Banner start =================-->
  <section class="mb-30px">
    <div class="container">
      <div class="hero-banner">
        <div class="hero-banner__content">
          <h3>KÖVA-KOM NONPROFIT ZRT.</h3>
            <h1>Képek feltöltése</h1>
        </div>
      </div>
    </div>
  </section>
  <!--================ Hero sm Banner end =================-->



  <!--================ Start Blog Post Area =================-->
  <section class="blog-post-area section-margin">
    <div class="container">

        <h1 align = "center">Feltöltés a galériába:</h1>
        <?php
            if (!empty($uzenet))
            {
                echo '<ul>';
                foreach($uzenet as $u)
                    echo "<li>$u</li>";
                echo '</ul>';
            }
        ?>
            <form action="kepek_feltolt.php" method="post"
                        enctype="multipart/form-data" align = "center">
                <label>Első:
                    <input type="file" name="elso" required>
                </label>
                <label>Második:
                    <input type="file" name="masodik">
                </label>
                <label>Harmadik:
                    <input type="file" name="harmadik">
                </label>
                <input type="submit" name="kuld">
              </form>

        <!-- Start Blog Post Siddebar -->

            </div>
          </div>
        <!-- End Blog Post Siddebar -->
      </div>
  </section>
  <!--================ End Blog Post Area =================-->

  <!--================ Start Footer Area =================-->
  <footer class="footer-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Önkormányzati tulajdonú ingatlanok elidegenítése</h6>
            <p>
              Nagykőrös Város Önkormányzat Képviselő-testületének 46/2018.(III.29.) sz. határozata alapján egyes önkormányzati tulajdonú  ingatlanok elidegenítésre kerülnek.
            </p>
          </div>
        </div>

        <div class="col-lg-4 sidebar-widgets">
            <div class="widget-wrap">
              <div class="single-sidebar-widget newsletter-widget">
                <h4 class="single-sidebar-widget__title">Keresés</h4>
                <div class="form-group mt-30">
                  <div class="col-autos">
                    <form action="https://www.google.hu/search" class="searchform" method="get" name="searchform" target="_blank">
  <input autocomplete="on" class="form-control search" name="q" placeholder="Keresés..." required="required"  type="text">
  </form>
                  </div>
                </div>
              </div>

              </div>
            </div>

        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Kövess minket</h6>
            <div class="footer-social d-flex align-items-center">
              <a href="https://www.facebook.com">
                <i class="fab fa-facebook-f"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
        <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> KÖVA-KOM Nonprofit Zrt. 2750. Nagykőrös Lőrinc pap u. 3. | tel: 53/550 250 | fax: 53/550-252 | © Jogi nyilatkozat |
  <a href = "http://www.kovart.hu"> Eredeti weboldal </a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>

      </div>
    </div>
  </footer>
  <!--================ End Footer Area =================-->

  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
