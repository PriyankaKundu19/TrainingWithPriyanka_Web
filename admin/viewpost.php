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
                <h2>Update Post</h2>
                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                     echo "<script> window.location='postlist.php';</script>";
                 
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
                                <input readonly  type="text" value="<?php echo $editresult['title']; ?> "class="medium" />
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
                                <label> Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $editresult['image']; ?>" height="100px" width="150px;">
                                <input  readonly  name="image" type="file" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Body</label>
                            </td>
                            <td>
                                <textarea  readonly  name="body"  class="tinymce"><?php echo $editresult['body']; ?></textarea>
                            </td>
                        </tr>
                          <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input  readonly  name="tags" type="text" value="<?php echo $editresult['tags']; ?> " class="medium" />
                            </td>
                        </tr>
                          <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input  readonly  name="author" type="text" value=" <?php   echo $editresult['author'] ?>" class="medium" />

                                <input  readonly  name="userid" type="hidden" value="  <?php   echo Session::get('userId'); ?>" class="medium" />
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
