<?php
$link = "ncg_sec_groups.php";
$page = "INYATSI SECURITY GROUPS";
$level_of_access = "root";
    include "includes/header.php";
        if(isset($_GET['response'])){
            $response = $_GET['response'];
            $msg = $_GET['msg'];
            $html = $_GET['html'];
        }else{
            $response = "";
            $msg = "";
            $html = "";
        }
    ?>
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <input type="hidden" id="message" value="<?php echo $msg?>">
            <input type="hidden" id="title" value="Security Group">
            <input type="hidden" id="response" value="<?php echo $response?>">
            <input type="hidden" id="html" value="<?php echo $html?>">
           <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                  <h3>Security Groups<button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#new-group"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></button></h3>                                
                  <div class="animated-underline-content">
                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" href="#internal" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-left-down"><polyline points="14 15 9 20 4 15"></polyline><path d="M20 4h-7a4 4 0 0 0-4 4v12"></path></svg> Internal Groups</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" href="#external" role="tab" aria-controls="animated-underline-profile" aria-selected="false"></svg> External Groups <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-right-up"><polyline points="10 9 15 4 20 9"></polyline><path d="M4 20h7a4 4 0 0 0 4-4V4"></path></a>
                      </li>
                    </ul>
                    <div class="tab-content" id="animateLineContent-4">
                      <!--Internal Groups tab panel-->
                      <div class="tab-pane fade show active" id="internal" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                        <section id="internal-groups">
                          <div class="table-responsive mb-4 mt-4">
                                <table id="internal_group" class="table " style="width:100%; overflow-y: hidden; z-index: 1">
                                    <thead>
                                        <tr>
                                            <th>Group Name</th>
                                            <th>Facilitator</th>
                                            <th>Members</th>
                                            <th>Permissions</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $groups = NCG_FUNCT::GET_SECURITY_GROUPS("Internal");
                                            while($group = $groups ->fetch_assoc()){
                                                $permissions = "";
                                                if($group['FACILITATOR'] == NULL){
                                                    $facilitator = "NULL";
                                                }else{
                                                    $facilitator = NCG_FUNCT::GET_FACILITATOR_NAME($group['FACILITATOR']);
                                                }
                                                $permissions_arr = explode(",", $group['PERMISSIONS']);
                                                foreach ($permissions_arr as $permission) {
                                                    $permissions = $permissions.$permission;
                                                }
                                                    $members_count = NCG_FUNCT::COUNT_GROUP_MEMBERS($group['REC_ID'], $group['DOMAIN']);
                                                     if($group['STATUS'] == "Active"){
                                                        $command = "deactivate";
                                                        $status_control = "Deactivate Group";
                                                        $action_modal = "int_deactivate";

                                                    }else{
                                                        $command = "activate";
                                                        $status_control = "Activate Group";
                                                        $action_modal = "int_activate";
                                                    }
                                                  if(in_array('C', $permissions_arr)){
                                                      $create_per_status = "checked";
                                                  }else{
                                                    $create_per_status = "";
                                                  }
                                                  if(in_array('R', $permissions_arr)){
                                                      $read_per_status = "checked";
                                                  }else{
                                                    $read_per_status = "";
                                                  }
                                                  if(in_array('U', $permissions_arr)){
                                                      $update_per_status = "checked";
                                                  }else{
                                                    $update_per_status = "";
                                                  }
                                                  if(in_array('D', $permissions_arr)){
                                                      $delete_per_status = "checked";
                                                  }else{
                                                    $delete_per_status = "";
                                                  }
                                                  if(in_array('S', $permissions_arr)){
                                                      $special_per_status = "checked";
                                                  }else{
                                                    $special_per_status = "";
                                                  }
                                                ?>

                                        <tr>
                                            <td><?php echo $group['GRP_NAME']?></td>
                                            <td><?php echo $facilitator?></td>
                                            <td><?php echo $members_count?></td>
                                            <td><?php echo $permissions?></td>
                                            <td><?php echo $group['STATUS']?></td>
                                            <td class="text-center">
                                                 <div class="btn-group mb-4 mr-2" style="width: 100%; z-index: 2;" role="group">
                                                        <button id="action<?php echo $group['REC_ID']?>" type="button" class="btn btn-primary dropdown-toggle pull-left" data-toggle="modal" data-target="#action-menu<?php echo $group['REC_ID']?>">Action <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down pull-right"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                                        
                                                    </div>
                                                    <div class="modal fade modal-notification" id="action-menu<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="actionMenu" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="actionMenu">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>

                                                                  <center><strong><h4 class="modal-text"><?php echo $group['GRP_NAME']?></h4></strong></center>
                                                                  <hr/> <br><br>

                                                                  <h4>Select Action</h4> <hr/>
                                                                    <?php if($members_count < NCG_FUNCT::COUNT_INTERNAL_USERS()){?>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#new-member<?php echo $group['REC_ID']?>">Add Members</a>
                                                                    <?php }?>
                                                                    <?php if($members_count > 0){?>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#members<?php echo $group['REC_ID']?>">View Members</a>
                                                                    <?php }?>
                                                                    <hr/>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#rename<?php echo $group['REC_ID']?>">Rename Group</a>
                                                                     <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#<?php echo $action_modal.$group['REC_ID']?>"><?php echo $status_control?></a>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#mod-permissions<?php echo $group['REC_ID']?>">Modify Permissions</a>
                                                                    <hr/>
                                                                    <?php if($members_count > 0){?>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#clear-members<?php echo $group['REC_ID']?>">Clear Members</a>
                                                                    <?php }?>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#delete<?php echo $group['REC_ID']?>">Delete Group</a>
                                                            </div> 
                                                            <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal"  >Cancel</button>
                                                              </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="modal fade modal-notification" id="int_activate<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Activate Group</h4> 
                                                                  <strong><p class="modal-text"><?php echo $group['GRP_NAME']?></p></strong> <br><br>
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                  <?php
                                                                    $dom = "action=group-a-d&command=".$command."&gid=".$group['REC_ID']."&name=".$group['GRP_NAME'];
                                                                    $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                    ?>
                                                                <a class="btn btn-success" href="ncg_sec_groups?xyz=<?=$dirty_data?>" class="dropdown-item">Activate</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      <div class="modal fade modal-notification" id="int_deactivate<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Disactivate Group</h4> 
                                                                  <strong><p class="modal-text"><?php echo $group['GRP_NAME']?></p></strong> <br><br><hr/>

                                                                  <span class="badge badge-warning" style="cursor: default;"> It can be activated again! </span>
                                                                  <br>
                                                                  <strong>
                                                                    <p class="modal-text">Group members will not suffer data loss.</p></strong>
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                  <?php
                                                                  $dom = "action=group-a-d&command=".$command."&gid=".$group['REC_ID']."&name=".$group['GRP_NAME'];
                                                                  $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                  ?>
                                                                <a class="btn btn-warning" href="ncg_sec_groups?xyz=<?=$dirty_data?>" class="dropdown-item">Deactivate</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    <div class="modal fade modal-notification" id="mod-permissions<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                      <form method="post" action="ncg_sec_groups">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4 class="modal-text">Modify <strong><?php echo $group['GRP_NAME']?></strong> permissions.</h4>
                                                                   <br><hr/>
                                                                  <input type="hidden" name="name" value="<?php echo $group['GRP_NAME']?>">
                                                                  <input type="hidden" name="gid" value="<?php echo $group['REC_ID']?>">

                                                          <div class="row" style="padding-left: 14px;">
                                                            <div class="col-sm-12">
                                                                <h4>Permissions</h4>
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <div class="col-sm-4">
                                                              <div class="n-chk">
                                                                  <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                                    <input type="checkbox" class="new-control-input" name="permissions[]" value="C" <?php echo $create_per_status?>>
                                                                    <span class="new-control-indicator"></span><span class="new-chk-content">CREATE</span>
                                                                  </label>
                                                              </div>
                                                            </div>
                                                              <div class="col-sm-4">
                                                                <div class="n-chk">
                                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-primary">
                                                                      <input type="checkbox" class="new-control-input" <?php echo $read_per_status?> name="permissions[]" value="R">
                                                                      <span class="new-control-indicator"></span><span class="new-chk-content">READ</span>
                                                                    </label>
                                                                </div>
                                                              </div>
                                                              <div class="col-sm-4">
                                                                <div class="n-chk">
                                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-dark">
                                                                      <input type="checkbox" class="new-control-input" name="permissions[]" value="U" <?php echo $update_per_status?>>
                                                                      <span class="new-control-indicator"></span><span class="new-chk-content">UPDATE</span>
                                                                    </label>
                                                                </div>
                                                              </div>
                                                              <div class="col-sm-4">
                                                                <div class="n-chk">
                                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-danger">
                                                                      <input type="checkbox" class="new-control-input" name="permissions[]" value="D" <?php echo $delete_per_status?>>
                                                                      <span class="new-control-indicator"></span><span class="new-chk-content">DELETE</span>
                                                                    </label>
                                                                </div>
                                                              </div>
                                                              <div class="col-sm-4">
                                                                <div class="n-chk">
                                                                    <label class="new-control new-checkbox new-checkbox-text checkbox-secondary">
                                                                      <input type="checkbox" class="new-control-input" name="permissions[]" value="S" <?php echo $special_per_status?>>
                                                                      <span class="new-control-indicator"></span><span class="new-chk-content">SPECIAL</span>
                                                                    </label>
                                                                </div>
                                                              </div>
                                                          </div>
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                <button class="btn btn-primary" type="submit" name="modify-permissions">Modify</button>
                                                              </div>
                                                            </div>
                                                          </div>
                                                      </form>
                                                        </div>
                                                    <div class="modal fade modal-notification" id="delete<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Delete Group</h4> 
                                                                  <strong><p class="modal-text"><?php echo $group['GRP_NAME']?></p></strong> <br><br><hr/>

                                                                  <span class="badge badge-danger" style="cursor: default;"> This action can not be undone! </span>
                                                                  <br>
                                                                  <strong>
                                                                    <p class="modal-text">Continue at your discretion</p></strong>
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                  <?php
                                                                    $dom = "action=delete-grp&gid=".$group['REC_ID']."&name=".$group['GRP_NAME'];
                                                                    $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                    ?>
                                                                <a class="btn btn-danger" href="ncg_sec_groups?xyz=<?=$dirty_data?>" class="dropdown-item">Delete</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    <div class="modal fade modal-notification" id="rename<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                      <form method="post" action="ncg_sec_groups">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Rename Group</h4>
                                                                  <strong><p class="modal-text"><?php echo $group['GRP_NAME']?></p></strong> <br><hr/>
                                                                  <input type="text" class="form-control" placeholder="New group name" name="new-name" value="<?php echo $group['GRP_NAME']?>" required>
                                                                  <input type="hidden" name="name" value="<?php echo $group['GRP_NAME']?>">
                                                                  <input type="hidden" name="gid" value="<?php echo $group['REC_ID']?>">
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                <button class="btn btn-primary" type="submit" name="rename-group">Rename</button>
                                                              </div>
                                                            </div>
                                                          </div>
                                                      </form>
                                                        </div>
                                                    <div class="modal fade bd-example-modal-xl" id="new-member<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myExtraLargeModalLabel">Add <strong><?php echo $group['GRP_NAME']?></strong> Members</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="ncg_sec_groups">
                                                            <input type="hidden" name="grp-id" value="<?php echo $group['REC_ID']?>">
                                                        <div class="modal-body">
                                                           <div class="row">
                                                               <div class="col-sm-12">
                                                                <label>Users</label>
                                                                <?php 
                                                                    $old_members_data = NCG_FUNCT::GET_GROUP_MEMBER_INFO($group['REC_ID']);
                                                                    $old_members_ids = array();
                                                                    while($members_data = $old_members_data ->fetch_assoc()){
                                                                        array_push($old_members_ids, $members_data['USER_ID']);
                                                                    }
                                                                    $users_request_response = NCG_FUNCT::GET_ALL_USER_INFO();?>
                                                                    <div class="input-group col-sm-12">
                                                                      <select class="selectpicker dropup" data-header="Search and select or select to Choose members to add."  data-size="5" data-width="100%" multiple data-actions-box="true" data-live-search="true" name="members-list[]" required title="Select members">
                                                                          <?php
                                                                            while($user = $users_request_response ->fetch_assoc()){
                                                                                if(!in_array($user['USER_ID'], $old_members_ids)){
                                                                                    echo "<option value='{$user['USER_ID']}' data-tokens='{$user['NAME']}'>{$user['NAME']}</option>";
                                                                                }
                                                                            }?>                                                   </select>
                                                                    </div>

                                                                 
                                                               </div>
                                                           </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                            <button type="submit" name="add-members" class="btn btn-primary">Add</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                  </div>
                                            </div>
                                                    <div class="modal fade bd-example-modal-xl" id="members<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myExtraLargeModalLabel"><strong><?php echo $group['GRP_NAME']?></strong> Members</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                           <section >
                                                                <div class="table-responsive mb-4 mt-4">
                                                                    <table id="internal_members" class="table " style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>User Name</th>
                                                                                <th>Department</th>
                                                                                <th>Email</th>
                                                                                <th>Phone</th>
                                                                                <th>Extension</th>
                                                                                <th class="text-center">Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php 
                                                                                $group_memebers = NCG_FUNCT::GET_GROUP_MEMBERS($group['REC_ID'], $group['DOMAIN']);
                                                                                while($member = $group_memebers ->fetch_assoc()){
                                                                                    $member_data = NCG_FUNCT::GET_GROUP_MEMBERS_INFO($member['USER_ID']);
                                                                                    while($info = $member_data ->fetch_assoc()){?>
                                                                            <tr>
                                                                                <td><?php echo $info['NAME']?></td>
                                                                                <td><?php echo $info['DEPARTMENT']?></td>
                                                                                <td><?php echo $info['W_EMAIL']?></td>
                                                                                <td><?php echo $info['W_PHONE']?></td>
                                                                                <td><?php echo $info['EXTERNSION']?></td>
                                                                                <td class="text-center">
                                                                                    <div class="btn-group mb-4 mr-2" style="width: 100%" role="group">
                                                                                        <button id="action<?php echo $member['USER_ID'].$group['REC_ID']?>" type="button" class="btn btn-primary dropdown-toggle pull-left" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down pull-right"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                                                                          <div class="dropdown-menu" style="width: 100%;" tabindex="-1" role="dialog" aria-labelledby="action<?php echo $member['USER_ID'].$group['REC_ID']?>">
                                                                                            <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#promote<?php echo $member['USER_ID'].$group['REC_ID']?>">Promote</a>
                                                                                            <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#demote<?php echo $member['USER_ID'].$group['REC_ID']?>">Demote</a>
                                                                                            <hr/>
                                                                                            <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#remove<?php echo $member['USER_ID'].$group['REC_ID']?>">Remove</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal fade modal-notification" id="remove<?php echo $member['USER_ID'].$group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                                                      <div class="modal-dialog" role="document" id="standardModalLabel">
                                                                                        <div class="modal-content">
                                                                                          <div class="modal-body text-center">
                                                                                              <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                                                <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                                              </div></center>
                                                                                              <br>
                                                                                              <hr/>
                                                                                              <h4>You are about to remove</h4>
                                                                                              <strong><p class="modal-text"><?php echo $info['NAME']?></p></strong>
                                                                                              <h5>From the group</h5> <br><hr/>
                                                                                              <h4><strong><?php echo $group['GRP_NAME']?></strong> </h4>
                                                                                           </div>
                                                                                          <div class="modal-footer justify-content-between">
                                                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                                                              <?php
                                                                                                $dom = "action=remove&uid=".$member['USER_ID']."&gid=".$group['REC_ID']."&current=".$group['FACILITATOR'];
                                                                                                $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                                                ?>
                                                                                            <a class="btn btn-danger" href="ncg_sec_groups?xyz=<?=$dirty_data?>">Remove</a>
                                                                                          </div>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                    <div class="modal fade modal-notification" id="demote<?php echo $member['USER_ID'].$group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                                                      <div class="modal-dialog" role="document" id="standardModalLabel">
                                                                                        <div class="modal-content">
                                                                                          <div class="modal-body text-center">
                                                                                              <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                                                <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                                              </div></center>
                                                                                              <br>
                                                                                              <hr/>
                                                                                              <h4>You are about to demote</h4>
                                                                                              <strong><p class="modal-text"><?php echo $info['NAME']?></p></strong>
                                                                                              <h5>From facilitating</h5> <br><hr/>
                                                                                              <h4><strong><?php echo $group['GRP_NAME']?></strong> </h4>
                                                                                           </div>
                                                                                          <div class="modal-footer justify-content-between">
                                                                                            <button class="btn" data-dismiss="modal" data-target="#demote<?php echo $member['USER_ID'].$group['REC_ID']?>"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                                                              <?php
                                                                                                $dom = "action=demote&uid=".$member['USER_ID']."&gid=".$group['REC_ID']."&current=".$group['FACILITATOR'];
                                                                                                $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                                                ?>
                                                                                            <a class="btn btn-warning" href="ncg_sec_groups?xyz=<?=$dirty_data?>">Demote</a>
                                                                                          </div>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                    <div class="modal fade modal-notification" id="promote<?php echo $member['USER_ID'].$group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                                                      <div class="modal-dialog" role="document" id="standardModalLabel">
                                                                                        <div class="modal-content">
                                                                                          <div class="modal-body text-center">
                                                                                              <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                                                <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                                              </div></center>
                                                                                              <br>
                                                                                              <hr/>
                                                                                              <h4>You are about to promote</h4>
                                                                                              <strong><p class="modal-text"><?php echo $info['NAME']?></p></strong>
                                                                                              <h5>To facilitate</h5> <br><hr/>
                                                                                              <h4><strong><?php echo $group['GRP_NAME']?></strong> </h4>
                                                                                           </div>
                                                                                          <div class="modal-footer justify-content-between">
                                                                                            <button class="btn" data-dismiss="modal" data-target="#promote<?php echo $member['USER_ID'].$group['REC_ID']?>"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                                                              <?php
                                                                                                  $dom = "action=promote&uid=".$member['USER_ID']."&gid=".$group['REC_ID']."&current=".$group['FACILITATOR'];
                                                                                                  $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                                                  ?>
                                                                                            <a class="btn btn-primary" href="ncg_sec_groups.php?xyz=<?=$dirty_data?>">Promote</a>
                                                                                          </div>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <?php 
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th>User Name</th>
                                                                                <th>Department</th>
                                                                                <th>Email</th>
                                                                                <th>Phone</th>
                                                                                <th>Extension</th>
                                                                                <th class="text-center">Action</th>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                            <button data-toggle="modal" data-target="#clear-members<?php echo $group['REC_ID']?>" class="btn btn-primary">Clear Members</button>
                                                        </div>
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="modal fade modal-notification" id="clear-members<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Clear Group Members</h4> 
                                                                  <strong><p class="modal-text"><?php echo $group['GRP_NAME']?></p></strong> <br><br><hr/>

                                                                  <span class="badge badge-danger" style="cursor: default;"> This action can not be undone! </span>
                                                                  <br>
                                                                  <strong>
                                                                    <p class="modal-text">Continue at your discretion</p></strong>
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                  <?php
                                                                    $dom = " action=reset-group&gid=".$group['REC_ID']."&name=".$group['GRP_NAME'];
                                                                    $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                    ?>
                                                                <a class="btn btn-danger" href="ncg_sec_groups?xyz=<?=$dirty_data?>" class="dropdown-item">Clear</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                             </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Group Name</th>
                                            <th>Facilitators</th>
                                            <th>Members</th>
                                            <th>Permissions</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>
                        
                      </div>
                      <!--Internal Groups tab panel-->
                      <!--External Groups tab panel-->
                      <div class="tab-pane fade show" id="external" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                        <section id="internal-groups">
                          <div class="table-responsive mb-4 mt-4">
                                <table id="external_group" class="table " style="width:100%; overflow-y: hidden; z-index: 1">
                                    <thead>
                                        <tr>
                                            <th>Group Name</th>
                                            <th>Members</th>
                                            <th>Permissions</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $groups = NCG_FUNCT::GET_SECURITY_GROUPS("External");
                                            while($group = $groups ->fetch_assoc()){
                                                $permissions = "";
                                                $permissions_arr = explode(",", $group['PERMISSIONS']);
                                                foreach ($permissions_arr as $permission) {
                                                    $permissions = $permissions.$permission;
                                                }
                                                    $members_count = NCG_FUNCT::COUNT_GROUP_MEMBERS($group['REC_ID'], $group['DOMAIN']);
                                                    if($group['STATUS'] == "Active"){
                                                        $command = "deactivate";
                                                        $status_control = "Deactivate Group";
                                                        $action_modal = "ext_deactivate";

                                                    }else{
                                                        $command = "activate";
                                                        $status_control = "Activate Group";
                                                        $action_modal = "ext_activate";
                                                    }
                                                ?>

                                        <tr>
                                            <td><?php echo $group['GRP_NAME']?></td>
                                            <td><?php echo $members_count?></td>
                                            <td><?php echo $permissions?></td>
                                            <td><?php echo $group['STATUS']?></td>
                                            <td class="text-center">
                                                 <div class="btn-group mb-4 mr-2" style="width: 100%; z-index: 2;" role="group">
                                                        <button id="action<?php echo $group['REC_ID']?>" type="button" class="btn btn-primary dropdown-toggle pull-left"data-toggle="modal" data-target="#action-menu<?php echo $group['REC_ID']?>">Action <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down pull-right"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                                        
                                                    </div>
                                                    <div class="modal fade modal-notification" id="action-menu<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="actionMenu" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="actionMenu">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>

                                                                  <center><strong><h4 class="modal-text"><?php echo $group['GRP_NAME']?></h4></strong></center>
                                                                  <hr/> <br><br>

                                                                  <h4>Select Action</h4> <hr/>
                                                                    <?php if($members_count < NCG_FUNCT::COUNT_EXTERNAL_USERS()){?>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#ext_new-member<?php echo $group['REC_ID']?>">Add Members</a>
                                                                    <?php }?>
                                                                    <?php if($members_count > 0){?>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#ext_members<?php echo $group['REC_ID']?>">View Members</a>
                                                                    <?php }?>
                                                                    <hr/>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#ext_rename<?php echo $group['REC_ID']?>">Rename Group</a>
                                                                     <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#<?php echo $action_modal.$group['REC_ID']?>"><?php echo $status_control?></a>
                                                                    <hr/>
                                                                    <?php if($members_count > 0){?>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#ext_clear-members<?php echo $group['REC_ID']?>">Clear Members</a>
                                                                    <?php }?>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#ext_delete<?php echo $group['REC_ID']?>">Delete Group</a>
                                                            </div> 
                                                            <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal"  >Cancel</button>
                                                              </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    <div class="modal fade modal-notification" id="ext_deactivate<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Disactivate Group</h4> 
                                                                  <strong><p class="modal-text"><?php echo $group['GRP_NAME']?></p></strong> <br><br><hr/>

                                                                  <span class="badge badge-warning" style="cursor: default;"> It can be activated again! </span>
                                                                  <br>
                                                                  <strong>
                                                                    <p class="modal-text">Group members will not suffer data loss.</p></strong>
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                  <?php
                                                                    $dom = "action=group-a-d&command=".$command."&gid=".$group['REC_ID']."&name=".$group['GRP_NAME'];
                                                                    $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                    ?>
                                                                <a class="btn btn-warning" href="ncg_sec_groups?xyz=<?=$dirty_data?>" class="dropdown-item">Deactivate</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    <div class="modal fade modal-notification" id="ext_activate<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Activate Group</h4> 
                                                                  <strong><p class="modal-text"><?php echo $group['GRP_NAME']?></p></strong> <br><br>
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                  <?php
                                                                    $dom = "action=group-a-d&command=".$command."&gid=".$group['REC_ID']."&name=".$group['GRP_NAME'];
                                                                    $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                    ?>
                                                                <a class="btn btn-success" href="ncg_sec_groups.php?xyz=<?=$dirty_data?>" class="dropdown-item">Activate</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    <div class="modal fade modal-notification" id="ext_delete<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Delete Group</h4> 
                                                                  <strong><p class="modal-text"><?php echo $group['GRP_NAME']?></p></strong> <br><br><hr/>

                                                                  <span class="badge badge-danger" style="cursor: default;"> This action can not be undone! </span>
                                                                  <br>
                                                                  <strong>
                                                                    <p class="modal-text">Continue at your discretion</p></strong>
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                  <?php
                                                                    $dom = "action=delete-grp-ext&gid=".$group['REC_ID']."&name=".$group['GRP_NAME'];
                                                                    $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                    ?>
                                                                <a class="btn btn-danger" href="ncg_sec_groups.php?xyz=<?=$dirty_data?>" class="dropdown-item">Delete</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    <div class="modal fade modal-notification" id="ext_rename<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                      <form method="post" action="ncg_sec_groups">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Rename Group</h4>
                                                                  <strong><p class="modal-text"><?php echo $group['GRP_NAME']?></p></strong> <br><hr/>
                                                                  <input type="text" class="form-control" placeholder="New group name" name="new-name" value="<?php echo $group['GRP_NAME']?>" required>
                                                                  <input type="hidden" name="name" value="<?php echo $group['GRP_NAME']?>">
                                                                  <input type="hidden" name="gid" value="<?php echo $group['REC_ID']?>">
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                <button class="btn btn-primary" type="submit" name="rename-group">Rename</button>
                                                              </div>
                                                            </div>
                                                          </div>
                                                      </form>
                                                        </div>
                                                    <div class="modal fade bd-example-modal-xl" id="ext_new-member<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myExtraLargeModalLabel">Add <strong><?php echo $group['GRP_NAME']?></strong> Members</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="ncg_sec_groups">
                                                            <input type="hidden" name="grp-id" value="<?php echo $group['REC_ID']?>">
                                                        <div class="modal-body">
                                                           <div class="row">
                                                               <div class="col-sm-12">
                                                                <label>Users</label>
                                                                <?php 
                                                                    $old_members_data = NCG_FUNCT::GET_EXTERNAL_GROUP_MEMBER_INFO($group['REC_ID']);
                                                                    $old_members_ids = array();
                                                                    while($members_data = $old_members_data ->fetch_assoc()){
                                                                        array_push($old_members_ids, $members_data['USER_ID']);
                                                                    }
                                                                    $users_request_response = NCG_FUNCT::GET_ALL_EXTERNAL_USER_INFO();?>
                                                                    <div class="input-group col-sm-12">
                                                                      <select class="selectpicker dropup" data-header="Search and select or select to Choose members to add."  data-size="5" data-width="100%" multiple data-actions-box="true" data-live-search="true" name="members-list[]" required title="Select members">
                                                                          <?php
                                                                            while($user = $users_request_response ->fetch_assoc()){
                                                                                if(!in_array($user['USER_ID'], $old_members_ids)){
                                                                                    echo "<option value='{$user['USER_ID']}' data-tokens='{$user['USER_NAME']}'>{$user['USER_NAME']}</option>";
                                                                                }
                                                                            }?>                                                   </select>
                                                                    </div>

                                                                 
                                                               </div>
                                                           </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                            <button type="submit" name="add-ext-members" class="btn btn-primary">Add</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                  </div>
                                            </div>
                                                    <div class="modal fade bd-example-modal-xl" id="ext_members<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myExtraLargeModalLabel"><strong><?php echo $group['GRP_NAME']?></strong> Members</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                           <section >
                                                                <div class="table-responsive mb-4 mt-4">
                                                                    <table id="external_members" class="table " style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>User Name</th>
                                                                                <th>Affiliation</th>
                                                                                <th>Email</th>
                                                                                <th>Phone</th>
                                                                                <th class="text-center">Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php 
                                                                                $group_memebers = NCG_FUNCT::GET_GROUP_MEMBERS($group['REC_ID'], $group['DOMAIN']);
                                                                                while($member = $group_memebers ->fetch_assoc()){
                                                                                    $member_data = NCG_FUNCT::GET_EXTERNAL_USER_INFO($member['USER_ID']);
                                                                                    $affiliation = NCG_FUNCT::GET_AFFILIATION($member['USER_ID']);
                                                                                    while($info = $member_data ->fetch_assoc()){?>
                                                                            <tr>
                                                                                <td><?php echo $info['USER_NAME']?></td>
                                                                                <td><?php echo $affiliation ?></td>
                                                                                <td><?php echo $info['USER_EMAIL']?></td>
                                                                                <td><?php echo $info['USER_PHONE']?></td>
                                                                                <td class="text-center">
                                                                                    <div class="btn-group mb-4 mr-2" style="width: 100%" role="group">
                                                                                        <button id="action<?php echo $member['USER_ID'].$group['REC_ID']?>" type="button" class="btn btn-primary dropdown-toggle pull-left" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down pull-right"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                                                                          <div class="dropdown-menu" style="width: 100%;" tabindex="-1" role="dialog" aria-labelledby="action<?php echo $member['USER_ID'].$group['REC_ID']?>">
                                                                                            <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#promote<?php echo $member['USER_ID'].$group['REC_ID']?>">Promote</a>
                                                                                            <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#demote<?php echo $member['USER_ID'].$group['REC_ID']?>">Demote</a>
                                                                                            <hr/>
                                                                                            <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#remove<?php echo $member['USER_ID'].$group['REC_ID']?>">Remove</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal fade modal-notification" id="remove<?php echo $member['USER_ID'].$group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                                                      <div class="modal-dialog" role="document" id="standardModalLabel">
                                                                                        <div class="modal-content">
                                                                                          <div class="modal-body text-center">
                                                                                              <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                                                <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                                              </div></center>
                                                                                              <br>
                                                                                              <hr/>
                                                                                              <h4>You are about to remove</h4>
                                                                                              <strong><p class="modal-text"><?php echo $info['USER_NAME']?></p></strong>
                                                                                              <h5>From the group</h5> <br><hr/>
                                                                                              <h4><strong><?php echo $group['GRP_NAME']?></strong> </h4>
                                                                                           </div>
                                                                                          <div class="modal-footer justify-content-between">
                                                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                                                              <?php
                                                                                                $dom = "action=remove-ext&uid=".$member['USER_ID']."&gid=".$group['REC_ID']."&current=".$group['FACILITATOR'];
                                                                                                $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                                                ?>
                                                                                            <a class="btn btn-danger" href="ncg_sec_groups?xyz=<?=$dirty_data?>">Remove</a>
                                                                                          </div>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                    <div class="modal fade modal-notification" id="demote<?php echo $member['USER_ID'].$group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                                                      <div class="modal-dialog" role="document" id="standardModalLabel">
                                                                                        <div class="modal-content">
                                                                                          <div class="modal-body text-center">
                                                                                              <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                                                <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                                              </div></center>
                                                                                              <br>
                                                                                              <hr/>
                                                                                              <h4>You are about to demote</h4>
                                                                                              <strong><p class="modal-text"><?php echo $info['USER_NAME']?></p></strong>
                                                                                              <h5>From facilitating</h5> <br><hr/>
                                                                                              <h4><strong><?php echo $group['GRP_NAME']?></strong> </h4>
                                                                                           </div>
                                                                                          <div class="modal-footer justify-content-between">
                                                                                            <button class="btn" data-dismiss="modal" data-target="#demote<?php echo $member['USER_ID'].$group['REC_ID']?>"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                                                              <?php
                                                                                                $dom = "action=demote-ext&uid=".$member['USER_ID']."&gid=".$group['REC_ID']."&current=".$group['FACILITATOR'];
                                                                                                $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                                                ?>
                                                                                            <a class="btn btn-warning" href="ncg_sec_groups?xyz=<?=$dirty_data?>">Demote</a>
                                                                                          </div>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                    <div class="modal fade modal-notification" id="promote<?php echo $member['USER_ID'].$group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                                                      <div class="modal-dialog" role="document" id="standardModalLabel">
                                                                                        <div class="modal-content">
                                                                                          <div class="modal-body text-center">
                                                                                              <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                                                <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                                              </div></center>
                                                                                              <br>
                                                                                              <hr/>
                                                                                              <h4>You are about to promote</h4>
                                                                                              <strong><p class="modal-text"><?php echo $info['USER_NAME']?></p></strong>
                                                                                              <h5>To facilitate</h5> <br><hr/>
                                                                                              <h4><strong><?php echo $group['GRP_NAME']?></strong> </h4>
                                                                                           </div>
                                                                                          <div class="modal-footer justify-content-between">
                                                                                            <button class="btn" data-dismiss="modal" data-target="#promote<?php echo $member['USER_ID'].$group['REC_ID']?>"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                                                              <?php
                                                                                              $dom = "action=promote-ext&uid=".$member['USER_ID']."&gid=".$group['REC_ID']."&current=".$group['FACILITATOR'];
                                                                                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                                              ?>
                                                                                            <a class="btn btn-primary" href="ncg_sec_groups?xyz=<?=$dirty_data?>">Promote</a>
                                                                                          </div>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <?php 
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th>User Name</th>
                                                                                <th>Affiliation</th>
                                                                                <th>Email</th>
                                                                                <th>Phone</th>
                                                                                <th class="text-center">Action</th>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                            <button data-toggle="modal" data-target="#clear-members<?php echo $group['REC_ID']?>" class="btn btn-primary">Clear Members</button>
                                                        </div>
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="modal fade modal-notification" id="ext_clear-members<?php echo $group['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="standardModalLabel">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Clear Group Members</h4> 
                                                                  <strong><p class="modal-text"><?php echo $group['GRP_NAME']?></p></strong> <br><br><hr/>

                                                                  <span class="badge badge-danger" style="cursor: default;"> This action can not be undone! </span>
                                                                  <br>
                                                                  <strong>
                                                                    <p class="modal-text">Continue at your discretion</p></strong>
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                  <?php
                                                                    $dom = "action=reset-group-ext&gid=".$group['REC_ID']."&name=".$group['GRP_NAME'];
                                                                    $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                                    ?>
                                                                <a class="btn btn-danger" href="ncg_sec_groups?xyz=<?=$dirty_data?>" class="dropdown-item">Clear</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                             </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Group Name</th>
                                            <th>Members</th>
                                            <th>Permissions</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>
                        
                      </div>
                      <!--External Groups tab panel-->
                      <!--Group Settings tab panel-->
                      <div class="modal fade" id="new-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog Vertically centered" role="document">
                            <form method="post" action="ncg_sec_groups">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">New Security Group</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="col-sm-12">
                                <div class="input-group mb-4">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">Group Name</span>
                                  </div>
                                  <input type="text" class="form-control" name="name" required >
                                </div>
                          </div>
                          <div class="row" style="padding-left: 14px;">
                            <div class="col-sm-12">
                                <h4>Permissions</h4>
                            </div>

                            <div class="row col-md-12">
                            <div class="col-sm-6">
                              <div class="n-chk">
                                  <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                    <input type="checkbox" class="new-control-input" name="permissions[]" value="C">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">CREATE</span>
                                  </label>
                              </div>
                            </div>
                              <div class="col-sm-6">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-primary">
                                      <input type="checkbox" class="new-control-input" checked="true" name="permissions[]" value="R">
                                      <span class="new-control-indicator"></span><span class="new-chk-content">READ</span>
                                    </label>
                                </div>
                              </div>
                            </div>
                              <div class="row col-md-12">
                              <div class="col-sm-6">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-dark">
                                      <input type="checkbox" class="new-control-input" name="permissions[]" value="U">
                                      <span class="new-control-indicator"></span><span class="new-chk-content">UPDATE</span>
                                    </label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-danger">
                                      <input type="checkbox" class="new-control-input" name="permissions[]" value="D">
                                      <span class="new-control-indicator"></span><span class="new-chk-content">DELETE</span>
                                    </label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-danger">
                                      <input type="checkbox" class="new-control-input" name="permissions[]" value="S">
                                      <span class="new-control-indicator"></span><span class="new-chk-content">SPECIAL</span>
                                    </label>
                                </div>
                              </div>
                              </div>
                              <div class="row col-md-12">
                                <div class="col-sm-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Domain</span>
                                    </div>
                                    <select class="form-control" name="domain" required>
                                        <option value="">Select</option>
                                        <option value="External">External</option>
                                        <option value="Internal">Internal</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row col-md-12">
                                <div class="col-sm-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Status</span>
                                    </div>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                          </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                      <button type="submit" name="new-group" class="btn btn-primary">Save</button>
                                  </div>
                              </div>
                            </form>
                          </div>
                      </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
                    include 'includes/footer.php';?>
           </div>
       </div>
        <script type="text/javascript">
      function int_members(id){
        var members = document.getElementById("internal-members");
        var groups = document.getElementById("internal-groups");
        if(id == "members"){
          members.style.display = "block";
          groups.style.display = "none";
        }
        if(id == "groups"){
          members.style.display = "none";
          groups.style.display = "block";
        }

      }
      function ext_members(id){
        var members = document.getElementById("external-members");
        var groups = document.getElementById("external-groups");
        if(id == "members"){
          members.style.display = "block";
          groups.style.display = "none";
        }
        if(id == "groups"){
          members.style.display = "none";
          groups.style.display = "block";
        }

      }
    </script>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
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
    <script src="plugins/highlight/highlight.pack.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="plugins/bootstrap-maxlength/custom-bs-maxlength.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#internal_group').DataTable( {
                "pagingType": "full_numbers",
                "oLanguage": {
                    "oPaginate": { 
                        "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                        "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });
        } );
    </script>
    <script>
        $(document).ready(function() {
            $('#internal_members').DataTable( {
                "pagingType": "full_numbers",
                "oLanguage": {
                    "oPaginate": { 
                        "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                        "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [3, 7 , 10, 20, 50],
                "pageLength": 3 
            });
        } );
    </script>
    <script>
        $(document).ready(function() {
            $('#external_group').DataTable( {
                "pagingType": "full_numbers",
                "oLanguage": {
                    "oPaginate": { 
                        "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                        "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });
        } );
    </script>
    <script>
        $(document).ready(function() {
            $('#external_members').DataTable( {
                "pagingType": "full_numbers",
                "oLanguage": {
                    "oPaginate": { 
                        "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                        "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });
        } );
    </script>
    <script>
        $(document).ready(function() {
            $('#settings_pagination').DataTable( {
                "pagingType": "full_numbers",
                "oLanguage": {
                    "oPaginate": { 
                        "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                        "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });
        } );
    </script>
    
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/flatpickr/flatpickr.js"></script>
    <script src="plugins/noUiSlider/nouislider.min.js"></script>

    <script src="plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
</body>
</html>