<div class="sidebar clear">
			<div class="samesidebar clear">


				<h2>Categories</h2>

			      	<ul>


				<?php
					  $querycat="SELECT * from category";
				      $category=$db->select($querycat);
				     if($category){
					while($cat=$category->fetch_assoc()){

					 ?>
	
						<li><a href="posts.php?category=<?php echo $cat['id'];?>"><?php echo $cat['name']; ?></a></li>
                   
                   <?php 
			    } 
			} 

				else{
					echo "<li>No category  available !!</li>";
				}
				?>
					

					</ul>
			</div>
			
			<!-- sidebar section start -->
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
				  <?php
				  $catqr="SELECT * from post limit 5";
				      $catpost=$db->select($catqr);
				     if($catpost){
					while($row=$catpost->fetch_assoc()){
              
					 ?>

					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $row['id']; ?>"><?php  echo $row['title'] ?></a></h3>
						 <a href="#"><img src="images/<?php  echo 
				 	$row['image']; ?>" alt="post image"/></a>
					<p>
				<?php  echo $fm->postformater($row['body'],120) ?>
				</p>
					</div>
					  <?php 
			          } 
			             } 

			     	else{
					echo "<li>No category  available !!</li>";
			      	}
				?>


			</div>
			<!-- sidebar section end -->
			
		</div>