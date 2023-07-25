<?php
$link = "ncg_privacy.php";
$level_of_access = "root";
$page = "INYATSI PRIVACY POLICY";
include 'includes/header.php';?>
    <div id="content" class="main-content">
            <div class="layout-px-spacing">

   <?php 
                          $privacy_data = NCG_FUNCT::GET_PRIVACY();
                          if(sizeof($privacy_data) > 0 ){?>
                            <div class="hd-tab-section">
                          
                            <div id="privacyWrapper" class="">
                              <div class="privacy-container">
                                  <div class="privacyContent">
                                      <div class="col-md-12 col-sm-12 col-12 text-center mb-5">
                                          <a href="index.php" class="navbar-brand-privacy">
                                              <img src="assets/img/wb_logo.png" class="img-fluid" alt="logo">
                                          </a>
                                      </div>
                                      <div class="d-flex justify-content-between privacy-head">
                                          <div class="privacyHeader">
                                              <h1>Privacy Policy</h1>
                                              <p>Updated <?php echo date("d M Y ", strtotime($privacy_data['TIMESTAMP']))?></p>
                                          </div>

                                          <div class="get-privacy-terms align-self-center">
                                              <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#edit-privacy" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg> Edit</a>
                                          </div>

                                      </div>

                                      <div class="privacy-content-container" style="color: #000!important">
                                          <?php include  $privacy_data['NCG_PRIVACY'];?>
                                      </div>

                                  </div>
                              </div>
                          </div>      
                        </div>

                          <?php } 
                          else{ ?>
                            <h4>Privacy Policy not available.</h4>
                          <?php }
                            ?>  

   
            </div>
         <?php include 'includes/footer.php';?>
        </div>

   

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