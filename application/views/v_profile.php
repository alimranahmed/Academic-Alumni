<?php $currentUser = $this->session->userdata("user_id");?>

<div class="col-md-8">
    <div class="row">
        <?php if($currentUser!=$user->id):?>
            <?php if(!in_array($user->id, $friendsId)):?>
                <a href="<?php echo site_url("network/sendRequest/".$user->id)?>"><div class="btn btn-success">Add As Friend</div></a>
            <?php else: ?>
                <div class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Friend</div>
            <?php endif ?>
        <?php endif ?>
    </div>
    <div class="row">
        <div class="panel panel-info">
          <div class="panel-heading">
              About Me
              <?php if($user->id == $currentUser):?>
                <span style="cursor: pointer" id="about-edit-button" class=" pull-right glyphicon glyphicon-edit"></span>
              <?php endif ?>
          </div>
          <div class="panel-body">
            <p id='about-normal'><?php echo $user->about?></p>
              <form id='about-edit' class="form-horizontal" role="form" action="<?php echo base_url()?>profile/updateAbout" method="post">
                  <textarea name="about" class="form-control" rows="3"><?php echo strip_tags($user->about);?></textarea>
                  <div class="form-group">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </div>
              </form>
          </div>
        </div><!---About me---->
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">
                Professional Skills
                <?php if($user->id == $currentUser):?>
                <span style="cursor: pointer" id="professional-edit-button" class=" pull-right glyphicon glyphicon-edit"></span>
                <?php endif ?>
            </h3>
          </div>
          <div class="panel-body">
            <p id="professional-normal"><?php echo $user->skills?></p>
              <form id='professional-edit' class="form-horizontal" role="form" action="<?php echo base_url()?>profile/updateSkills" method="post">
                  <textarea class="form-control" name="skills" rows="3"><?php echo strip_tags($user->skills)?></textarea>
                  <div class="form-group">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </div>
              </form>
          </div>
        </div><!---Professional Skills---->
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">
                Educational Qualification
            </h3>
          </div>
          <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <th>Exam Title</th>
                    <th>Group/Department</th>
                    <th>Institute</th>
                    <th>CGPA</th>
                    <th>Pass Year</th>
                </thead>
                <tbody>
                    <?php foreach($educations as $education):?>
                    <tr>
                        <td><?php echo $education->exam?></td>
                        <td><?php echo $education->department?></td>
                        <td><?php echo $education->institute?></td>
                        <td><?php echo $education->cgpa?></td>
                        <td><?php echo $education->passingYear?></td>
                        <td>
                            <?php if($user->id == $currentUser):?>
                            <span style="cursor: pointer" data-toggle="modal" data-target="#modal<?php echo $education->id?>" class="pull-right glyphicon glyphicon-edit"></span>
                            <?php endif ?>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="modal<?php echo $education->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                    </div>
                                    <form method="post" action="<?php echo base_url()?>profile/updateEducation/<?php echo $education->id?>">
                                    <div class="modal-body">
                                        <strong>Exam: </strong><input name="exam" type="text" class="form-control" value="<?php echo $education->exam?>">
                                        <strong>Group/Department: </strong><input name="department" type="text" class="form-control" value="<?php echo $education->department?>">
                                        <strong>Institute: </strong><input name="institute" type="text" class="form-control" value="<?php echo $education->institute?>">
                                        <strong>CGPA: </strong><input name="cgpa" type="text" class="form-control" value="<?php echo $education->cgpa?>">
                                        <strong>Passing Year: </strong><input name="year" type='text' class="form-control" value="<?php echo $education->passingYear?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                    <?php endforeach?>
                    <?php if($user->id == $currentUser):?>
                    <form method="post" action="<?php echo base_url()?>profile/insertEducation">
                        <tr>
                            <td><input name="exam" type="text" class="form-control" placeholder="e.g. B. Sc."></td>
                            <td><input name="department" type="text" class="form-control" placeholder="e.g. Computer Science"></td>
                            <td><input name="institute" type="text" class="form-control" placeholder="e.g. Daffodil International University"></td>
                            <td><input name="cgpa" type="text" class="form-control" placeholder="e.g. 3.50"></td>
                            <td><input name="year" type='text' class="form-control" placeholder="e.g. 2015"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" class="form-control btn btn-info" value="Add"></td>
                        </tr>
                    </form>
                    <?php endif ?>
                </tbody>
            </table>
          </div>
        </div><!---Educational Summery---->
        <!----Project start---->
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">
                Projects
                <?php if($user->id == $currentUser):?>
                    <span style="cursor: pointer" id="project-edit-button" class=" pull-right glyphicon glyphicon-plus"></span>
                <?php endif ?>
            </h3>
          </div>
          <div class="panel-body">
            <div id="project-normal">
                <?php
                foreach($projects as $project)
                {?>
                    <div>
                        <?php if($user->id == $currentUser):?>
                        <span style="cursor: pointer" id="project-edit-button" class=" pull-right glyphicon glyphicon-edit" data-toggle="modal" data-target="#editModal<?php echo $project->id?>"></span>
                        <a href="<?php echo site_url('profile/deleteProject').'/'.$project->id?>" onclick="confirm('Are you sure to delete this project?')"><span style="cursor: pointer; padding-right:10px; color: red;" id="project-edit-button" class=" pull-right glyphicon glyphicon-trash"></span></a>
                        <?php endif ?>
                    <h3><strong>Title: </strong><?php echo $project->title;?></h3>
                        <p><strong>Description: </strong><?php echo $project->description;?></p>
                        <p><strong>Group Members: </strong><?php echo $project->groupMember;?></p>
                        <strong>Link: </strong><a href="<?= $project->link;?>" target="_blank"><?php echo $project->link;?></a>
                        <hr>
                    </div>
                    <!-- Modal to edit project-->
                    <div class="modal fade" id="editModal<?php echo $project->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit Project</h4>
                                </div>
                                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>profile/updateProject/<?php echo $project->id?>">
                                    <div class="modal-body">
                                        <div>
                                            <label>Title</label>
                                            <input required="required" name="title" value="<?php echo $project->title;?>" class="form-control">
                                        </div>
                                        <div>
                                            <label>Description</label>
                                            <textarea required="required" name="description" class="form-control" rows="3"><?php echo $project->description;?></textarea>
                                        </div>
                                        <div>
                                            <label>Link</label>
                                            <input name="link" type="url" value="<?php echo $project->link;?>" class="form-control">
                                        </div>
                                        <div>
                                            <label>Group Members</label>
                                            <input name="members" value="<?php echo $project->groupMember;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!---End of edit project---->
                    <?php
                }
                ?>
            </div>
              <!---Insert project form---->
              <form id='project-edit' class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>profile/insertProject">
                  <div>
                      <label>Title</label>
                      <input required="required" name="title" class="form-control">
                  </div>
                  <div>
                      <label>Description</label>
                      <textarea required="required" name="description" class="form-control" rows="3"></textarea>
                  </div>
                  <div>
                      <label>Link</label>
                      <input name="link" type="url" class="form-control">
                  </div>
                  <div>
                      <label>Group Members</label>
                      <input name="members" class="form-control">
                  </div>
                  <div class="form-group">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-info">Add</button>
                    </div>
                  </div>
              </form><!---end of insert project form--->
          </div>
        </div><!---Projects end---->
        <!----Career summery start----->
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">
                Career Summery
                <?php if($user->id == $currentUser):?>
                <span style="cursor: pointer" id="career-edit-button" class=" pull-right glyphicon glyphicon-plus"></span>
                <?php endif ?>
            </h3>
          </div>
            <div class="panel-body">
                <div id="career-normal">
                    <?php
                    foreach($careers as $career)
                    {?>
                        <div>
                            <?php if($user->id == $currentUser):?>
                            <span style="cursor: pointer" id="project-edit-button" class=" pull-right glyphicon glyphicon-edit" data-toggle="modal" data-target="#editCareerModal<?php echo $career->id?>"></span>
                            <a href="<?php echo site_url('profile/deleteCareer').'/'.$career->id?>" onclick="confirm('Are you sure to delete this experience?')"><span style="cursor: pointer; padding-right:10px; color: red;" id="career-edit-button" class=" pull-right glyphicon glyphicon-trash"></span></a>
                            <?php endif ?>
                        <h3><strong>Company Name: </strong><?php echo $career->companyName;?></h3>
                            <p><strong>Designation: </strong><?php echo $career->designation;?></p>
                            <p><strong>Responsibilities: </strong><?php echo $career->description;?></p>
                            <p><strong>Duration: </strong><?php echo $career->duration;?>
                                <?php if($career->duration > 1) echo "Years"; else echo "Year";?>
                            </p>
                            <p><strong>Status: </strong><?php echo $career->status;?></p>
                            <hr>
                        </div>
                        <!-- Modal to edit Career-->
                        <div class="modal fade" id="editCareerModal<?php echo $career->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Project</h4>
                                    </div>
                                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>profile/updateCareer/<?php echo $career->id?>">
                                        <div class="modal-body">
                                            <div>
                                                <label>Company Name</label>
                                                <input required="required" name="companyName" value="<?php echo $career->companyName?>" class="form-control">
                                            </div>
                                            <div>
                                                <label>Designation</label>
                                                <input name="designation" value="<?php echo $career->designation?>" class="form-control">
                                            </div>
                                            <div>
                                                <label>Responsibilities</label>
                                                <textarea required="required" name="responsibilities" class="form-control" rows="3"><?php echo $career->description?></textarea>
                                            </div>
                                            <div>
                                                <label>Duration</label>
                                                <input name="duration" type="txt" value="<?php echo $career->duration?>" class="form-control" placeholder="year">
                                            </div>
                                            <div>
                                                <label>Status</label>
                                                <select name="status" type="txt" class="form-control">
                                                    <option <?php if($career->status == "Continue") echo 'selected'?>>Continue</option>
                                                    <option <?php if($career->status == "Past") echo 'selected'?>>Past</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!---End of edit Career---->
                    <?php
                    }
                    ?>
                </div>
                <!---Insert Career form---->
                <form id='career-edit' class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>profile/insertCareer">
                    <div>
                        <label>Company Name</label>
                        <input required="required" name="companyName" class="form-control">
                    </div>
                    <div>
                        <label>Designation</label>
                        <input name="designation" class="form-control">
                    </div>
                    <div>
                        <label>Responsibilities</label>
                        <textarea required="required" name="responsibilities" class="form-control" rows="3"></textarea>
                    </div>
                    <div>
                        <label>Duration</label>
                        <input name="duration" type="txt" class="form-control" placeholder="year">
                    </div>
                    <div>
                        <label>Status</label>
                        <select name="status" type="txt" class="form-control">
                            <option>Continue</option>
                            <option>Past</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-info">Add</button>
                        </div>
                    </div>
                </form><!---end of insert Career form--->
            </div>
        </div><!---Career Summery---->
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">
                Personal Information
                <?php if($user->id == $currentUser):?>
                <span style="cursor: pointer" id="info-edit-button" class=" pull-right glyphicon glyphicon-edit"></span>
                <?php endif ?>
            </h3>
          </div>
          <div class="panel-body">
            <table class="table table-hover" id="info-normal">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $user->firstName." ".$user->lastName?></td>
                    </tr>
                    <tr>
                        <th>University ID.</th>
                        <td><?php echo $user->batch_id.'-'.$user->department_id.'-'.$user->student_id ?></td>
                    </tr>
                    <tr>
                        <th>Father's Name</th>
                        <td><?php echo $user->fatherName ?></td>
                    </tr>
                    <tr>
                        <th>Mother's Name</th>
                        <td><?php echo $user->motherName ?></td>
                    </tr>
                    <tr>
                        <th>Email.</th>
                        <td><?php echo $user->email?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo $user->phone ?></td>
                    </tr>
                    <tr>
                        <th>Program</th>
                        <td><?php echo $user->program .' in '.$user->department?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?php echo $user->gender ?></td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td><?php echo date("d- M, Y",strtotime($user->birthday)) ?></td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td><?php echo $user->country ?></td>
                    </tr>
                    <tr>
                        <th>Religion</th>
                        <td><?php echo $user->religion ?></td>
                    </tr>
                    <tr>
                        <th>Marital Status</th>
                        <td><?php echo $user->maritalStatus ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo $user->address ?></td>
                    </tr>
                </tbody>
            </table>
              <table class="table table-hover" id="info-edit" style="display: none">
                  <form method="post" action="<?php echo base_url()?>profile/updateInfo">
                      <tbody>
                          <tr>
                              <th>Name</th>
                              <td>
                                  <div class="col-md-5" style="padding-left: 0px;"><input name="firstName" class="form-control" type="text" value="<?php echo $user->firstName ?>"></div>
                                  <div class="col-md-6" style="padding-right: 0px;"><input name="lastName" class="form-control" type="text" value="<?php echo $user->lastName ?>"></div>
                              </td>
                          </tr>
                          <tr>
                              <th>University ID.</th>
                              <td><input name="universityId" class="form-control" type="text" disabled value="<?php echo $user->batch_id.'-'.$user->department_id.'-'.$user->student_id?>"></td>
                          </tr>
                          <tr>
                              <th>Father's Name</th>
                              <td><input name="fatherName" class="form-control" type="text" placeholder="Father's Name" value="<?php echo $user->fatherName ?>"></td>
                          </tr>
                          <tr>
                              <th>Mother's Name</th>
                              <td><input name="motherName" class="form-control" type="text" placeholder="Mother's Name" value="<?php echo $user->motherName ?>"></td>
                          </tr>
                          <tr>
                              <th>Email</th>
                              <td><input type="email" name="email" class="form-control" placeholder="your email" value="<?php echo $user->email ?>"></td>
                          </tr>
                          <tr>
                              <th>Phone</th>
                              <td><input type="text" name="phone" class="form-control" placeholder="e.g. +8801xxxxxxxxx" value="<?php echo $user->phone ?>"></td>
                          </tr>
                          <tr>
                              <th>Program</th>
                              <td><input name="program" class="form-control" type="text" disabled value="<?php echo $user->program.' in '.$user->department ?>"></td>
                          </tr>
                          <tr>
                              <th>Gender</th>
                              <td>
                                  <select name="gender">
                                      <option <?php if($user->gender == 'Male'){echo "selected";}?> >Male</option>
                                      <option <?php if($user->gender == 'Female'){echo "selected";}?>>Female</option>
                                  </select>
                              </td>
                          </tr>
                          <tr>
                              <th>Date of Birth</th>
                              <td><input class="form-control" type="text" name="dob" value="<?php echo date("m/d/Y",strtotime($user->birthday)) ?>" placeholder="mm/dd/yyyy" ></td>
                          </tr>
                          <tr>
                              <?php $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"); ?>

                              <th>Country</th>
                              <td>
                                  <select type="text" name="country" class="form-control">
                                    <?php foreach($countries as $country):?>
                                      <option <?php if($country == $user->country){echo 'selected';}?>><?php echo $country?></option>
                                    <?php endforeach ?>
                              </td>
                          </tr>
                          <tr>
                              <th>Religion</th>
                              <td>
                                  <select name="religion">
                                      <option <?php if($user->religion == 'Islam'){echo "selected";}?> >Islam</option>
                                      <option <?php if($user->religion == 'Hinduism'){echo "selected";}?>>Hinduism</option>
                                      <option <?php if($user->religion == 'Christianity'){echo "selected";}?>>Christianity</option>
                                      <option <?php if($user->religion == 'Buddhism'){echo "selected";}?>>Buddhism</option>
                                      <option <?php if($user->religion == 'Other'){echo "selected";}?>>Other</option>
                                  </select>
                              </td>
                          </tr>
                          <tr>
                              <th>Marital Status</th>
                              <td>
                                  <select name="maritalStatus">
                                      <option <?php if($user->maritalStatus == 'Married'){echo "selected";}?>>Married</option>
                                      <option <?php if($user->maritalStatus == 'Unmarried'){echo "selected";}?>>Unmarried</option>
                                  </select>
                              </td>
                          </tr>
                          <tr>
                              <th>Address</th>
                              <td><input type="text" name="address" class="form-control" placeholder="Your Address" value="<?php echo $user->address ?>"></td>
                          </tr>
                        <tr>
                            <th><input type="submit" class="btn btn-success" value="Update"></th>
                        </tr>
                      </tbody>
                  </form>
              </table>
          </div>
        </div><!---Personal Information---->
    </div>
</div><!----Profile content--->
<div col-md-2>
</div><!---Empty right side--->
</div>
</div>
