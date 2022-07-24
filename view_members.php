<?php include("includes/header.php"); ?>


<?php
include "delete_modal.php";
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

if(empty($address)){
 $message = "Address cannot be empty";
}

if(empty($tel)){
 $message = "Phone Number cannot be empty";
}

if(tel_exit($tel)){
 $message = " Sorry Phone Number is Already Exist";
}

else{
    // registration successful code

if(!$message){
$sql = "INSERT INTO members(first_name,last_name,tel_no,address,pic)";
$sql.="VALUES('$first_name','$surname','$tel','$address','$newfilename')";
$result = mysqli_query($connections,$sql);

$msg="Member Added Successfully";

}
}
}
}
?>







<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php include("includes/preload.php"); ?>

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
            <h1>All Members </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Members</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All church members</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                                               <th><input  id="selectAllBoxes"type = "checkbox" /></th>

                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Telephone No</th>
                    <th>Address</th>
                    <th>Picture</th>
                     <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php 
          
           $query = "SELECT * FROM members ORDER BY id DESC";
      $select_posts = mysqli_query($connections,$query);
               
        while ($row = mysqli_fetch_assoc($select_posts)){
        $id=$row['id'];
        $first_name = $row['first_name'];
        $surname= $row['last_name'];
        $tel_no = $row['tel_no'];
        $address = $row['address'];
        $pic = $row['pic'];
        
        echo "<tr>";
        
        ?>
 <td><input class= 'checkBoxes' name='checkBoxArray[]' type = 'checkbox' value='<?php echo $id; ?>' /></td>
                <?php
        
        
        echo "<td> {$first_name} </td>";
        echo "<td>  {$surname} </td>";
        echo "<td> {$tel_no} </td>";
if (empty($address)) {
 echo "<td> Not Specified </td>";
}else{
 echo "<td>" .$address. "</td>";
}
           $ext = pathinfo($pic,PATHINFO_EXTENSION);
if($ext==='png' or $ext==='jpg' or $ext==='jpeg'){
echo "<td><center><a href=\"/pics/$pic\"><img class='img-responsive' src='pics/{$pic}' width='60' height='60' alt=''><span class='text-info'><br></span></a></center></td>";
}else{
 echo "<td> <center><img width='50' src='img/icons8-user-male-120.png'</center> </td>";
}
  


       


        //            $query = "SELECT * FROM feedbacks WHERE feedback_course_id = $course_id";
        //            $send_feedback_query = mysqli_query($connections,$query);
        //            $row = mysqli_fetch_array($send_feedback_query);
        //            $feedbacks_id = $row['feedback_id'];
        //            $count_feedback = mysqli_num_rows($send_feedback_query);
        // echo "<td><a href=''> {$count_feedback} </a></td>";
        //             echo "<td>{$course_status}</td>";

        echo "<td> <a href='edit_member.php?mid={$id}'>Edit </a></td>";
        //echo "<td> <a onClick=\"javascript:return confirm ('Are you sure you want to delete');\" href='posts.php?delete={$post_id}'>Delete </a></td>";
        echo "<td> <a rel='{$id}' href = 'javascript:void(0)' class='delete_link'>Delete </a></td>";
        
        
        echo "</tr>";
        
              }
          

                                  
          if(isset($_GET['delete'])){
          
          $the_m_id = sql_prep($_GET['delete']);
          $query = "DELETE FROM members WHERE id = {$the_m_id} ";
          $delete_query = mysqli_query($connections,$query);
            header("Location: view_members.php");
            
          }

           
                    
          ?>
                                
    
              
                  </tbody>
                  <tfoot>
              <!--     <tr>
                   <th>First Name</th>
                    <th>Surname</th>
                    <th>Telephone No</th>
                    <th>Address</th>
                    <th>Picture</th>
                  </tr> -->
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  </div>
 <?php include("includes/footer.php"); ?>
    <script>
//modal javascript code here
    
    $(document).ready(function(){
      
      
      $(".delete_link").on('click',function(){
        
        var id = $(this).attr("rel");
        
        var delete_url = "view_members.php?delete=" +id+ " ";
        
        $(".modal_delete_link").attr("href", delete_url);
        
        $("#myModal").modal('show');
        
      });
      
      
    });



</script>
</body>
</html>
