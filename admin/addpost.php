<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["submit"])){

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
                 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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
                                            while($value = $category->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value["name"]; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Post Tags..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" placeholder="Enter Post Author..." class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    <!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include "inc/footer.php"; ?>