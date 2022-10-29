        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
        <?php
          $query="SELECT * from footer where id=1";
  $footer=$db->select($query);
  if($footer){
    while($result=$footer->fetch_assoc()){
        ?>    
        <p>
        <?php echo $result['notes'] ?>
        </p>
        <?php }  } ?>
    </div>
</body>
</html>