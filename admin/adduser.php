<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php 
    if(!Session::get("userRole") == '0'){
        echo "<script>window.location = 'index.php';</script>";
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
                   <?php
                   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
                       $username  = $fm->validation($_POST['username']);
                       $password  = md5($_POST['password']);
                       $email      = $_POST['email'];
                       $role      = $_POST['role'];
                       $username  = strtolower($username);

                       $usernameQuery = "SELECT * FROM tbl_user WHERE username = '$username'";
                       $userCheck = $db->select($usernameQuery);

                       $emailQuery = "SELECT * FROM tbl_user WHERE email = '$email'";
                       $emailCheck = $db->select($emailQuery);

                       if($username == "" || $password == "" || $role == "" || $email == ""){
                           echo "<span class='error'>Field must not be empty!</span>";
                        }elseif($userCheck != false){
                            echo "<span class='error'>Username Already Exist!</span>";
                        }elseif($emailCheck != false){
                            echo "<span class='error'>Email Already Exist!</span>";
                        }else{
                            $username = mysqli_real_escape_string($db->link, $username);
                            $password = mysqli_real_escape_string($db->link, $password);
                            $role = mysqli_real_escape_string($db->link, $role);
                            $query = "INSERT INTO tbl_user (username,password,role,email) VALUES('$username', '$password','$role','$email')";
                            $catinsert = $db->insert($query);
                            if($catinsert){
                                echo "<span class='success'>User Created Successfully!</span>";
                           }
                       }
                   }
                   ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter Userame..." class="medium" />
                            </td>
                        </tr>				
                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>				
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" placeholder="Enter Email address..." class="medium" />
                            </td>
                        </tr>				
                        <tr>
                            <td>
                                <label>User Role</label>
                            </td>
                            <td>
                                <select name="role" id="" class="medium" >
                                    <option value="">Select One</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                 </form>
                </div>
            </div>
        </div>
<?php include "inc/footer.php"; ?>