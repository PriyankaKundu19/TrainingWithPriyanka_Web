<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
 <?php  if(!Session::get('userRole')=='0'){ 
    echo "<script> window.location.href='index.php';</script>";

}



    ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Users</h2>
        <div class="block copyblock"> 


            <?php 
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $username=$fm->validation($_POST['username']);
                $password=$fm->validation(md5($_POST['password']));
                $email=$fm->validation($_POST['email']);
                $role=$fm->validation($_POST['role']);

                $username=mysqli_real_escape_string($db->link,$username);
                $password=mysqli_real_escape_string($db->link,$password);
                $email=mysqli_real_escape_string($db->link,$email);
                $role=mysqli_real_escape_string($db->link,$role);

                if(empty($username)||empty($password)|| empty($role)||empty($email)){
                    echo "<span class='error'>Field must not be empty! </span>";

                }
                else{
                         $query="SELECT * from users WHERE email='$email'";
                         $mailcheck=$db->select($query);
                if($mailcheck){
                     echo "<span class='error'>E-mail is already Exits ! </span>";

                }
                else{         

                   $query="INSERT INTO users(username,password,email,role) VALUES ('$username','$password','$email','$role');";
                    $catinsert=$db->insert($query);
                    if($catinsert){
                      echo "<span class='success'>Users  Create Successfully!</span>";
                  }
                  else{
                   echo "<span class='error'>User Not  Created! </span>";
                }
               }
           }
       }
       ?>


       <form method="post">
        <table class="form">					
            <tr>
                <td>
                    <lebel>Username</lebel>
                </td>
                <td>
                    <input type="text" name="username" placeholder="Enter UserName..." class="medium" />
                </td>
            </tr>                   
            <tr>
                <td>
                    <lebel>Password</lebel>
                </td>
                <td>
                    <input type="password" name="password" placeholder="Password..." class="medium" />
                </td>
            </tr>                  
            <tr>
                <td>
                    <lebel>E-mail</lebel>
                </td>
                <td>
                    <input type="email" name="email" placeholder="E-mail..." class="medium" />
                </td>
            </tr>            
            <tr>
                <td>
                    <lebel>User Role</lebel>
                </td>
                <td>
                    <select id="select" name="role">
                        <option>Select User Role</option>
                        <option value="1">Admin</option>
                        <option value="2">Author</option>
                        <option value="3">Editor</option>
                    </select>
                </td>
            </tr>
            <tr> 
            <td>
                
            </td>
                <td>
                    <input type="submit" name="submit" Value="Add User" />
                </td>
            </tr>
        </table>
    </form>
</div>
</div>
</div>
<?php  include 'inc/footer.php'  ?>;