<?php
include 'config.php';

if(isset($_GET['code'])){
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->SetAccessToken($token['access_token']);

  $_SESSION['access_token'] = $token['access_token'];

  $service = new Google_Service_Oauth2($client);
  $data = $service->userinfo->get();

  if(!empty($data['given_name'])){
    $_SESSION['name'] = $data['given_name'];
  }
}

$link = "";

if(!isset($_SESSION['access_token'])){
  $link = $client->createAuthUrl();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
    </style>
</head>
<body>
<section class="vh-100" style="background-color: rgb(205, 255, 222);">
    <h1 class="card text-center offset-xl-1" style="background-color: rgb(205, 255, 222);">Login Form</h1>
  <div class="container py-5">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <!-- <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
      </div> -->
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form>
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" id="form1Example13" class="form-control form-control-lg" placeholder="Email address">
            <!-- <label class="form-label" for="form1Example13">Email address</label> -->
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="password" id="form1Example23" class="form-control form-control-lg"  placeholder="Password">
            <!-- <label class="form-label" for="form1Example23">Password</label> -->
          </div>

          <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
              <label class="form-check-label" for="form1Example3"> Remember me </label>
            </div>
            <a href="#!">Forgot password?</a>
          </div>

          <!-- Submit button -->
          <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg btn-block">Sign in</button>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
          </div>

          <a data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" style="background-color: rgb(5, 108, 211)" href="#!"
            role="button">
            <i class="fa fa-facebook-f mx-3"></i>Continue with Facebook
          </a>

        <?php if(!empty($link)){ ?>

          <a data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" style="background-color: black" href="<?= $link; ?>"
            role="button">
            <i class="fa fa-google mx-3"></i>Continue with Google</a>

          <?php 
          }else{
            $_SESSION['name'];
          }
           ?>

        </form>
      </div>
    </div>
  </div>
</section>
</body>
</html>