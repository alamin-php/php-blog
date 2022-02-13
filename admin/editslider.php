<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		<?php 
            if(isset($_GET['sliderid'])){
                $id = $_GET['sliderid'];
            }
        ?>
            <div class="box round first grid">
                <h2>Add New Slider</h2>
               <div class="block copyblock"> 
                   <?php
                   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])){
                       $title = $fm->validation($_POST['title']);
                       $status = $_POST['status'];
                       $title = mysqli_real_escape_string($db->link, $title);
                       $status = mysqli_real_escape_string($db->link, $status);

                       $parmited = array("jpg","jpeg","png");
                       $file_name = $_FILES['image']["name"];
                       $file_size = $_FILES['image']["size"];
                       $file_tmp_name = $_FILES['image']["tmp_name"];

                       $divi = explode(".", $file_name);
                       $file_extn = strtolower(end($divi));
                       $unique_file_name = substr(md5(time()), 0, 10).'.'.$file_extn;
                       $uploaded_foldar = "upload/".$unique_file_name;


                       if($title == ""){
                           echo "<span class='error'>Field must not be empty!</span>";
                        }

                        if(!empty($file_name)){
                            if($file_size > 1048576){
                                echo "<span class='error'>File size must be less then 1 MB!</span>";
                            }elseif(in_array($file_extn, $parmited) == false){
                                echo "<span class='error'>You can upload Only:- ".implode(", ", $parmited)."</span>";
                            }else{
                                // for old image delete 
                                $query1 = "SELECT image FROM tbl_slider WHERE id = '$id'";
                                    $getImage = $db->select($query1);
                                    if($getImage){
                                        while($delimage = $getImage->fetch_assoc()){
                                        $image = $delimage['image'];
                                        unlink($image);
                                    }
                                }
                                move_uploaded_file($file_tmp_name, $uploaded_foldar);
                                $query = "UPDATE tbl_slider SET title='$title', image='$uploaded_foldar', status='$status' WHERE id = '$id'";
                                $sliderinsert = $db->insert($query);
                                if($sliderinsert){
                                    echo "<span class='success'>Slider Updated Successfully!</span>";
                               }else{
                                    echo "<span class='error'>Slider Not Updated!</span>";
                               }
                           }
                        }else{
                            $query = "UPDATE tbl_slider SET title='$title', status='$status' WHERE id = '$id'";
                            $sliderinsert = $db->insert($query);
                            if($sliderinsert){
                                echo "<span class='success'>Slider Updated Successfully!</span>";
                            }else{
                               echo "<span class='error'>Slider Not Updated!</span>";
                           }
                        }
                   }
                   ?>
                 <form action="" method="post" enctype="multipart/form-data">
                 <?php 
                    $query = "SELECT * FROM tbl_slider WHERE id = '$id'";
                    $slider = $db->select($query);
                    if($slider){
                        while($result = $slider->fetch_assoc()){
                            
                 ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <label for="">Sldier Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $result["title"] ?>" class="medium" />
                            </td>
                        </tr>					
                        <tr>
                            <td>
                                
                            </td>
                            <td>
                            <img height="150px" width="280px" src="<?php echo $result["image"] ?>" alt="" srcset="">
                            </td>
                        </tr>					
                        <tr>
                            <td>
                                <label for="">Sldier Iamge</label>
                            </td>
                            <td>
                                <input type="file" name="image" class="medium" />
                            </td>
                        </tr>					
                        <tr>
                            <td>
                                <label for="">Status</label>
                            </td>
                            <td>
                                <input type="radio" name="status"  value="0" <?php if($result['status'] == '0'){echo "checked";} ?>/>Active
                                <input type="radio" name="status" value="1" <?php if($result['status'] == '1'){echo "checked";} ?>/>Inactive
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