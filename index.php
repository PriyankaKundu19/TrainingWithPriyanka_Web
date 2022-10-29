<!-- header section start -->
<?php

include 'inc/header.php';
include 'inc/slider.php';
?>



<!-- Pagination  -->

<?php 
	$per_page=3;
	if (isset($_GET['page'])){
		$page=$_GET['page'];
	}
	else{
		$page=1;
	}
	$start_form=($page-1)*$per_page;

?>
<!-- Pagination  -->
<!-- Get blog post -->
<?php
	$sql="select * from  post limit $start_form,$per_page";

	$result=$db->select($sql);
	
    if($result){
?>
<!-- header section end -->
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

			<?php
				while($row=mysqli_fetch_assoc($result)){
			?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $row['id']; ?>"><?php  echo $row['title'] ?></a></h2>
				<h4><?php echo $fm->    DateFormater($row['date']); ?>,

				 By <a href="#"><?php  echo $row['author'] ?></a></h4>

				 <a href="#"><img src="images/<?php  echo 
				 	$row['image']; ?>" alt="post image"/></a>
				<p>
				<?php  echo $fm->postformater($row['body'],400) ?>
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $row['id']; ?>">Read More</a>
				</div>
			</div>


			<?php 
			}
			?>
			<!-- End while loop  -->

           
             <!-- pagination start -->

             <?php 

             	$query="select * from post";
             	$result=$db->select($query);
             	$total_rows=mysqli_num_rows($result);
             	$total_pages=ceil($total_rows/$per_page);
             	echo "<span class='pagination'><a href='index.php?page=1'>".'First page'."</a>";

             	for ($i=1;$i<=$total_pages; $i++){
                  echo "<a href='index.php?page=$i'>$i</a>";
             	}

             ?>
            
             <?php
             	echo "<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>";

              ?>
             <!-- pagination end  -->

	
		</div>

          <?php  }  

	     else { header("Location:404.php") ;} ?>
	     <!-- if else end  -->





	<!-- sidebar start -->
	<?php 
			include 'inc/sidebar.php';
	?>
		<!-- sidebar End -->
	</div>

	<!-- footer section start -->
	<?php 
		include 'inc/footer.php';
	?>
<!-- footer secntion end -->
