<?php 
include '../lib/Session.php';
Session::init();

include '../config/config.php';
include '../lib/Database.php';
include '../helpers/formater.php';
?>
 <!-- All  classes object  -->

<?php
$db=new Database();
if(!isset($_GET['deletpostid']) || $_GET['deletpostid']==NULL){
    echo "<script> window.location='postlist.php';</script>";
}
else{
    $id=$_GET['deletpostid'];
    $query="SELECT * from post  where id='$id'";
    $getData=$db->select($query);
    if($getData){
        while($delimg=$getData->fetch_assoc()){
            $dellink=$delimg['image'];
            unlink($dellink);
        }
    }
    $delquery="DELETE from post  WHERE id='$id'";
    $delData=$db->delete($delquery);
    if($delData){
        echo "<script>alert('Data Deleted Successfully !!');</script>";
          echo "<script> window.location='postlist.php';</script>";
    }
    else{
         echo "<script>alert('Data Not Deleted !!');</script>";
          echo "<script> window.location='postlist.php';</script>";
    }
}

?>