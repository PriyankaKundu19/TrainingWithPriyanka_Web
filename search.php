<!-- header section start -->
<?php

include 'inc/header.php';
include 'inc/slider.php';
?>

<?php 

if (!isset($_GET['search'])|| $_GET['search']==NULL){
	echo  "Please insert some value";
}
else{
	$searchval=$_GET['search'];
}

?>



	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
                  <?php
				  $catqr="SELECT * from post Where title LIKE '%$searchval%' OR  body LIKE '%$searchval%'";
				      $searchqr=$db->select($catqr);
				     if($searchqr){
					while($row=$searchqr->fetch_assoc()){
              
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

	       <?php  }  
	     }

	     else { echo "Doesn't available any related data";} ?>
		</div>
	<?php include 'inc/sidebar.php';?>
		<!-- sidebar End -->
	</div>
<!-- footer section start -->
	<?php include 'inc/footer.php';?>