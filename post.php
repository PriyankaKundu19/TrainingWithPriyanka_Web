  <?php include 'inc/header.php';


if (!isset($_GET['id'])|| $_GET['id']==NULL){
	header("Location: 404.php");
}
else{
	$id=$_GET['id'];
}



  ?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">

				<?php  
				$query="SELECT * from post Where  id=$id";
				$post=$db->select($query);
				if($post){
					while($result=$post->fetch_assoc()){

				?>
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->DateFormater($result['date']); ?>, By <?php echo $result['author']; ?></h4>
				<img src="images/<?php echo $result['image']; ?>" alt="MyImage"/>
				<p>  <?php echo $result['body']; ?></p>





				


				<div class="relatedpost clear">
					<h2>Related articles</h2>

					<?php

					  $catid=$result['cat'];
					  $relatedqr="SELECT * from post Where cat=$catid order by rand() limit 6";
				      $relatedpost=$db->select($relatedqr);
				     if($relatedpost){
					while($related=$relatedpost->fetch_assoc()){
              
					 ?>
					<a href="post.php?id=<?php echo $related['id']; ?>"><img src="images/<?php echo $related['image']; ?>" alt="<?php echo $related['image'] ;?>"/></a>


				<?php 
                   }
               }
                   else{
                   	 echo "No related post Available";
                   }
				?>
		</div>



			   <?php
                 }
                 
                 ?>
              <?php
             }
             else{
                	header("Location: 404.php");
                 }

				?>
	</div>

		</div>

		<?php 
		include 'inc/sidebar.php';

		?>

	</div>
	<?php 
		include 'inc/footer.php';
	?>