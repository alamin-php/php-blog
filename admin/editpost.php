<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
    <?php 
            if(isset($_GET['editpostid']) AND $_GET['editpostid'] !=NULL){
                $id = $_GET['editpostid'];
            }
        ?>
    <div class="box round first grid">
        <h2>Add New Post</h2>
        <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["update"])){

                        $title = $fm->validation($_POST["title"]);
                        $cat = $fm->validation($_POST["cat"]);
                        $body = $fm->validation($_POST["body"]);
                        $tags = $fm->validation($_POST["tags"]);
                        $author = $fm->validation($_POST["author"]);
    
                        $title = mysqli_real_escape_string($db->link, $title);
                        $cat = mysqli_real_escape_string($db->link, $cat);
                        $body = mysqli_real_escape_string($db->link, $body);
                        $tags = mysqli_real_escape_string($db->link, $tags);
                        $author = mysqli_real_escape_string($db->link, $author);
    
                        $permited = array("jpg", "jpeg", "png");
                        $file_name = $_FILES["image"]["name"];
                        $file_size = $_FILES["image"]["size"];
                        $file_tmp_name = $_FILES["image"]["tmp_name"];
    
                        $divi = explode(".", $file_name);
                        $file_ext = strtolower(end($divi));
                        $unique_image = substr(md5(time()), 0, 10).".".$file_ext;
                        $uploaded_image = "upload/".$unique_image;
    
                        if($title == "" || $cat == "" || $body == "" || $tags == "" || $author == ""){
                            echo "<span class='error'>Field must not be empty!</span>";
                        }else{
                            move_uploaded_file($file_tmp_name, $uploaded_image);
                            $query = "INSERT INTO tbl_post (title, cat, body, tags, author, image) VALUES ('$title','$cat','$body','$tags','$author','$uploaded_image')";
                            $postinset = $db->insert($query);
                            if($postinset){
                                echo "<span class='success'>Post Inserted Successfully!</span>";
                            }else{
                                echo "<span class='error'>Post Not Insert!</span>";
                            }
                        }
                    }

                ?>


        <div class="block">
            <?php 
                        $query = "SELECT * FROM tbl_post WHERE id='$id'";
                        $post = $db->select($query);
                        if($post){
                            while($result = $post->fetch_assoc()){
                    ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $result['title']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cat">
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
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"><?php echo $result['body']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" value="<?php echo $result['tags']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo $result['author']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="update" Value="Update" />
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