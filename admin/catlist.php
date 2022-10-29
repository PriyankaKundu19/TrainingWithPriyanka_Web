<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>

                 <?php
                 if(isset($_GET['delcat'])){
                 	$delid=$_GET['delcat'];
                 	$delquery="DELETE from category where id='$delid'";
                 	$deldata=$db->delete($delquery);
                 	if(!$deldata){
                    echo "<span class='error'>Category Not Deleted Successfully ! </span>";
                 	}
                 	else{
                 		echo "<span class='success'> Category Deleted Successfully !</span>";
                 	}
                 }



                  ?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                         $query="SELECT * from category order by id desc";
                         $category=$db->select($query);
                         if ($category){
                         	$i=0;
                         	while($row=mysqli_fetch_assoc($category)){

                           $i++;

						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><a  href="editcat.php?catid=<?php echo $row['id']; ?>">Edit</a> ||<a  onclick="return confirm('Are you sure to  Delete !');" href="?delcat=<?php echo $row['id']; ?> "> Delete</a> </td>
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