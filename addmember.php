<?php include("includes/header.php"); ?>


<?php

$message = "";
$msg="";
if(request_is_post() && request_is_same_domain()) {
if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
    $message = "Sorry, request was not valid.";
  }
  else {
$first_name = sql_prep($_POST['first_name']);
$surname = sql_prep($_POST['surname']);
$tel = sql_prep($_POST['tel']);
$address = sql_prep($_POST['address']);
$date = date("F j, Y, g:i a");
$first_name = dirty_html($first_name);
$surname = dirty_html($surname);
$tel = dirty_html($tel);
$address = dirty_html($address);
$first_name = h($first_name);
$surname = h($surname);
$tel = h($tel);
$address = h($address);

$pic = $_FILES['pic']['name'];
$pic_tmp = $_FILES['pic']['tmp_name'];
$saveddate = date("mdy-Hms");
$newfilename = $saveddate."_".$pic;
move_uploaded_file($pic_tmp, "pics/$newfilename");

if(empty($first_name)){
 $message = "First cannot be empty";
}
if(empty($surname)){
 $message = "Surname cannot be empty";
}

// if(empty($address)){
//  $message = "Address cannot be empty";
// }

if(empty($tel)){
 $message = "Phone Number cannot be empty";
}

if(tel_exit($tel)){
 $message = " Sorry Phone Number  Already Exist";
}

else{
    // registration successful code

if(!$message){
$sql = "INSERT INTO members(first_name,last_name,tel_no,address,pic)";
$sql.="VALUES('$first_name','$surname','$tel','$address','$newfilename')";
$result = mysqli_query($connections,$sql);

$msg="Member Added Successfully";
            header("Location: view_members.php");

}
}
}
}
?>







<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
<?php include("includes/navigation.php"); ?>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include("includes/side_nav.php"); ?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Member </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Member</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Fill in the form to add a member</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               
              <form id="quickForm" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>"  accept-charset="utf-8" enctype="multipart/form-data">
                                    <?php echo csrf_token_tag(); ?>

                <div class="card-body">
                  <div class="form-group">   
                   <?php

      if($message != "") {

       echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>' ." ".  h($message) . '</div>';

      }

if($msg != "") {

       echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><strong>Nice!</strong>' ." ".  h($msg) . '</div>';

      }

    ?>
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name"  value="<?php if (isset($first_name)) { echo $first_name; } ?>" required >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Surname</label>
                    <input type="text" name="surname" class="form-control" id="exampleInputPassword1" placeholder="Enter Surname" value="<?php if (isset($surname)) { echo $surname; } ?>" required >
                  </div>

<div class="form-group">
                    <label for="exampleInputPassword1">Telephone Number</label>
                    <input type="number" name="tel" class="form-control" id="exampleInputPassword1" placeholder="Enter Telephone Number" value="<?php if (isset($tel)) { echo $tel; } ?>" required>
                  </div>


                 <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Address (optional) </label>
                        <textarea class="form-control" name="address" rows="3" placeholder="Enter Address"></textarea value="<?php if (isset($address)) { echo $address; } ?>" >
                      </div>
                    </div>
         <div class="form-group">
                    <label for="exampleInputPassword1">Picture (optional) </label>
                    <input type="file" name="pic" class="form-control" id="exampleInputPassword1" placeholder="Enter Telephone Number">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  </div>



 <?php include("includes/footer.php"); ?>
</body>
</html>
