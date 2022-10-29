<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php';

if(!isset($_GET['sliderid']) || $_GET['sliderid']==NULL){
    echo "<script> window.location='sliderlist.php';</script>";
}
else{
     $editid=$_GET['sliderid'];
}

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update  Post</h2>
                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $title=mysqli_real_escape_string($db->link,$_POST['title']);
                    

                 // Image validation 
                    $permited  = array('jpg', 'jpeg', 'png', 'gif');
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_temp = $_FILES['image']['tmp_name'];

                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_image = "../images/slidershow/".$unique_image;

                    if (empty($title)) {
                       echo "<span class='error'>Field Must not be Empty !</span>";


                   }else{
                       if(!empty($file_name)){
                           if ($file_size >1048567) {
                               echo "<span class='error'>Image Size should be less then 1MB!
                               </span>";


                           } elseif (in_array($file_ext, $permited) === false) {
                               echo "<span class='error'>You can upload only:-"
                               .implode(', ', $permited)."</span>";


                           } else{
             // echo $cat.$author.$tags.$body;
                            move_uploaded_file($file_temp, $uploaded_image);

                            $query="UPDATE slider SET 
                            title='$title',
                            image='$uploaded_image'
                            where id='$editid';
                            ";



                            $updated_row = $db->update($query);
                            if ($updated_row) {
                               echo "<span class='success'>Data Updated Successfully.
                               </span>";


                           }else {
                               echo "<span class='error'>Data Not Updated !</span>";

                           }


                       }

                   }else{
                       $query="UPDATE slider SET 
                       title='$title'
                       where id='$editid';
                       ";



                       $updated_row = $db->update($query);
                       if ($updated_row) {
                         echo "<span class='success'>Data Updated Successfully.
                         </span>";


                     }else {
                         echo "<span class='error'>Data Not Updated !</span>";

                     }

                  }
              }


          }
          ?>




                <div class="block"> 
                <?php 
                $queryedit="SELECT * from slider WHERE id='$editid'";
                $getpost=$db->select($queryedit);
                while($editresult=$getpost->fetch_assoc()){



                ?>              
                 <form action=" " method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input name="title" type="text" value="<?php echo $editresult['title']; ?> "class="medium" />
                            </td>
                        </tr>
                     
                      
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $editresult['image']; ?>" height="100px" width="150px;">
                                <input name="image" type="file" />
                            </td>
                        </tr>
                       
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update Slider" />
                            </td>
                        </tr>
                    </table>
                    </form>

                <?php } ?>
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
