<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Slider</h2>
               <div class="block copyblock"> 
                   <?php
                   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
                       $title = $fm->validation($_POST['title']);

                       $parmited = array("jpg","jpeg","png");
                       $file_name = $_FILES['image']["name"];
                       $file_size = $_FILES['image']["size"];
                       $file_tmp_name = $_FILES['image']["tmp_name"];

                       $divi = explode(".", $file_name);
                       $file_extn = strtolower(end($divi));
                       $unique_file_name = substr(md5(time()), 0, 10).'.'.$file_extn;
                       $uploaded_foldar = "upload/".$unique_file_name;

                       if($title == "" || $file_name == ""){
                        echo "<span class='error'>Field must not be empty!</span>";
                     }elseif($file_size > 1048576){
                         echo "<span class='error'>File size must be less then 1 MB!</span>";
                     }elseif(in_array($file_extn, $parmited) == false){
                         echo "<span class='error'>You can upload Only:- ".implode(", ", $parmited)."</span>";
                     }else{
                         move_uploaded_file($file_tmp_name, $uploaded_foldar);
                         $title = mysqli_real_escape_string($db->link, $title);
                         $query = "INSERT INTO tbl_slider (title, image) VALUES('$title', '$uploaded_foldar')";
                         $sliderinsert = $db->insert($query);
                         if($sliderinsert){
                             echo "<span class='success'>Slider Inserted Successfully!</span>";
                        }
                    }
                    
                   }
                   ?>
                 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label for="">Sldier Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Slider Title..." class="medium" />
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
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include "inc/footer.php"; ?>