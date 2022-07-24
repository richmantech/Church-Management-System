<?php include("includes/header.php"); ?>


<?php

$message = "";
$msg="";
if(request_is_post() && request_is_same_domain()) {
if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
    $message = "Sorry, request was not valid.";
  }
  else {
// $first_name = sql_prep($_POST['first_name']);


if(!$message){
$position=$_POST['position'];
 //$age=$_POST['age'];
 //$job=$_POST['job'];
 for($i=0;$i<count($position);$i++)
 {
  if($position[$i]!="")
  {
    
    $sql = "INSERT INTO positions(positions)";
$sql.="VALUES('$position[$i]')";
$result = mysqli_query($connections,$sql); 
confirm($result);  
  }
 }
$msg = "Position Created";


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
            <h1>Add Position </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Position</li>
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
                <h3 class="card-title">Fill in the form to add position</h3>
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

 <div class="form-group ">
   <label for="title">Add Position: </label>
<div class="field_wrapper">
      <div>
      <input type="text" name="position[]" value="" style="width: 40%; height: 38px"required="required" />
      <a href="javascript:void(0);" class="add_input_button" title="Add field"><img src="img/add-icon.png"/></a>
      </div>
    </div>
 </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add Position</button>
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
 <script type="text/javascript">
$(document).ready(function(){
    var max_fields = 100;
    var add_input_button = $('.add_input_button');
    var field_wrapper = $('.field_wrapper');
    var new_field_html = '<div><br><input type="text" style="width: 40%; height: 38px" name="position[]" value=""/><a href="javascript:void(0);" class="remove_input_button" title="Remove field"><img src="img/remove-icon.png"/></a></div>';
    var input_count = 1; 
  // Add button dynamically
    $(add_input_button).click(function(){
        if(input_count < max_fields){
            input_count++; 
            $(field_wrapper).append(new_field_html); 
        }
    });
  // Remove dynamically added button
    $(field_wrapper).on('click', '.remove_input_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        input_count--;
    });
});
</script>
</body>
</html>
