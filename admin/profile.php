<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php';
   

   $userid=Session::get('userId');
   $userrole=Session::get('userRole');



?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $name=mysqli_real_escape_string($db->link,$_POST['name']);
                    $username=mysqli_real_escape_string($db->link,$_POST['username']);
                    $email=mysqli_real_escape_string($db->link,$_POST['email']);
                    $details=mysqli_real_escape_string($db->link,$_POST['details']);
                    
                     $query="UPDATE users SET 
                       name='$name',
                       username='$username',
                       email='$email',
                       details='$details'
                       where id='$userid'";

                       $updated_profile = $db->update($query);
                       if ($updated_profile) {
                         echo "<span class='success'>Data Updated Successfully.
                         </span>";


                     }else {
                         echo "<span class='error'>Data Not Updated !</span>";

                     }

                  
              }


          
          ?>




                <div class="block"> 
                <?php 
                $queryedit="SELECT * from users WHERE id='$userid' AND role='$userrole'";
                $getuser=$db->select($queryedit);
                if($getuser){
                while($editprofile=$getuser->fetch_assoc()){



                ?>              
                 <form action="" method="post" >
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input name="name" type="text" value="<?php echo $editprofile['name']; ?> "class="medium" />
                            </td>
                        </tr>
                     
                       
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input name="username" type="text" value="<?php echo $editprofile['username']; ?> "class="medium" />
                            </td>
                        </tr>
                     
                       
                        <tr>
                            <td>
                                <label>E-mail</label>
                            </td>
                            <td>
                                <input name="email" type="text" value="<?php echo $editprofile['email']; ?> "class="medium" />
                            </td>
                        </tr>
                     
                       
                        <tr>
                            <td style="vertical-align:top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea name="details" class="tinymce"><?php echo $editprofile['details']; ?></textarea>
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

                <?php } } ?>
                </div>
            </div>
        </div>

    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
    <?php  include 'inc/footer.php'  ?>;
