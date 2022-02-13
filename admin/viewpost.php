<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
    <?php 
        if(isset($_GET['viewpostid'])){
            $id = $_GET['viewpostid'];
        }
    ?>
    <div class="box round first grid">
        <h2>View Post</h2>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["view"])){
                echo "<script>window.location = 'postlist.php';</script>";
            }

        ?>


        <div class="block">
            <?php 
                $query = "SELECT * FROM tbl_post WHERE id=$id";
                $post = $db->select($query);
                if($post){
                while($result = $post->fetch_assoc()){
            ?>
            <form action="" method="post"
                enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" readonly name="title" value="<?php echo $result['title']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select readonly id="select" name="cat">
                                <option value="">Category One</option>
                                <?php 
                                        $query = "SELECT * FROM tbl_category ORDER BY id DESC";
                                        $category = $db->select($query);
                                        if($category){
                                            while($cat = $category->fetch_assoc()){
                                    ?>
                                <option 
                                    <?php 
                                    if($result['cat'] == $cat['id']){?> selected="selected" 
                                    <?php } ?> 
                                    value="<?php echo $cat['id']; ?>"><?php echo $cat["name"]; ?>
                                </option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><img height="80px" width="200px" src="<?php echo $result["image"] ?>" alt="" srcset=""></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea readonly class="tinymce" name="body"><?php echo $result['body']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" readonly name="tags" value="<?php echo $result['tags']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" readonly name="author" value="<?php echo $result['author']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="view" Value="Ok" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
});
</script>
<?php include "inc/footer.php"; ?>