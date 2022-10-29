<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php';
   

if(!isset($_GET['userid']) || $_GET['userid']==NULL){
    echo "<script> window.location='userlist.php';</script>";
}
else{
     $userid=$_GET['userid'];
}




?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>User Details</h2>
                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                   echo "<script> window.location='userlist.php';</script>";
              }


          
          ?>




                <div class="block"> 
                <?php 
                $queryedit="SELECT * from users WHERE id='$userid'";
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
                                <input name="name" readonly  type="text" value="<?php echo $editprofile['name']; ?> "class="medium" />
                            </td>
                        </tr>
                     
                       
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input name="username" readonly  type="text" value="<?php echo $editprofile['username']; ?> "class="medium" />
                            </td>
                        </tr>
                     
                       
                        <tr>
                            <td>
                                <label>E-mail</label>
                            </td>
                            <td>
                                <input name="email" readonly  type="text" value="<?php echo $editprofile['email']; ?> "class="medium" />
                            </td>
                        </tr>
                     
                       
                        <tr>
                            <td style="vertical-align:top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea name="details" readonly  class="tinymce"><?php echo $editprofile['details']; ?></textarea>
                            </td>
                        </tr>
                     
                       
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
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
