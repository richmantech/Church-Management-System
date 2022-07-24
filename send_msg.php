<?php 
use Zenoph\Notify\Enums\AuthModel;
use Zenoph\Notify\Request\NotifyRequest;
use Zenoph\Notify\Request\CreditBalanceRequest;
use Zenoph\Notify\Enums\TextMessageType;
use Zenoph\Notify\Enums\RequestHandshake;
use Zenoph\Notify\Request\SMSRequest;
use Zenoph\Notify\Request\RequestException;
require ("Zenoph/Notify/AutoLoader.php");
 ?>
<?php include("includes/header.php"); ?>
<?php
$message = "";
$msg="";
if(request_is_post() && request_is_same_domain()) {
if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
    $message = "Sorry, request was not valid.";
  }
  else {
$messages = sql_prep($_POST['messages']);
$messages = dirty_html($messages);
$messages = h($messages);
$messages = stripcslashes($messages);
$date = date("F j, Y, g:i a");

if(empty($messages)){
 $message = "Messages field cannot be empty";
}
else{
    // registration successful code
if(!$message){
     $query = "SELECT * FROM members";
      $select_posts = mysqli_query($connections,$query);
        while ($row = mysqli_fetch_assoc($select_posts)){
        $id=$row['id'];
        $tel_no = $row['tel_no'];
try {
    // set host
    NotifyRequest::setHost("api.smsonlinegh.com");

    // By default requests will be sent using SSL/TLS with https connection.
    // If you encounter SSL/TLS warning or error, your machine may be using unsupported
    // SSL/TLS version. In that case uncomment the following line to set it to false
    // NotifyRequest::useSecureConnection(false);
    // Initialise request object
    $sr = new SMSRequest();
    // set authentication details.
    $sr->setAuthModel(AuthModel::API_KEY);
    $sr->setAuthApiKey("528495a0426bd2e5ed1f83cd39c3bde208d3e693c288240aa7ceefac88934b42");
    // message properties
    $sr->setMessage($messages);
    $sr->setMessageType(TextMessageType::TEXT);
    $sr->setSender("CGC");     // should be registered
    // add message destination
    $sr->addDestination($tel_no);
    // send message
    $sr->submit();
}

catch (\Exception $ex){
    // output error message
    die ("Error: " . $ex->getMessage());
}
}
$sql = "INSERT INTO messages(messages,date)";
$sql.="VALUES('$messages','$date')";
$result = mysqli_query($connections,$sql);
$msg="Message Sent Successfully";
 header("Location: send_msg.php");
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
            <h1>Send Message to  Members </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Balance: 
<?php
try {
    // set host
    NotifyRequest::setHost('api.smsonlinegh.com');
    // By default requests will be sent using SSL/TLS with https connection.
    // If you encounter SSL/TLS warning or error, your machine may be using unsupported
    // SSL/TLS version. In that case uncomment the following line to set it to false
    // NotifyRequest.useSecureConnection(false);
    // create request object
    $br = new CreditBalanceRequest();
    $br->setAuthModel(AuthModel::API_KEY);
    $br->setAuthApiKey('528495a0426bd2e5ed1f83cd39c3bde208d3e693c288240aa7ceefac88934b42');
    // get the balance
    $bResp = $br->submit();
    // output the balance
    $balance = $bResp->getBalance();
    echo "{$balance}";
} 
catch (Exception $ex) {
    die (printf("Error: %s.", $ex->getMessage()));
}
?>

              </a></li>
              <li class="breadcrumb-item active">Send Message</li>
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
                <h3 class="card-title">Fill in to Send Message to  Members</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               
              <form id="quickForm" method="POST" action="<?php echo h($_SERVER['PHP_SELF']) ?>"  accept-charset="utf-8" enctype="multipart/form-data">
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
                   


                 <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Message</label>
                       <textarea class="form-control" name="messages" rows="3" placeholder="Type Message" required></textarea value="<?php if (isset($address)) { echo $address; } ?>" >
                    </div>
      
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Send Message</button>
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
