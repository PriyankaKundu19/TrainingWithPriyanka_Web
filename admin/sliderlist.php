<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Slider Title</th>
							<th>Slider Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						 $query="SELECT * FROM slider";


                        $post=$db->select($query);
                        if($post){
                        	$i=0;
                        	while($result=$post->fetch_assoc()){
                        		$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['title']; ?></td>
							<td><img src="<?php echo $result['image']; ?>" height="40px" widht="60px"></td>

							<td>
								<?php
								if(Session::get('userRole')==0){

								 ?>
					     	<a href="editslider.php?sliderid=<?php echo $result['id'];?>">Edit</a> ||
					        <a href="delslider.php?sliderid=<?php echo $result['id'];?> "onclick="return confirm('Are you sure to Delete');">Delete</a></td>

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

<?php  include 'inc/footer.php' ; ?>;
