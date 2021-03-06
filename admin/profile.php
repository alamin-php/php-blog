<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Profile</h2>
                <?php 
                   $userid = Session::get('userId');
                ?>
                <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["submit"])){

                        $name = $fm->validation($_POST["name"]);
                        $email = $fm->validation($_POST["email"]);
                        $details = $_POST["details"];
    
                        $name = mysqli_real_escape_string($db->link, $name);
                        $email = mysqli_real_escape_string($db->link, $email);
                        $details = mysqli_real_escape_string($db->link, $details);

                        $mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
                        $mailCheck = $db->select($mailquery);
    
                        if($name == "" || $email == "" || $details == ""){
                            echo "<span class='error'>Field must not be empty!</span>";
                        }elseif($mailCheck != false){
                            $query = "UPDATE tbl_user SET name = '$name',details = '$details' WHERE id = '$userid'";
                            $update_row = $db->update($query);
                            if($update_row){
                                echo "<span class='success'>Profile Updated Successfully!</span>";
                            }else{
                                echo "<span class='error'>Profile Not update!</span>";
                            }
                        }else{
                            $query = "UPDATE tbl_user SET name = '$name',email = '$email',details = '$details' WHERE id = '$userid'";
                            $update_row = $db->update($query);
                            if($update_row){
                                echo "<span class='success'>Profile Updated Successfully!</span>";
                            }else{
                                echo "<span class='error'>Profile Not update!</span>";
                            }
                        }
                    }

                ?>
                <div class="block">               
                 <form action="" method="post">
                     <?php 
                        $query = "SELECT * FROM tbl_user WHERE id = '$userid'";
                        $users = $db->select($query);
                        if($users){
                            while($result = $users->fetch_assoc()){
                     ?>
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" readonly value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>                      
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details"><?php echo $result['details']; ?></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    <?php } ?>
                    <?php } ?>
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