 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">

      <span class="brand-text font-weight-light">Covenant Grace Chapel(CGC)</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/icons8-user-80.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            

     <?php
             if(isset($_SESSION['admin_mail'])){

        $query = "SELECT  full_name FROM admin_users WHERE email  = '".$_SESSION['admin_mail']."'" ;
        $results = mysqli_query($connections,$query);
        $row = mysqli_fetch_assoc($results);
        $full_name = $row['full_name'];
        echo $full_name;


            }

                ?>


          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-"></i>
              </p>
            </a>
            
          </li>
        
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Members
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">
<?php  
$select_members=mysqli_query($connections,"SELECT * FROM members");
$count_members=mysqli_num_rows($select_members);
echo $count_members;

?>


          </span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="view_members.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Members</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addmember.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Member</p>
                </a>
              </li>
           
        
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Positions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="addposition.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Position</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="position.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Positions</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="view_positions.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Positions</p>
                </a>
              </li>
        
            </ul>
          </li>


<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Messages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="send_msg.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Send message</p>
                </a>
              </li>
           
        
            </ul>
          </li>

   <li class="nav-item">
            <a href="profile.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Profile
              </p>
            </a>
     
          </li>

   <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Logout
              </p>
            </a>
          <!--   <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="send_msg.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Send message</p>
                </a>
              </li>
           
        
            </ul> -->
          </li>
      
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>