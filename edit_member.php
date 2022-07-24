<?php include("includes/header.php"); ?>


<?php

$message = "";
$msg="";


if(isset($_GET['mid']))
{
$them_id = sql_prep($_GET['mid']); 
}

$query = "SELECT * FROM members WHERE id = $them_id";
$select_member_by_id = mysqli_query($connections,$query);

while ($row = mysqli_fetch_assoc($select_member_by_id))
{
$id=$row['id'];
$first_name = $row['first_name'];
$surname= $row['last_name'];
$tel_no = $row['tel_no'];
$address = $row['address'];
  $pic = $row['pic'];
}


if(request_is_post() && request_is_same_domain()) {
if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
    $message = "Sorry, request was not valid.";
  }
  else {
$first_name = sql_prep($_POST['first_name']);
$surname = sql_prep($_POST['surname']);
$tel = sql_prep($_POST['tel']);
$addresss = sql_prep($_POST['address']);
$date = date("F j, Y, g:i a");
$first_name = dirty_html($first_name);
$surname = dirty_html($surname);
$tel = dirty_html($tel);
$addresss = dirty_html($addresss);
$first_name = h($first_name);
$surname = h($surname);
$tel = h($tel);
$addresss = h($addresss);

$pic = $_FILES['pic']['name'];
$pic_tmp = $_FILES['pic']['tmp_name'];
$saveddate = date("mdy-Hms");
$newfilename = $saveddate."_".$pic;
move_uploaded_file($pic_tmp, "pics/$newfilename");

if(empty($pic)){
        $query = "SELECT * FROM members WHERE id = $them_id";
        $select_member_image = mysqli_query($connections,$query);
        while($row = mysqli_fetch_array($select_member_image)){
          $newfilename =$row['pic'];
        }
        }


if(empty($first_name)){
 $message = "First cannot be empty";
}
if(empty($surname)){
 $message = "Surname cannot be empty";
}

if(empty($addresss)){
 $message = "Address cannot be empty";
}

if(empty($tel)){
 $message = "Phone Number cannot be empty";
}


else{
    // registration successful code

if(!$message){

$query = "UPDATE members SET ";
        $query .="first_name = '{$first_name}', ";
        $query .="last_name = '{$surname}', ";
        $query .="tel_no = '{$tel}', ";
        $query .="address = '{$addresss}', ";
        $query .="pic = '{$newfilename}' ";
        $query .="WHERE id ={$them_id} ";

        $update_member = mysqli_query($connections,$query);
          //ConfirmQuery($update_course);

redirect('edit_member.php?mid='.$them_id);

          $msg = "Member Updated";



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
            <h1>Edit Member </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Member</li>
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
                <h3 class="card-title">Update member</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               
              <form id="quickForm" method="POST"   accept-charset="utf-8" enctype="multipart/form-data">
                                    <?php echo csrf_token_tag(); ?>

                <div class="card-body">
                  <div class="form-group">   
                   <?php

      if($message != "") {

       echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>' ." ".  h($message) . '</div>';

      }

 if($msg != "") {
 
       echo '<p class="bg-success">' ." ".  h($msg) . '</p>';
      }

    ?>
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name"  value="<?php echo $first_name;?>" required >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Surname</label>
                    <input type="text" name="surname" class="form-control" id="exampleInputPassword1" placeholder="Enter Surname" value="<?php echo $surname; ?>" required >
                  </div>

<div class="form-group">
                    <label for="exampleInputPassword1">Telephone Number</label>
                    <input type="number" name="tel" class="form-control" id="exampleInputPassword1" placeholder="Enter Telephone Number" value="<?php echo $tel_no; ?>" required>
                  </div>


                 <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Address</label>
                        <textarea  class="form-control" name="address" rows="3" placeholder="Enter Address"><?php echo $address; ?></textarea  required>
                      </div>
                    </div>
         <div class="form-group">
                    <label for="exampleInputPassword1">Picture (optional) </label>
                    <?php
      $ext = pathinfo($pic,PATHINFO_EXTENSION);
if($ext==='png' or $ext==='jpg' or $ext==='jpeg'){?>

<img  width='50' src='pics/<?php echo $pic; ?>'>
<?php
}else{?>
    <img  width="50" src="img/icons8-user-male-120.png">
 <?php
}
?>

                    <input type="file" name="pic" class="form-control" id="exampleInputPassword1" >
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Member</button>
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
