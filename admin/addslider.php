<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Slider Images</h2>
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

    if (empty($file_name)|| empty($title)) {
     echo "<span class='error'>Field Must not be Empty !</span>";


    }elseif ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";


    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";


    } else{
         // echo $cat.$author.$tags.$body;
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO slider(title,image) 
        VALUES('$title','$uploaded_image')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
         echo "<span class='success'>Slider Image Inserted Successfully.
         </span>";


        }else {
         echo "<span class='error'>Slider Image Not Inserted !</span>";

        }


               }
           }
                 ?>
                <div class="block">               
                 <form action="addslider.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input name="title" type="text" placeholder="Enter Slider  Title..." class="medium" />
                            </td>
                        </tr>
                     
  
                   
                        <tr>
                            <td>
                                <label>Upload Slider Image</label>
                            </td>
                            <td>
                                <input name="image" type="file" />
                            </td>
                        </tr>
                       
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
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
