<?php
include 'inc/header.php';
?>
<?php 
if(!isset($_GET['pageid']) || $_GET['pageid']==NULL){
	header('Location:404.php');
}
else{
	$pageid=$_GET['pageid'];
}

?>
<?php 
			$query="SELECT * from page WHERE id='$pageid'";


			$pages=$db->select($query);
			if($pages){
				while($result=$pages->fetch_assoc()){
					?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			
					<h2><?php echo $result['name']; ?></h2>

					<?php echo $result['body']; ?>

				</div>

			</div>


			<?php 
			include 'inc/sidebar.php';

			?>
		</div>
			<?php } }else{
				header("Location:404.php");
			} ?>
		<?php 
		include 'inc/footer.php';
	?>