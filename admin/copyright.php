<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if(isset($_POST["update"])){
                        $note = $_POST["copyright"];

                        $note = mysqli_real_escape_string($db->link, $note);

                        if($note == ""){
                            echo "<span class='error'>Field must not be empty !</span>";
                        }else{
                            $query = "UPDATE tbl_footer SET note='$note' WHERE id='1'";
                            $update_row = $db->update($query);
                            if($update_row){
                                echo "<span class='success'>Footer Note Updated Successfully!</span>";
                            }else{
                                echo "<span class='error'>Footer Note Not Update !</span>";
                            }
                        }
                    }
                }
                ?>
                <div class="block copyblock"> 
                <?php 
                        $query = "SELECT * FROM tbl_footer WHERE id='1'";
                        $footer = $db->select($query);
                        if($footer){
                        while($value = $footer->fetch_assoc()){
                    ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $value['note'] ?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
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
<?php include "inc/footer.php"; ?>