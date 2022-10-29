<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Users List</h2>

                 <?php
                 if(isset($_GET['delid'])){
                 	$delid=$_GET['delid'];
                 	$delquery="DELETE from users where id='$delid'";
                 	$deldata=$db->delete($delquery);
                 	if(!$deldata){
                    echo "<span class='error'>User Not Deleted  ! </span>";
                 	}
                 	else{
                 		echo "<span class='success'> User Deleted Successfully !</span>";
                 	}
                 }



                  ?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
                            <th>Username</th> 
                            <th>E-mail</th> 
                            <th>Details</th>  
                            <th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                         $query="SELECT * from users";
                         $category=$db->select($query);
                         if ($category){
                         	$i=0;
                         	while($row=mysqli_fetch_assoc($category)){

                           $i++;

						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>

							<td><?php echo $row['name']; ?></td>
                            
                            <td><?php echo $row['username']; ?></td>        
                            <td><?php echo $row['email']; ?></td>        
                            <td><?php echo $fm->PostFormater($row['details'],30); ?></td>        
                            <td><?php 
                            if($row['role']=='0'){
                                echo "Admin";
                            }
                            elseif($row['role']=='1'){
                                echo "Editor";
                            }else{
                                echo "Author";
                            }


                             ?></td>

							<td><a  href="viewusers.php?userid=<?php echo $row['id']; ?>">View Profile</a> 
                                          <?php  if(Session::get('userRole')=='0'){ ?>


                               || <a  onclick="return confirm('Are you sure to  Delete !');" href="?delid=<?php echo $row['id']; ?> "> Delete</a> </td>
                            <?php } ?>
						</tr>
						<?php  
                         	}
                         }
                         ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>

        

     <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>
<?php  include 'inc/footer.php'  ?>;


</head>