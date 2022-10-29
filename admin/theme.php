<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>


        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 


        <?php 
         if($_SERVER['REQUEST_METHOD']=='POST'){
            $name=mysqli_real_escape_string($db->link,$_POST['theme']);

                $query="UPDATE theme SET theme='$name' where id='1';";
                $updaterow=$db->update($query);
                if($updaterow){
                   echo "<span class='success'>Update theme succesfully!  </span>";
                }

                else{
                     echo "<span class='error'>Theme Not Updated! </span>";
                }
              }
            
        ?>
        <?php 
        $query="SELECT * from  theme where id='1' ";
        $category=$db->select($query);
        while($result=$category->fetch_assoc()){
        ?>


                 <form method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input <?php if($result['theme']=='default'){echo "checked";} ?>  type="radio" name="theme" value="default" />Default
                            </td>
                        </tr>                    
                        <tr>
                            <td>
                                <input <?php if($result['theme']=='green'){echo "checked";} ?>  type="radio" name="theme" value="green" />Green
                            </td>
                        </tr>                    
                        <tr>
                            <td>
                                <input <?php if($result['theme']=='red'){echo "checked";} ?>  type="radio" name="theme" value="red" />Red
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>

                <?php
                 } 
                ?>
                </div>
            </div>
        </div>
<?php  include 'inc/footer.php'  ?>;