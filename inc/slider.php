<div class="slidersection templete clear">
        <div id="slider">
            <?php 
                         $query="SELECT * FROM slider order by id limit 5";


                        $slider=$db->select($query);
                        if($slider){
                            while($result=$slider->fetch_assoc()){
                         ?>
            <a href="#"><img src="<?php echo substr($result['image'],3); ?>" alt="Slider image" title="<?php echo $result['title']; ?>" /></a>
        <?php }} ?>
        </div>

</div>