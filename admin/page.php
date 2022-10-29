<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php 
if(!isset($_GET['pageid']) || $_GET['pageid']==NULL){
   echo "<script> window.location.href='index.php';</script>";
}
else{
    $pageid=$_GET['pageid'];
}

?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Pages</h2>
        <?php

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $name=mysqli_real_escape_string($db->link,$_POST['name']);
            $body=mysqli_real_escape_string($db->link,$_POST['body']);

            if (empty($name)|| empty($body)) {
             echo "<span class='error'>Field Must not be Empty !</span>";


         } else {
           $query="UPDATE page SET 
           name='$name',
           body='$body'
           where id='$pageid';
           ";



           $updated_row = $db->update($query);
           if ($updated_row) {
             echo "<span class='success'>Page Updated Successfully.
             </span>";


         }else {
             echo "<span class='error'>Page Not Updated !</span>";

         }


     }
 }

 ?>
 <style type="text/css">
     .actiondel{
        margin-left: 10px;
     }
     .actiondel a{
        background: #f0f0f0 none repeat scroll 0 0;
        border: 1px solid #ddd;
        color: #444;
        cursor: pointer;
        font-size: 20px;
        padding: 4px 10px; 
        font-weight: normal;
     }
 </style>
 <div class="block">               
     <form action="" method="post" >
        <?php 
        $query="SELECT * from page WHERE id='$pageid'";


        $pages=$db->select($query);
        if($pages){
            while($result=$pages->fetch_assoc()){
               ?>
               <table class="form">

                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input name="name" type="text" value="<?php echo $result['name'] ;?>" class="medium" />
                    </td>
                </tr>



                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Body</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce">
                            <?php echo $result['body'] ;?>
                        </textarea>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Edit Page" />
                        <span class="actiondel"><a onclick="return confirm('Are you Sure to delete this page?');" href="delpage.php?delpage=<?php echo $result['id'];?>">Delete</a></span>
                    </td>
                </tr>
            </table>
        </form>
    <?php  }} ?>
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
