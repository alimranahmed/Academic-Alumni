<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wall</title>
    <!-- Bootstrap -->
    <link href="<?=base_url()?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/css/myStyle.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid">
    <div class="row wall-cover">
        <div class="col-md-3">
            <?php
            if($user->photo == "") {
                ?>
                <img class="img-circle user-img" src="<?= base_url()?>public/images/users/user.jpg" >
                <?php
            }
            else{?>
                <img class="img-circle user-img" src="<?=base_url().$user->photo?>">
                <?php
            }
            ?>
            <?php if($this->session->userdata("user_id") == $user->id):?>
            <form class="photo-form" method="post" action="<?php echo base_url()?>profile/updatePhoto" enctype="multipart/form-data">
                <script>
                    var up_message = "Photo Selected";
                    var inputArea = "<button class='btn btn-success' type='submit'>Change <i class='glyphicon glyphicon-ok'></button>"
                </script>
                <span id="up_link" style="cursor: pointer" onclick= $("#photo-upload").click() > Upload New Photo <i class="glyphicon glyphicon-picture"></i></span>
                <input id="photo-upload" style="display: none" type="file" name="photo" onchange="$('#up_link').html(up_message); $('.photo-form').append(inputArea);">
            </form>
            <?php endif ?>
        </div>
        <div class="col-md-5">
            <h2><?php echo $user->firstName." ".$user->lastName;?></h2>
            <h3><?php echo $user->program.' in '.$user->department?></h3>
        </div>
    </div><!---Wall Cover-->
    <div class="row">
        <div class="col-md-2">
            <div class="side-navbar">
                    <form method="get" action="<?php echo site_url("search");?>">
                        <input type="text" required="required" class="form-control" name="search" placeholder="Whom to search?">
                        <input type="submit" class="form-control btn btn-success" value="Search">
                    </form>
                <a class="btn form-control btn-info <?php if($active_link == 'home'){echo 'active';}?>" href="<?php echo base_url()?>home" >Home</a>
                <a class="btn form-control btn-info <?php if($active_link == 'timeline'){echo 'active';}?>" href="<?php echo base_url()?>timeline" >Timeline</a>
                <a class="btn form-control btn-info <?php if($active_link == 'profile'){echo 'active';}?>" href="<?php echo base_url()?>profile/show/<?php echo $this->session->userdata("user_id");?>">Profile</a>
                <a class="btn form-control btn-info <?php if($active_link == 'network'){echo 'active';}?>" href="<?php echo base_url()?>network">Network
                    <?php if(isset($requests) && count($requests) > 0):?>
                        <span class="badge" style="color: red;"><?php echo count($requests);?></span>
                    <?php endif ?>
                </a>
                <a class="btn form-control btn-info <?php if($active_link == 'group'){echo 'active';}?>" href="<?php echo base_url()?>group">Groups</a>
                <a class="btn form-control btn-warning" href="<?php echo base_url()?>welcome/logout">Logout</a>
            </div>
        </div><!---Right sidebar---->