<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
        <ul>
            <?php 
                $query = "SELECT * FROM tbl_category ORDER BY id DESC";
                $category = $db->select($query);
                if($category){
                    while($value = $category->fetch_assoc()){
            ?>
            <li><a href="posts.php?category=<?php echo $value['id']; ?>"><?php echo $value["name"]; ?></a></li>
            <?php } ?>
            <?php 
                }else{
                    echo "Category Not found";
                } 
            ?>
        </ul>
    </div>

    <div class="samesidebar clear">
        <h2>Latest articles</h2>
        <?php 
            $query = "SELECT * FROM tbl_post ORDER BY id LIMIT 3 ";
            $post = $db->select($query);
            if($post){
                while($result = $post->fetch_assoc()){
        ?>
        <div class="popular clear">
            <h3><a href="post.php?id=<?php echo $result['id'] ?>"><?php echo $result["title"]; ?></a></h3>
            <a href="#"><img src="admin/<?php echo $result['image'] ?>" alt="<?php $result["title"]; ?>" /></a>
            <p><?php echo $fm->shortenText($result["body"], 80); ?></p>
        </div>
        <?php } ?>
        <?php }
        else{
            echo "Post Not found!";
        }
        ?>

    </div>

</div>