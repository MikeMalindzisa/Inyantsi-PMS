<?php include "core_functions/functions.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>INYATSI PRIVACY POLICY</title>
    <link href="assets/img/logo.png" rel="icon" type="image/x-icon" />
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="assets/css/pages/privacy/privacy.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
</head>
<body>
    

    <div id="headerWrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12 text-center mb-5">
                    <a href="index" class="navbar-brand-privacy">
                        <img src="assets/img/ww_logo.png" class="img-fluid" alt="logo">
                    </a>
                </div>
                <div class="col-md-12 col-sm-12 col-12 text-center">
                    <h2 class="main-heading">Inyatsi Construction Group</h2>
                </div>
            </div>
        </div>
    </div>
    <?php 
          $privacy_data = NCG_FUNCT::GET_PRIVACY();
          if(sizeof($privacy_data) > 0 ){?>

              <div id="privacyWrapper" class="">
                <div class="privacy-container">
                    <div class="privacyContent">
                        <div class="col-md-12 col-sm-12 col-12 text-center mb-5">
                            <a href="index" class="navbar-brand-privacy">
                                <img src="assets/img/wb_logo.png" class="img-fluid" alt="logo">
                            </a>
                        </div>
                        <div class="d-flex justify-content-between privacy-head">
                            <div class="privacyHeader">
                                <h1>Privacy Policy</h1>
                                <p>Updated <?php echo date("d M Y ", strtotime($privacy_data['TIMESTAMP']))?></p>
                            </div>

                             <div class="get-privacy-terms align-self-center">
                                <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> Save</button>
                            </div>

                        </div>

                        <div class="privacy-content-container" style="color: #000!important">
                            <?php include  $privacy_data['NCG_PRIVACY'];?>
                        </div>

                    </div>
                </div>
            </div>  

        <?php } 
        else{ ?>
          <h4>Privacy Policy not available.</h4>
        <?php }
          ?>  

    <?php include 'includes/footer.php';?>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script>
        // Scroll To Top
        $(document).on('click', '.arrow', function(event) {
          event.preventDefault();
          var body = $("html, body");
          body.stop().animate({scrollTop:0}, 500, 'swing');
        });
    </script>

</body>
</html>