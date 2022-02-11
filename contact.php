<?php include "inc/header.php"; ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $fname = mysqli_real_escape_string($db->link, $fname);
        $lname = mysqli_real_escape_string($db->link, $lname);
        $email = mysqli_real_escape_string($db->link, $email);
        $message = mysqli_real_escape_string($db->link, $message);
        $error = $msg = "";

        if($fname == '' AND empty($fname)){
            $error = "First name must not be empty!";
        }
        elseif($lname == '' AND empty($lname)){
            $error = "Last name must not be empty!";
        }
        elseif($email == '' AND empty($email)){
            $error = "Email name must not be empty!";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "Email format is Invalid!";
        }
        elseif($message == '' AND empty($message)){
            $error = "Message name must not be empty!";
        }else{
            $query = "INSERT INTO tbl_contact(fname,lname,email,message) VALUES ('$fname','$lname', '$email','$message')";
            $insert_row = $db->insert($query);
            if($insert_row){
                $msg = "Message send successfully";
            }else{
                $error = "Message send faild !";
            }
        }
    }
?>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <h2>Contact us</h2>
            <?php 
                if(isset($error)){
                    echo "<span style='color:red; font-size: 18px;'>$error</span>";
                } 
                if(isset($msg)){
                    echo "<span style='color:green; font-size: 18px;'>$msg</span>";
                }
            ?>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>Your First Name:</td>
                        <td>
                            <input type="text" name="fname" placeholder="Enter first name"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Your Last Name:</td>
                        <td>
                            <input type="text" name="lname" placeholder="Enter Last name"/>
                        </td>
                    </tr>

                    <tr>
                        <td>Your Email Address:</td>
                        <td>
                            <input type="text" name="email" placeholder="Enter Email Address"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Your Message:</td>
                        <td>
                            <textarea name='message'></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Submit" />
                        </td>
                    </tr>
                </table>
                <form>
        </div>

    </div>
    <?php include "inc/sidebar.php"; ?>
</div>
<?php include "inc/footer.php"; ?>