<?php include("includes/header.php"); ?>


<?php
include "delete_modal.php";
if(isset($_POST['checkBoxArray'])){

  foreach($_POST['checkBoxArray'] as $positionValueId){
  
  $bulk_options = $_POST['bulk_options'];
    


  // switch($bulk_options){
    
    $sql = "INSERT INTO assign_positions(member_id,position_id)";
$sql.="VALUES('$positionValueId','$bulk_options')";
$result = mysqli_query($connections,$sql);
   
      
    
    
  }
  
}
  

// if(!$message){
// $sql = "INSERT INTO members(first_name,last_name,tel_no,address,pic)";
// $sql.="VALUES('$first_name','$surname','$tel','$address','$newfilename')";
// $result = mysqli_query($connections,$sql);

// $msg="Member Added Successfully";

// }

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
            <h1>View Position </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Positions </li>
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
                <h3 class="card-title">All church positions</h3>
              </div>
              <!-- /.card-header -->
              <form action="" method="post">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                      <div id="bulkoptionscontainer" class="col-sm-6">
                    <div class="form-group">
                   <!--  <select name="bulk_options" class="form-control" id="select">
                    
                    <option value="">Select Options</option>
           
                    
                
                    
                    </select> -->
                    </div>
                    </div>
                    
<!--         <div class="col-sm-6">
 -->        <!-- textarea -->
      <!--   <div class="form-group">
        <input type = "submit" name= "submit" class= "btn btn-success" value="Assign" />

        </div>
        </div> -->

                
                  <thead>
                  <tr>
               <th></th>

                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Position</th>
                    <th>Picture</th>
                    
                 <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php 
          
       $assign_position = mysqli_query($connections,"SELECT * FROM assign_positions ORDER BY id DESC");
while($row=mysqli_fetch_array($assign_position)){
  $assign_id = $row['id'];
  $member_id=$row['member_id'];
  $position_id=$row['position_id'];

  $position = mysqli_query($connections,"SELECT * FROM positions WHERE id='$position_id'");
while($row=mysqli_fetch_array($position)){
  $pid=$row['id'];
  $positions=$row['positions'];
        
   $query_members = mysqli_query($connections,"SELECT * FROM members WHERE  id ='$member_id'");
        while ($row = mysqli_fetch_assoc($query_members)){
        $mid=$row['id'];
        $first_name = $row['first_name'];
        $surname= $row['last_name'];
        $tel_no = $row['tel_no'];
        $address = $row['address'];
        $pic = $row['pic'];

        echo "<tr class='content'>";
        
        ?>
 <td><input class= 'checkBoxes' name='checkBoxArray[]' type = 'checkbox' value='<?php echo $assign_id; ?>' /></td>
                <?php
        
        
        echo "<td> {$first_name} </td>";
        echo "<td>  {$surname} </td>";
        echo "<td> {$positions} </td>";
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

        // echo "<td> <a href='edit_member.php?mid={$id}'>Edit </a></td>";
        // //echo "<td> <a onClick=\"javascript:return confirm ('Are you sure you want to delete');\" href='posts.php?delete={$post_id}'>Delete </a></td>";
        echo "<td> <a rel='{$assign_id}' href = 'javascript:void(0)' class='delete_link'>Delete </a></td>";
        
        
        echo "</tr>";
        
              }
          }
}
                                  
          if(isset($_GET['delete'])){
          
          $the_m_id = sql_prep($_GET['delete']);
          $query = "DELETE FROM assign_positions WHERE id = {$the_m_id} ";
          $delete_query = mysqli_query($connections,$query);
            header("Location: view_positions.php");
            
          }

           
                    
          ?>
                                
    
              
                  </tbody>
           
                </table>
              </div> </form>
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
    <script>
 // script to check all checkboxes
   
   $(document).ready(function(){
     
    $('#selectAllBoxes').click(function(event){
      
      if(this.checked){
      
          $('.checkBoxes').each(function(){
          
          this.checked = true;
          
        });
      
        
      }else{
         $('.checkBoxes').each(function(){
          
          this.checked = false;
          
        });
        
        
      }
      
    });

</script>
<script>
$(document).ready(function () {
    // Caching the elements and binding handlers
    var $s = $('#select').on('change', filterRows),
        $i = $("#kwd_search").on('keyup', filterRows),
        $rows = $("#example1 tbody > tr");

    function filterRows() {
        var ind = $s.prop('selectedIndex'),
            term = $.trim($i.val().toLowerCase());

        if (term.length === 0) return $rows.show();

        $rows.hide().filter(function () {
            return this.cells[ind].textContent.toLowerCase().indexOf(term) > -1;
        }).show();

    };
});
</script>
  <script src="plugins/Dropdown-ddtf-js/ddtf.js"></script>
  <script type="text/javascript">
    $('table').ddTableFilter();
  

minOptions:1

</script>

  <script>
//modal javascript code here
    
    $(document).ready(function(){
      
      
      $(".delete_link").on('click',function(){
        
        var id = $(this).attr("rel");
        
        var delete_url = "view_positions.php?delete=" +id+ " ";
        
        $(".modal_delete_link").attr("href", delete_url);
        
        $("#myModal").modal('show');
        
      });
      
      
    });



</script>

</body>
</html>
