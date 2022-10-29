<!-- header section start -->
<?php

include 'inc/header.php';
include 'inc/slider.php';
?>

<?php 

if (!isset($_GET['category'])|| $_GET['category']==NULL){
	header("Location: 404.php");
}
else{
	$catid=$_GET['category'];
}

?>



	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
                  <?php
				  $catqr="SELECT * from post Where cat=$catid";
				      $catpost=$db->select($catqr);
				     if($catpost){
					while($row=$catpost->fetch_assoc()){
              
					 ?>

			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $row['id']; ?>"><?php  echo $row['title'] ?></a></h2>
				<h4><?php echo $fm->DateFormater($row['date']); ?>,

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

	     else { ?>

                  <h3>No Post Available in this  category  !!!</h3>


	     	<?php } ?>
		</div>
	<?php include 'inc/sidebar.php';?>
		<!-- sidebar End -->
	</div>
<!-- footer section start -->
	<?php include 'inc/footer.php';?>