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
if(!isset($_GET['sliderid']) || $_GET['sliderid']==NULL){
    echo "<script> window.location='sliderlist.php';</script>";
}
else{
    $id=$_GET['sliderid'];
    $query="SELECT * from slider  where id='$id'";
    $getData=$db->select($query);
    if($getData){
        while($delimg=$getData->fetch_assoc()){
            $dellink=$delimg['image'];
            unlink($dellink);
        }
    }
    $delquery="DELETE from  slider  WHERE id='$id'";
    $delData=$db->delete($delquery);
    if($delData){
        echo "<script>alert('Image Deleted Successfully !!');</script>";
          echo "<script> window.location='sliderlist.php';</script>";
    }
    else{
         echo "<script>alert('Image Not Deleted !!');</script>";
          echo "<script> window.location='sliderlist.php';</script>";
    }
}

?>