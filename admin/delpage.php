<?php 
include '../lib/Session.php';
Session::init();

include '../config/config.php';
include '../lib/Database.php';
?>
 <!-- All  classes object  -->

<?php
$db=new Database();
if(!isset($_GET['delpage']) || $_GET['delpage']==NULL){
    echo "<script> window.location='index.php';</script>";
}
else{
    $pageid=$_GET['delpage'];
    $delquery="DELETE from page  WHERE id='$pageid'";
    $delData=$db->delete($delquery);
    if($delData){
        echo "<script>alert('Page Deleted Successfully !!');</script>";
          echo "<script> window.location='index.php';</script>";
    }
    else{
         echo "<script>alert('Page Not Deleted !!');</script>";
          echo "<script> window.location='index.php';</script>";
    }
}

?>