<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php';

if(!isset($_GET['editpostid']) || $_GET['editpostid']==NULL){
    echo "<script> window.location='postlist.php';</script>";
}
else{
     $editid=$_GET['editpostid'];
}

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update  Post</h2>
                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $title=mysqli_real_escape_string($db->link,$_POST['title']);
                    $cat=mysqli_real_escape_string($db->link,$_POST['cat']);
                    $body=mysqli_real_escape_string($db->link,$_POST['body']);
                    $tags=mysqli_real_escape_string($db->link,$_POST['tags']);
                    $author=mysqli_real_escape_string($db->link,$_POST['author']);
                    $userid=mysqli_real_escape_string($db->link,$_POST['userid']);
                    

                 // Image validation 
                    $permited  = array('jpg', 'jpeg', 'png', 'gif');
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_temp = $_FILES['image']['tmp_name'];

                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_image = "../images/".$unique_image;

                    if (empty($title)|| empty($cat)||empty($body)||empty($tags)||empty($author)) {
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

                            $query="UPDATE post SET 
                            cat='$cat',
                            title='$title',
                            body='$body',
                            author='$author',
                            tags='$tags',
                            image='$uploaded_image',
                            userid='$userid'
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
                       $query="UPDATE post SET 
                       cat='$cat',
                       title='$title',
                       body='$body',
                       author='$author',
                       tags='$tags',
                       userid='$userid'
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
                $queryedit="SELECT * from post WHERE id='$editid' order by id desc";
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
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select  Category</option>

                                    <?php 
                                    $query="SELECT * from  category";
                                    $category=$db->select($query);
                                    if($category){
                                        while($result=$category->fetch_assoc()){


                                    ?>
                                    <option <?php

                                    if($editresult['cat']==$result['id']){
                                        ?>
                                   selected="selected"


                                        <?php
                                       }

                                     ?> value="<?php echo $result['id'];?>"><?php echo $result['name']; ?></option>

                                    <?php }
                                    }
                                    ?>
                                </select>
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
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Body</label>
                            </td>
                            <td>
                                <textarea name="body"  class="tinymce"><?php echo $editresult['body']; ?></textarea>
                            </td>
                        </tr>
                          <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input name="tags" type="text" value="<?php echo $editresult['tags']; ?> " class="medium" />
                            </td>
                        </tr>
                          <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input name="author" type="text" value=" <?php   echo $editresult['author'] ?>" class="medium" />

                                <input name="userid" type="hidden" value="  <?php   echo Session::get('userId'); ?>" class="medium" />
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
