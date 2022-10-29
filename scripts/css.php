<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">

 <?php 
        $query="SELECT * from  theme where id='1' ";
        $category=$db->select($query);
        while($result=$category->fetch_assoc()){

             if($result['theme']=='default'){?>

<link rel="stylesheet" href="theme/default.css">

<?php } elseif($result['theme']=='green'){?>
	<link rel="stylesheet" href="theme/green.css">


<?php }else{?>

<link rel="stylesheet" href="theme/red.css">

        	<?php
        }
        }
        ?>