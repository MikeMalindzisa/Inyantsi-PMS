<?php
$link = "ncg_user_edit.php";
$page = "INYATSI USER EDIT";
    include 'includes/header.php';
        if(isset($_GET['response'])){
            $response = $_GET['response'];
            $msg = $_GET['msg'];
        }else{
            $response = "";
            $msg = "";
        }
        ?>
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">                
                    <input type="hidden" id="message" value="<?php echo $msg?>">
                    <input type="hidden" id="title" value="User Edit">
                    <input type="hidden" id="response" value="<?php echo $response?>">
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="general-info">
                                        <div class="row general-info info" style="height: 70px;">

                                            <div class="col-md-6  mb-5">
                                                    
                                            <h6 class="">Edit User Infomation</h6>
                                                </div>
                                                <div class="col-md-6 text-right mb-5">
                                                      <?php
                                                          $dom = "id=".$_SESSION['ncg-active']['UID']."&control=control";
                                                          $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                          ?>
                                                    <a href="ncg_user_profile.php?xyz=<?=$dirty_data?>" class="btn btn-primary">Back</a>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="general-info" class="section general-info" enctype="multipart/form-data" method="post" action="core_functions/functions">
                                        <div class="info">
                                            <div class="row info">

                                            <div class="col-md-6  mb-5">
                                                    
                                            <h6 style="font-weight: bolder; text-transform: uppercase;">Personal Infomation</h6>
                                                </div>
                                                <div class="col-md-6 text-right mb-5">
                                                    <button class="btn btn-primary" type="submit" name="update-personal">Save</button>
                                                </div>
                                        </div>
                                            <div class="row">
                                    
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                <input type="file" id="input-file-max-fs" class="dropify" data-default-file="<?php echo $photo; ?>" name="image" data-max-file-size="30M" />
                                                                <p class="mt-2" style="font-size: 12px;"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Full Name</label>
                                                                            <input type="text" class="form-control mb-4" id="fullName" placeholder="Full Name" value="<?php echo $user_info['NAME']?>" name="name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                <label for="phone">Phone</label>
                                                                <input type="tel" class="form-control mb-4" id="phone" placeholder="Phone" value="<?php echo $user_info['P_PHONE']?>" name="phone">
                                                            </div>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control mb-4" id="email" placeholder="Email" value="<?php echo $user_info['P_EMAIL']?>" name="email">
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="about" class="section about" method="post" action="ncg_user_edit">
                                        <div class="info">
                                            <div class="row info">

                                            <div class="col-md-6  mb-5">
                                                    
                                            <h6 style="font-weight: bolder; text-transform: uppercase;">Professional Infomation</h6>
                                                </div>
                                                <div class="col-md-6 text-right mb-5">
                                                    <button class="btn btn-primary" type="submit" name="update-professional">Save</button>
                                                </div>
                                        </div>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">
                                                    
                                                        <div class="col-xl-12 col-lg-12 col-md-12 ">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="department">Department</label>
                                                                            <input type="text" class="form-control mb-4" id="department" placeholder="Department" value="<?php echo $user_info['DEPARTMENT']?>" name="department">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                <label for="phone">Extention</label>
                                                                <input type="tel" class="form-control mb-4" id="phone" placeholder="Extention" value="<?php echo $user_info['EXTERNSION']?>" name="extension" >
                                                            </div>
                                                        </div>
                                                             <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                <label for="phone">Work Phone</label>
                                                                <input type="tel" class="form-control mb-4" id="phone" placeholder="Phone" value="<?php echo $_SESSION['ncg-active']['W_PHONE']?>" name="phone">
                                                            </div>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                <label for="email">Work Email</label>
                                                                <input type="email" class="form-control mb-4" id="email" placeholder="Email" value="<?php echo $_SESSION['ncg-active']['W_EMAIL']?>" name="email">
                                                            </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="about" class="section about" method="post" action="ncg_user_edit">
                                        <div class="info">
                                            <div class="row info">

                                            <div class="col-md-6  mb-5">
                                                    
                                            <h6 style="font-weight: bolder; text-transform: uppercase;">Account Password</h6>
                                                </div>
                                                <div class="col-md-6 text-right mb-5">
                                                    <button class="btn btn-primary" id="submit-btn" type="submit" name="change-pass">Update</button>
                                                </div>
                                        </div>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">
                                                    
                                                        <div class="col-xl-12 col-lg-12 col-md-12 ">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="pass">New Password</label>
                                                                            <input type="password" onkeyup="validate()" class="form-control mb-4" id="pass" placeholder="Password" name="new-password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                <label for="re-pass">Confirm Password</label>
                                                                <input type="password" class="form-control mb-4" onkeyup="validate()" id="repass" placeholder="Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <p id="warning" style="color: #ff0000!important"></p>
                                                        </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                
                </div>

                </div>
                <?php
                    include 'includes/footer.php';?>
        </div>

        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        // Scroll To Top
        $(document).on('click', '.arrow', function(event) {
          event.preventDefault();
          var body = $("html, body");
          body.stop().animate({scrollTop:0}, 500, 'swing');
        });
    </script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script type="text/javascript">
        $( document ).ready(function(){
            var msg = document.getElementById("message").value;
            var response = document.getElementById("response").value;
            var title = document.getElementById("title").value;
            if(response !== ""){
                notify(msg, response, title);
            }
        });  
        function notify(msg, type, title){
            swal({
                  title: title,
                  text: msg,
                  type: type,
                  padding: '2em'
                });
        }
    </script>
    <script src="plugins/highlight/highlight.pack.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
    <script type="text/javascript">
      function validate() {
        var pass = document.getElementById("pass");
        var re_pass = document.getElementById("repass");
        var btn = document.getElementById("submit-btn");
        var warning = document.getElementById("warning");

        if(pass.value !== re_pass.value){
          btn.disabled = true;
        }else{
          btn.disabled = false;
        }
        if(repass.value !== "" && pass.value !== ""){
          if(pass.value !== re_pass.value){
            warning.innerHTML = "Passwords do not match.";
          }else{
            warning.innerHTML = "";
          }
        }else{
          warning.innerHTML = "";
        }

      }
    </script>
</body>
</html>