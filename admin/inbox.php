<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<!-- Delet message query  -->
		                 <?php
                 if(isset($_GET['delid'])){
                 	$delid=$_GET['delid'];
                 	$delquery="DELETE from contact where id='$delid'";
                 	$deldata=$db->delete($delquery);
                 	if(!$deldata){
                    echo "<span class='error'>Message Not Deleted  ! </span>";
                 	}
                 	else{
                 		echo "<span class='success'> Message Deleted Successfully !</span>";
                 	}
                 }



                  ?>
		<!-- check seen or unseen  -->
		<?php
		if(isset($_GET['seenid'])){
			$seenid=$_GET['seenid'];

			$query="UPDATE contact SET 
			status='1'
			where id='$seenid';
			";



			$updated_row = $db->update($query);
			if ($updated_row) {
				echo "<span class='success'>Seen
				</span>";
			}

		}
		?>

		<div class="block">        
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Name</th>
						<th>E-mail</th>
						<th>Message</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php 
					$query="SELECT * from contact WHERE status='0' ";
					$msg=$db->select($query);
					if ($msg){
						$i=0;
						while($row=mysqli_fetch_assoc($msg)){

							$i++;

							?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>					<td><?php echo $row['fastname']." ".$row['lastname'] ?></td>
								<td><?php echo $row['email'];?></td>
								<td><?php echo $fm->PostFormater($row['body'],30);?></td>
								<td><?php echo $fm->DateFormater($row['Date']);?></td>
								<td>

									<a href="viewmsg.php?msgid=<?php echo $row['id']; ?>">View</a> ||
									<a href="reaplymsg.php?msgid=<?php echo $row['id']; ?>">Reply</a>||
									<a onclick="return confirm('Seen your msg')" href="?seenid=<?php echo $row['id']; ?>">Seen</a>

								</td>
							</tr>

						<?php }} ?>

					</tbody>
				</table>
			</div>
		</div>   
		<div class="box round first grid">
			<h2>Seen Messages</h2>
			<div class="block">        
				<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>E-mail</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
						$query="SELECT * from contact WHERE status='1' order by id desc";
						$msg=$db->select($query);
						if ($msg){
							$i=0;
							while($row=mysqli_fetch_assoc($msg)){

								$i++;

								?>
								<tr class="odd gradeX">
									<td><?php echo $i; ?></td>		
									<td><?php echo $row['fastname']." ".$row['lastname'] ?></td>
									<td><?php echo $row['email'];?></td>
									<td><?php echo $fm->PostFormater($row['body'],30);?></td>
									<td><?php echo $fm->DateFormater($row['Date']);?></td>
									<td>
										<a href="viewmsg.php?msgid=<?php echo $row['id']; ?>">View</a> ||

										<a onclick="return confirm('Are you sure to delete this message ? ')" href="?delid=<?php echo $row['id']; ?>">Delete</a> 
									</td>
								</tr>

							<?php }} ?>

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