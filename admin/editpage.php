<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		<?php 
            if(isset($_GET['pageid']) || $_POST['pageid'] !=NULL){
                $pageid = $_GET['pageid'];
            }
        ?>
            <div class="box round first grid">
                <h2>Update Page</h2>
                <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["update"])){

                        $name = $fm->validation($_POST["name"]);
                        $body = $_POST["body"];
    
                        $name = mysqli_real_escape_string($db->link, $name);
                        $body = mysqli_real_escape_string($db->link, $body);
    
                        if($name == "" || $body == ""){
                            echo "<span class='error'>Field must not be empty!</span>";
                        }else{
                            $query = "UPDATE tbl_page SET name='$name', body='$body' WHERE id='$pageid'";
                            $insert_page = $db->insert($query);
                            if($insert_page){
                                echo "<span class='success'>Page Updated Successfully!</span>";
                            }else{
                                echo "<span class='error'>Page Not Update!</span>";
                            }
                        }
                    }

                ?>
                <div class="block"> 
                <?php 
                    $query = "SELECT * FROM tbl_page WHERE id='$pageid'";
                    $pages = $db->select($query);
                    if($pages){
                    while($page =  $pages->fetch_assoc()){
                ?>          
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $page['name'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px; min-height: 200px">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $page['body']; ?></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="update" Value="Update" />
                                <a onclick="return confirm('Are you sure to delete?')" class="btn-back" href="deletepage.php?delpage=<?php echo $page['id']; ?>">Delete</a>
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
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include "inc/footer.php"; ?>