<div class="slidersection templete clear">
    <div id="slider">
        <?php 
            $query = "SELECT * FROM tbl_slider WHERE status = '0' LIMIT 5";
            $slider = $db->select($query);
            while($result =  $slider->fetch_assoc()){?>
            
            <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="nature 1" title="<?php echo $result['title']; ?>" /></a>
            
            <?php

            }
        ?>

    </div>
</div>