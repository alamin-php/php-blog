<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View User Details</h2>
                <?php 
							if(isset($_GET['userid'])){
								$userid = $_GET['userid'];
							}
						?>
                <?php 
                   if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["submit"])){
                    echo "<script>window.location = 'userlist.php';</script>";

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
                                <input type="text" name="name" readonly value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>                      
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" readonly value="<?php echo $result['email']; ?>" class="medium" />
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
                                <input type="submit" name="submit" Value="Ok" />
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