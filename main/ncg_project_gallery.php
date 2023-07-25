<?php 
    $page = "INYATSI PROJECT GALLERY";
    $link = "ncg_project_gallery.php";
    require_once("includes/header.php");
     if(isset($_GET['response'])){
            $response = $_GET['response'];
            $msg = $_GET['msg'];
            $html = $_GET['html'];
        }else{
            $response = "";
            $msg = "";
            $html = "";
        }
        $pid = $_GET['pid'];
        $gallery_files = NCG_FUNCT::GET_PROJECT_GALLERY_FILES($pid);
        $project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
    ?> 
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
          <input type="hidden" id="message" value="<?php echo $msg?>">
          <input type="hidden" id="title" value="Project Image Gallery">
          <input type="hidden" id="response" value="<?php echo $response?>">
          <input type="hidden" id="html" value="<?php echo $html?>">
            <div class="layout-px-spacing" style="background-image: url('assets/img/logo.png'); background-size: 100px; background-repeat: no-repeat; background-position: center;">
                <div class="row mt-5">
                    <div class="col-lg-9">
                        <h3>Project Image Gallery</h3>
                    </div>
                    <?php 
                    if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){?>
                    <div class="col-lg-3 dropdown filter custom-dropdown-icon">
                        <a class="dropdown-toggle btn btn-primary"  href="javascript:void(0);" data-toggle="modal" data-target="#uploadImages"><span class="text">Upload Images</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload-cloud"><polyline points="16 16 12 12 8 16"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg></a>
                    </div>
                <?php }?>
                </div>
                <hr>
                <div class="modal fade bd-example-modal-xl" id="uploadImages" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <form enctype="multipart/form-data" method="post" action="ncg_project_gallery">
                    <input type="hidden" name="pid" value="<?=$pid?>">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                             <div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="custom-file-container" data-upload-id="mySecondImage">
                                      <label>Upload PDF to project gallery <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                      <label class="custom-file-container__custom-file" >
                                          <input type="file" name="files[]" accept="application/pdf" class="custom-file-container__custom-file__custom-file-input" multiple>
                                          <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                          <span class="custom-file-container__custom-file__custom-file-control"></span>
                                      </label>
                                      <div class="custom-file-container__image-preview"></div>
                                  </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button type="submit" name="upload-to-gallery-jl21" class="btn btn-primary" >Upload</button>
                        </div>
                    </div>
                  </div>
                </form>
                </div>
                <div class="row layout-top-spacing" style="margin-bottom: 5px;">
                    <?php
                    if(mysqli_num_rows($gallery_files) <= 0){?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-card-two">
                            <div class="widget-content">

                                <div class="media">
                                    <div class="w-img">
                                        <img src="assets/img/logo.png" alt="avatar" style="border-radius: 0!important; border:0!important">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="text-right"><?=$project_info['PROJECT_NAME']?></h6>
                                        <p class="meta-date-time text-right">Gallery</p>
                                    </div>
                                </div>
                                <?php
                                if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){?>
                                <div class="card-bottom-section">
                                    <h5 class="text-center">No images found for the project</h5>
                                    <a class="btn btn-primary" style="float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#uploadImages" class="btn">Upload</a>
                                </div>
                            <?php }?>
                            </div>
                        </div>
                    </div>
                    <?php }else{?>
                        <div class="widget-content">
                            <div class="row">
                                <?php
                                
                                    while($file = $gallery_files ->fetch_assoc()){
                                    $name = $file['IMG_NAME'];
                                    $path = $file['IMG_URL'];
                                ?>
                                <div class="col-sm-3 mb-5">
                                        <div class="card component-card_9">
                                                   <img data-pdf-thumbnail-file="<?=$path?>" src="assets/img/loading.gif" class="card-img-top" alt="widget-card-2" data-pdf-thumbnail-height="200"  height="200">
                                                   <div class="card-body">
                                                       <p class="meta-date"><?php echo date("d M Y ", strtotime($file['TIMESTAMP']))?></p>

                                                       <h5 class="card-title" style="color: #FFF;"><?=$name?></h5>
                                                       <div class="meta-info">

                                                           <div class="meta-action">
                                                               <a href="javascript:void(0);" data-toggle="modal" data-target="#rename<?php echo $file['REC_ID']?>"><div class="action-icon act-download">
                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                                               </div></a>
                                                               <a href="<?=$path?>" download="<?=$name?>"><div class="action-icon act-download">
                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                               </div></a>
                                                               <a href="<?=$path?>" target = "_blank"><div class="action-icon act-view">
                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                               </div></a>

                                                               <a href="javascript:void(0);" data-toggle="modal" data-target="#delete<?php echo $file['REC_ID']?>"><div class="action-icon act-delete">
                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                               </div>
                                                           </a>
                                                           </div>

                                                       </div>
                                                   </div>
                                               </div>
                                        </div>
                                        <div class="modal fade modal-notification" id="rename<?php echo $file['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document" id="standardModalLabel">
                                                <div class="modal-content">
                                                <form method="post" action="ncg_project_gallery">
                                                  <div class="modal-body text-center">
                                                      <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                        <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                      </div></center>
                                                      <br>
                                                      <hr/>
                                                      <h4>Rename Image File</h4> 
                                                      <strong><p class="modal-text"><?php echo $name?></p></strong> <br><br><hr/>
                                                      <br>
                                                       <div class="col-lg-12">
                                                        <div class="input-group mb-4">
                                                          <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon5">File Name</span>
                                                          </div>
                                                          <input  class="form-control"type="text" name="new-name" placeholder="New file name...">
                                                        </div>
                                                      </div>
                                                      <input type="hidden" name="pid" value="<?=$pid?>">
                                                      <input type="hidden" name="img-id" value="<?=$file['REC_ID']?>">
                                                   </div>
                                                  <div class="modal-footer justify-content-between">
                                                    <button class="btn" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" name="rename-img-file-jl21" class="dropdown-item">Rename</button>
                                                  </div>
                                                </form>
                                                </div>
                                              </div>
                                            </div>
                                        <div class="modal fade modal-notification" id="delete<?php echo $file['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document" id="standardModalLabel">
                                                <div class="modal-content">
                                                  <div class="modal-body text-center">
                                                      <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                        <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                      </div></center>
                                                      <br>
                                                      <hr/>
                                                      <h4>Delete Gallery File</h4> 
                                                      <strong><p class="modal-text"><?php echo $name?></p></strong> <br><br><hr/>

                                                      <span class="badge badge-danger" style="cursor: default;"> This action can not be undone! </span>
                                                      <br>
                                                      <strong>
                                                        <p class="modal-text">Continue at your discretion</p></strong>
                                                   </div>
                                                  <div class="modal-footer justify-content-between">
                                                    <button class="btn" data-dismiss="modal">Cancel</button>
                                                      <?php
                                                        $dom = "delete-imgs-jl21=true&pid=".$pid."&img-id=".$file['REC_ID']."&path=".$path."&name=".$name;
                                                        $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                        ?>
                                                    <a class="btn btn-danger" href="ncg_project_gallery?xyz=<?=$dirty_data?>" class="dropdown-item">Delete</a>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>

                                <?php }?>
                            </div>
                        </div>
                     <?php 

                 }?>

            </div>
                </div>
            
            

        <?php include 'includes/footer.php';?>
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
            var html = document.getElementById("html").value;
            if(response !== ""){
                notify(msg, response, title, html);
            }
        });  
        function notify(msg, type, title, html){
            swal({
                  title: title,
                  type: type,
                  html: msg + html,
                  padding: '2em'
                });
        }
    </script>
    <script src="assets/js/custom.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/dashboard/dash_1.js"></script>

    <script src="plugins/file-upload/file-upload-with-preview.min.js"></script>

    <script src="plugins/lightbox/photoswipe.min.js"></script>
    <script src="plugins/lightbox/photoswipe-ui-default.min.js"></script>
    <script src="plugins/lightbox/custom-photswipe.js"></script>
    <script>
        var secondUpload = new FileUploadWithPreview('mySecondImage')
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
                   popup = {
                 init: function(){
                   $('figure').click(function(){
                     popup.open($(this));
                   });
                   
                   $(document).on('click', '.popup img', function(){
                     return false;
                   }).on('click', '.popup', function(){
                     popup.close();
                   })
                 },
                 open: function($figure) {
                   $('.gallery').addClass('pop');
                   $popup = $('<div class="popup" />').appendTo($('body'));
                   $fig = $figure.clone().appendTo($('.popup'));
                   $bg = $('<div class="bg" />').appendTo($('.popup'));
                   $close = $('<div class="close"><svg><use xlink:href="#close"></use></svg></div>').appendTo($fig);
                   $shadow = $('<div class="shadow" />').appendTo($fig);
                   src = $('img', $fig).attr('src');
                   $shadow.css({backgroundImage: 'url(' + src + ')'});
                   $bg.css({backgroundImage: 'url(' + src + ')'});
                   setTimeout(function(){
                     $('.popup').addClass('pop');
                   }, 10);
                 },
                 close: function(){
                   $('.gallery, .popup').removeClass('pop');
                   setTimeout(function(){
                     $('.popup').remove()
                   }, 100);
                 }
               }

               popup.init()

               </script>

</body>
</html>