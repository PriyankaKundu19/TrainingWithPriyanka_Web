<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">
                 <?php     
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $fb=mysqli_real_escape_string($db->link,$_POST['fb']);
                    $tw=mysqli_real_escape_string($db->link,$_POST['tw']);
                    $ln=mysqli_real_escape_string($db->link,$_POST['ln']);
                    $gp=mysqli_real_escape_string($db->link,$_POST['gp']);
                    


                       if(!empty($fb)||!empty($tw) || !empty($ln) ||!empty($gp)){
                      
                          $query="UPDATE social SET 
                            fb='$fb',
                            tw='$tw',
                            ln='$ln',
                            gp='$gp'
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
           $query="SELECT * from social where id=1";
           $social=$db->select($query);
           if($social){
            while($result=$social->fetch_assoc()){
                ?>           
                <form action="social.php" method="post"  enctype="multipart/form-data ">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $result['tw']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $result['ln']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $result['gp']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td></td>
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
<?php  include 'inc/footer.php'; ?>;
