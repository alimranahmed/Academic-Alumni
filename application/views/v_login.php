<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DIU Alumni</title>

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
<body class="full-container">
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img class="img-circle logo pull-left" src="<?=base_url()?>public/images/diu.jpg">DIU Alumni</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav><!------Navbar------->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>This is our network!</h2>
        </div>
    </div><!---moto---->
    <!----login and registration row---->
    <div class="row">
        <div class='col-md-4'>
        </div>
        <div class='col-md-4' style="background: white;">
            <?php if(isset($registerSuccess)):?>
                <div class="text-success"><?php echo $registerSuccess;?></div>
            <?php endif ?>
            <!---Tab panel---->
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" <?php if(!isset($validationErrors)) { echo 'class="active"';};?>><a href="#login" aria-controls="home" role="tab" data-toggle="tab">Login</a></li>
                    <li role="presentation" <?php if(isset($validationErrors)) { echo 'class="active"';};?>><a href="#registration" aria-controls="profile" role="tab" data-toggle="tab">Registration</a></li>
                </ul><!---end of nav tabs---->
                <!-- Tab panes -->
                <div class="tab-content">
                    <!----Login form---->
                    <div role="tabpanel" class="tab-pane <?php if(!isset($validationErrors)) { echo 'active';}?>" id="login">
                        <form role="form" action="<?php echo base_url()?>welcome/login" method="post">
                            <?php
                            if(isset($loginErrors))
                            {?>
                                <div class="text-danger form-group">
                                    <?php echo $loginErrors;?>
                                </div>
                            <?php
                            }?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" pattern="[a-z0-9._%+-]+@diu.edu.bd$" class="form-control" placeholder="e.g. yourmail@diu.edu.bd">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-success" style="margin-bottom: 10px;">Login</button>
                        </form>
                    </div><!----End of login form---->
                    <!----Registration form------>
                    <div role="tabpanel" class="tab-pane <?php if(isset($validationErrors)) { echo 'active';}?>" id="registration">
                        <?php if(isset($validationErrors)): ?>
                            <div class="text-danger"><?php echo $validationErrors;?></div>
                        <?php endif ?>
                        <form role="form" method="post" action="<?php echo base_url()?>signup">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter you first name">
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-offset-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter your last name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">DIU Email address</label>
                                <input type="email" pattern="[a-z0-9._%+-]+@diu.edu.bd$" name="email" class="form-control" id="email" placeholder="yourmail@diu.edu.bd">
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <label>DIU Id.</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="batch_id" class="form-control" id="batch_id" placeholder="e.g. 111">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="department_id" class="form-control" id="department_id" >
                                            <?php foreach($departments as $department):?>
                                                <option value="<?php echo $department->id?>"><?php echo $department->id?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="student_id" class="form-control" id="student_id" placeholder="e.g. 1191">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Program</label>
                                <select name="program" class="form-control" id="program" >
                                    <?php foreach($programs as $program):?>
                                        <option value="<?php echo $program->id?>"><?php echo $program->name?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input type="password" name="password_conf" class="form-control" id="password" placeholder="Confirm Password">
                            </div>
                            <input type="submit" class="btn btn-info"  style="margin-bottom: 10px;" value="Register">
                        </form>
                    </div><!--- end of Registration form---->
                </div><!----end of tab panes----->
            </div><!---end of tab panel---->
        </div>
    </div><!---- end of login and registration row--->
    <div class="row">
    </div><!-------Footer--------->
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=base_url()?>public/js/jquery-2.1.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
</body>
</html>