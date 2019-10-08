<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Informasi Akademik
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url();?>assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url();?>assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto mt-5">
            <div class="card">
              <div class="card-header card-header-primary">
                <h2 class="card-title text-center">Login</h2>
              </div>
              <div class="card-body">
                <?php if ($this->session->flashdata('result_login')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('result_login'); ?>
                  </div>
                <?php endif; ?>
                <form action="<?php echo base_url('login/proses');?>" method="POST">
                  <div class="row">
                    <div class="col-md-10 ml-auto mr-auto mt-3">
                      <div class="form-group">
                        <label class="bmd-label-floating">Username</label>
                        <input type="text" class="form-control" name="username" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10 ml-auto mr-auto mt-3">
                      <div class="form-group">
                        <label class="bmd-label-floating">Password</label>
                        <input type="password" class="form-control" name="password" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10 ml-auto mr-auto mt-3 mb-3">
                      <button type="submit" class="btn btn-primary btn-round btn-block">Login</button>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
