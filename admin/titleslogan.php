<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        if(isset($_POST["submit"])){
                            $title = $fm->validation($_POST['title']);
                            $slogan = $fm->validation($_POST['slogan']);

                            $title = mysqli_real_escape_string($db->link, $title);
                            $slogan = mysqli_real_escape_string($db->link, $slogan);

                            $permited = array('jpg', 'jpeg', 'png');
                            $file_name = $_FILES['logo']['name'];
                            $file_size = $_FILES['logo']['size'];
                            $file_tmp_name = $_FILES['logo']['tmp_name'];

                            $divi = explode(".", $file_name);
                            $file_extn = strtolower(end($divi));
                            $unique_name = substr(md5(time()), 0, 10).'.'.$file_extn;
                            $uploaded_logo = 'upload/'.$unique_name;
                            

                            if($title == "" || $slogan == ""){
                                echo "<span class='error'>Field must not be empty.</span>";
                            }else{
                                if(!empty($file_name)){
                                    if($file_size > 1048576){
                                        echo "<span class='error'>File size must be less then 1MB!</span>";
                                    }elseif(in_array($file_extn, $permited) == false){
                                        echo "<span class='error'>You can uplod only:-".implode(", ", $permited)."</span>";
                                    }else{
                                        $query1 = "SELECT logo FROM tbl_slogan WHERE id='1'";
                                        $result_row = $db->select($query1);
                                        if($result_row){
                                            while($getLogo = $result_row->fetch_assoc()){
                                                $delLogo = $getLogo['logo'];
                                                unlink($delLogo);
                                            }
                                        }
                                        move_uploaded_file($file_tmp_name, $uploaded_logo);
                                        $query = "UPDATE tbl_slogan SET title='$title', slogan='$slogan', logo='$uploaded_logo' WHERE id='1'";
                                        $update_row = $db->update($query);
                                        if($update_row){
                                            echo "<span class='success'>Data Updated Successfully.</span>";
                                        }else{
                                            echo "<span class='error'>Data Not Updated.</span>";
                                        }
                                    }
                                }
                                else{
                                    $query = "UPDATE tbl_slogan SET title='$title', slogan='$slogan' WHERE id='1'";
                                    $update_row = $db->update($query);
                                    if($update_row){
                                        echo "<span class='success'>Data Updated Successfully.</span>";
                                    }else{
                                        echo "<span class='error'>Data Not Updated.</span>";
                                    }
                                }
                            }
                        }
                    }
                
                ?>
                <div class="block sloginblock">  
                <?php 
                    $query = "SELECT * FROM tbl_slogan WHERE id='1'";
                    $result = $db->select($query);
                    if($result){
                        while($slogan = $result->fetch_assoc()){
                ?>             
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $slogan['title'] ?>"  class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" name="slogan" value="<?php echo $slogan['slogan'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <img height="100px" width="100px" src="<?php echo $slogan["logo"] ?>" alt="" srcset="">
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo" />
                            </td>
                        </tr>		 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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