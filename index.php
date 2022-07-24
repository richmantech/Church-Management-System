<?php include("includes/header.php"); ?>



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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php  
$select_members=mysqli_query($connections,"SELECT * FROM members");
$count_members=mysqli_num_rows($select_members);
echo $count_members;

?></h3>

                <p>Total Members</p>
              </div>
              <div class="icon">
                <i class="ion ion-male"></i>
              </div>
              <a href="view_members.php" class="small-box-footer">View All <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



  <!-- ./col -->
          <div class="col-lg-3 col-6">
            <?php  
 $count_them='';
$positions='';
$position = mysqli_query($connections,"SELECT * FROM positions ORDER BY id desc Limit 1");
while($row=mysqli_fetch_array($position)){
  $pid=$row['id'];
  $positions=$row['positions'];


$assign_position = mysqli_query($connections,"SELECT * FROM assign_positions WHERE position_id='$pid'");
$count=mysqli_num_rows($assign_position);
if($count>0){
 $count_them=$count;
}else{
  $count_them="0";
}

}
?>
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $count_them; ?><sup style="font-size: 20px"></sup></h3>

                <p><?php echo $positions; ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="view_positions.php" class="small-box-footer">View details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <?php  
 $count_them2='';
$positions2='';
$position2 = mysqli_query($connections,"SELECT * FROM positions ORDER BY id desc Limit 1,1");
while($row=mysqli_fetch_array($position2)){
  $pid2=$row['id'];
  $positions2=$row['positions'];


$assign_position2 = mysqli_query($connections,"SELECT * FROM assign_positions WHERE position_id='$pid2'");
$count2=mysqli_num_rows($assign_position2);
if($count2>0){
 $count_them2=$count2;
}else{
  $count_them2="0";
}

}
?>

            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php  echo $count_them2; ?></h3>

                <p><?php echo $positions2; ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="view_positions.php" class="small-box-footer">View details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        

          <?php  
 $count_them3='';
$positions3='';
 $position3 = mysqli_query($connections,"SELECT * FROM positions ORDER BY id desc LIMIT 1 OFFSET 2");
 $count_p=mysqli_num_rows($position3);
if($count_p<0){

}else{
?>
 
<?php 
while($row=mysqli_fetch_array($position3)){
  $pid3=$row['id'];
  $positions3=$row['positions'];


$assign_position3 = mysqli_query($connections,"SELECT * FROM assign_positions WHERE position_id='$pid3'");
$count3=mysqli_num_rows($assign_position3);
if($count3>0){
 $count_them3=$count3;
}else{
  $count_them3="0";
}
}?>
 <div class="col-lg-3 col-6">
<!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php  echo $count_them3; ?></h3>

                <p><?php echo $positions3; ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="view_positions.php" class="small-box-footer">View details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
<?php 
}
?>

            
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">

<?php  





?>


     
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
             ['Data', 'Count'],


      <?php
     
$element_text = ['All Members',$positions,$positions2,$positions3,];
$element_count = [$count_members, $count_them,$count_them2,$count_them3,];
      
      for($i=0;$i<4;$i++){
      
      echo "['{$element_text[$i]}'" . "," ."{$element_count[$i]}],";  
        
         
      }
    
      
      ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  <div id="columnchart_material" style="width:auto; height: 500px;"></div>            
            <!-- /.card -->



          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

      

            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 <?php include("includes/footer.php"); ?>

</body>
</html>
