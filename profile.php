<?php include("includes/header.php"); ?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include("includes/preload.php"); ?>



  <!-- Navbar -->
<?php include("includes/navigation.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include("includes/side_nav.php"); ?>


     <?php
             if(isset($_SESSION['admin_mail'])){

        $query = "SELECT  * FROM admin_users WHERE email  = '".$_SESSION['admin_mail']."'" ;
        $results = mysqli_query($connections,$query);
        $row = mysqli_fetch_assoc($results);
        $full_name = $row['full_name'];
        $email = $row['email'];

$message = "";
$msg="";
if(request_is_post() && request_is_same_domain()) {
if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
    $message = "Sorry, request was not valid.";
  }
  else {
$password = sql_prep($_POST['password']);
$confirm_password = sql_prep($_POST['confirm_password']);
$password = dirty_html($password);
$confirm_password = dirty_html($confirm_password);
$password = h($password);
$confirm_password = h($confirm_password);


if(empty($password)){
 $message = "Password field cannot be empty";
}
if(empty($confirm_password)){
 $message = "Confirm Password field cannot be empty";
}
elseif(!has_length($password, ['min' => 8])) {

  $message= "Password must be at least 8 characters long.";
}
elseif(!has_format_matching($password, '/[^A-Za-z0-9]/')) {
$message =" Password must contain at least one special character.
";
} 
elseif($password!=$confirm_password){
$message= " Your password does not match the confirm password "; 
}

else{
    //successful code

if(!$message){
$final_password = password_hash($password,PASSWORD_BCRYPT, array('cost'=>12));

          $query = "UPDATE admin_users SET password = '{$final_password}' WHERE email = '".$_SESSION['admin_mail']."' ";
          $update_query = mysqli_query($connections,$query);

$msg ="Password successfully updated";

}
}
}
}



            }

                ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="img/icons8-user-80.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">
                     <?php
             if(isset($_SESSION['admin_mail'])){

        $query = "SELECT  full_name FROM admin_users WHERE email  = '".$_SESSION['admin_mail']."'" ;
        $results = mysqli_query($connections,$query);
        $row = mysqli_fetch_assoc($results);
        $full_name = $row['full_name'];
        echo $full_name;


            }

                ?>

                </h3>

                <p class="text-muted text-center">Admin</p>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title text-center"><center>Info</center></h3>
              </div>
              <!-- /.card-header -->
            
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active">Update Password</a></li>
<!--               $2y$12$IDurFzHCgeuQKbWHPNbCzuVGWeLiYJxLsSHfZGlFpLA2xqJsXSvFm   
 -->                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                       <?php

      if($message != "") {

       echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>' ." ".  h($message) . '</div>';

      }

 if($msg != "") {
 
       echo '<p class="bg-success">' ." ".  h($msg) . '</p>';
      }

    ?>
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                   <div class="tab-pane" id="settings">
                    <form class="form-horizontal" method="post">
                    <?php echo csrf_token_tag(); ?>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" disabled value="<?php echo $full_name; ?>" class="form-control" id="inputName" placeholder="Full Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" value="<?php echo $email; ?>" disabled class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                    
                     <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label"> Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control" id="inputSkills" placeholder="Password" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="confirm_password" class="form-control" id="inputSkills" placeholder="Confirm Password" required>
                        </div>
                      </div>
                   
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update Info</button>
                        </div>
                      </div>
                    </form>
                  </div>

           

                  </div>
                  <!-- /.tab-pane -->
           
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php include("includes/footer.php"); ?>
</body>
</html>
