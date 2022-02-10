<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if(isset($_POST["update"])){
                        $facebook = $_POST["facebook"];
                        $twitter = $_POST["twitter"];
                        $linkedin = $_POST["linkedin"];
                        $google = $_POST["googleplus"];

                        if($facebook == "" || $twitter == "" || $linkedin == "" ||$facebook == "" ){
                            echo "<span class='error'>Field must not be empty !</span>";
                        }else{
                            $query = "UPDATE tbl_social SET facebook='$facebook', twitter='$twitter', linkedin='$linkedin', google='$google' WHERE id='1'";
                            $update_row = $db->update($query);
                            if($update_row){
                                echo "<span class='success'>Social Media Link Updated Successfully!</span>";
                            }else{
                                echo "<span class='error'>Social Media Link Not Update !</span>";
                            }
                        }
                    }
                }
                ?>
                <div class="block">               
                <form action="" method="post">
                    <?php 
                        $query = "SELECT * FROM tbl_social";
                        $social = $db->select($query);
                        if($social){
                        while($value = $social->fetch_assoc()){
                    ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $value["facebook"] ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $value["twitter"] ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?php echo $value["linkedin"] ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="googleplus" value="<?php echo $value["google"] ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="update" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    <?php } ?>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <?php include "inc/footer.php"; ?>