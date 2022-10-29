<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php 
if(!isset($_GET['msgid']) || $_GET['msgid']==NULL){
   echo "<script> window.location.href='inbox.php';</script>";
}
else{
    $id=$_GET['msgid'];
}

?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>View  Messages</h2>
        <?php

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $to=$fm->validation($_POST['toEmail']);
            

            // $toEmail=mysqli_real_escape_string($db->link,$toEmail);  
            $from=$fm->validation($_POST['fromEmail']);
            

            // $fromEmail=mysqli_real_escape_string($db->link,$fromEmail);  
            $subject=$fm->validation($_POST['subject']);
            


            $message=$fm->validation($_POST['message']);
            $sendmail=mail($to,$subject,$message,$from);
            if($sendmail){
                  echo "<span class='success'>Message Send Successfully.
         </span>";
            }
            else{
                  echo "<span class='error'>Message  Not Send !!!
         </span>";
            }

 

       }

       ?>
       <div class="block">               
           <form action="" method="post" >
                                        <?php 
                         $query="SELECT * from contact WHERE id='$id'";
                         $msg=$db->select($query);
                         if ($msg){
                            $i=0;
                            while($row=mysqli_fetch_assoc($msg)){

                           $i++;

                        ?>
            <table class="form">

                <tr>
                    <td>
                        <label>To</label>
                    </td>
                    <td>
                        <input  type="text" name="toEmail" readonly value="<?php echo $row['email']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>From</label>
                    </td>
                    <td>
                        <input  type="text" name="fromEmail" placeholder="Please Enter Your Email Address!!"  class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Subject</label>
                    </td>
                    <td>
                        <input  type="text" name="subject" placeholder="Please Enter Subject!!"  class="medium" />
                    </td>
                </tr>



                <tr>
                    <td >
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea  class="tinymce" name="message"></textarea>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Ok " />
                    </td>
                </tr>
            </table>
        <?php }} ?>
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
