<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock"> 
           <?php     
           if($_SERVER['REQUEST_METHOD']=='POST'){
            $copyright=mysqli_real_escape_string($db->link,$_POST['copyright']);




            if(!empty($copyright)){

              $query="UPDATE footer SET 
              notes='$copyright'
              where id='1';
              ";
              $updated_row = $db->update($query);
              if ($updated_row) {
                 echo "<span class='success'>Data Updated Successfully.
                 </span>";


             }else {
                 echo "<span class='error'>Data Not Updated !</span>";

             }


         }
         else{
          echo "<span class='error'>Input field Not Empty !</span>";

      }



  }

  ?> 
  <?php
  $query="SELECT * from footer where id=1";
  $footer=$db->select($query);
  if($footer){
    while($result=$footer->fetch_assoc()){
        ?>    
        <form action="copyright.php" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['notes']; ?>" name="copyright" class="large" />
                    </td>
                </tr>

                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
        </form>
    <?php }} ?>
</div>
</div>
</div>
<?php  include 'inc/footer.php'  ?>;
