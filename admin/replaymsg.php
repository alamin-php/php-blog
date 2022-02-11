<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
            <?php 
                if(!isset($_GET["msgid"]) || $_GET["msgid"] == NULL){
                    echo "<script>window.location = 'inbox.php';</script>";
                    }else{
                        $id = $_GET["msgid"];
                    }
            ?>
            <div class="box round first grid">
                <h2>Replay Message</h2>
                <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["submit"])){
                        $to      = $fm->validation($_POST["toEmail"]);
                        $from    = $fm->validation($_POST["fromEmail"]);
                        $subject = $fm->validation($_POST["subject"]);
                        $message = $fm->validation($_POST["message"]);

                        $to      = mysqli_real_escape_string($db->link, $to);
                        $from    = mysqli_real_escape_string($db->link, $from);
                        $subject = mysqli_real_escape_string($db->link, $subject);
                        $message = mysqli_real_escape_string($db->link, $message);

                        if($to == "" || $from == "" || $subject == "" || $message == ""){
                            echo "<span style='color:red; font-size:18px'>Field must not be empty !</span>";
                        }else{
                            $sendmail = mail($to,$subject,$message,$from);
                            if($sendmail){
                                echo "<span style='color:success; font-size:18px'>Message send successfully !</span>";
                            }else{
                                echo "<span style='color:red; font-size:18px'>Mail not send.. !</span>";
                            }
                        }
                    }

                ?>
                <div class="block">               
                 <form action="" method="post">
                     <?php 
                        $query = "SELECT * FROM tbl_contact WHERE id='$id'";
                        $msg = $db->select($query);
                        if($msg){
                            while($result = $msg->fetch_assoc()){

                     
                     ?>
                    <table class="form">                  
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" name="toEmail" readonly value="<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>                    
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail" class="medium" />
                            </td>
                        </tr>                    
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px; min-height: 200px">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message"></textarea>
                            </td>
                        </tr>
                        
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Replay" />
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