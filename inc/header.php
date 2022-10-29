<?php 

include 'config/config.php';
include 'lib/Database.php';
include 'helpers/formater.php';
?>
<!-- All  classes object  -->

<?php
$db=new Database();
$fm= new formater();


?>

<!DOCTYPE html>
<html>
<head>
	<?php 

    if(isset($_GET['pageid'])){

    	$pagetitle=$_GET['pageid'];
    	$query="SELECT * from page WHERE id='$pagetitle'";
    	$pages=$db->select($query);
    	if($pages){
    		while ($result=$pages->fetch_assoc()) {
    			?>

    
	<title><?php echo $result['name']."-".TITLE;  ?></title>

    			<?php
    		}
    	}
    }
    elseif(isset($_GET['id'])){
    	$pagetitle=$_GET['id'];
    	$query="SELECT * from post WHERE id='$pagetitle'";
    	$pages=$db->select($query);
    	if($pages){
    		while ($result=$pages->fetch_assoc()) {
    			?>

    
	<title><?php echo $result['title']."-".TITLE;  ?></title>

    			<?php
    		}
    	}

    }
    else{
    	?>

    	<title><?php echo $fm->title(); ?></title>
    	<?php
    }

	 ?>
   <?php include 'scripts/meta.php'; ?>

	<?php include 'scripts/css.php'; ?>


	<?php include 'scripts/javascript.php'; ?>

</head>

<body>
	<div class="headersection templete clear">
		<a href="#">

			<div class="logo">
				<?php
				$query="SELECT * from title_slogan where id=1";
				$title=$db->select($query);
				if($title){
					while($result=$title->fetch_assoc()){
						?>
										<img src="<?php echo substr($result['logo'],3); ?>" alt="Logo"/>
				<h2><?php echo $result['title']; ?></h2>
				<p><?php echo $result['slogan'] ?></p>
					<?php }} ?>

			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php
				$query="SELECT * from social where id=1";
				$social=$db->select($query);
				if($social){
					while($result=$social->fetch_assoc()){
						?>   
						<a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
						<a href="<?php echo $result['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
						<a href="<?php echo $result['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
						<a href="<?php echo $result['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
					<?php }} ?>
					</div>
					<div class="searchbtn clear">
						<form action="search.php" method="get">
							<input type="text" name="search" placeholder="Search keyword..."/>
							<input type="submit" name="submit" value="Search"/>
						</form>
					</div>
				</div>
			</div>
			<div class="navsection templete">
				                <?php
                  $path=$_SERVER['SCRIPT_FILENAME'];
		             $currentpage=basename($path,'.php');
		             

                 ?>
				<ul>
					<li><a 
                <?php if($currentpage=='index'){ echo 'id="active"';} ?>

					 href="index.php">Home</a></li>
					<?php 
                             $pagesqr="SELECT * from page";
                             $pages=$db->select($pagesqr);
                             while($result=$pages->fetch_assoc()){
                                ?>  

                                <li><a
                                	<?php
                                	if(isset($_GET['pageid']) && $_GET['pageid']==$result['id']){
                                		echo 'id="active"';
                                	}

                                	 ?>


                                     
                                 href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
                             
                            <?php }?>
					<li><a   <?php if($currentpage=='contact'){ echo 'id="active"';} ?> href="contact.php">Contact</a></li>
				</ul>
			</div>


