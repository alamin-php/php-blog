<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                   <?php
                   if($_GET['catid']){
                       $id = $_GET['catid'];
                   }
                   $query = "SELECT * FROM tbl_category WHERE id=$id";
                   $getCat = $db->select($query);

                   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])){
                       $name = $fm->validation($_POST['name']);
                       if(empty($name)){
                           echo "<span class='error'>Field must not be empty!</span>";
                        }else{
                            $name = mysqli_real_escape_string($db->link, $name);
                            $query = "UPDATE tbl_category SET name='$name' WHERE id=$id";
                            $catupdate = $db->insert($query);
                            if($catupdate){
                                echo "<span class='success'>Category Update Successfully!</span>";
                           }
                       }
                   }
                   while($value = $getCat->fetch_assoc()){
                   ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $value['name'] ?>" class="medium" />
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
                </div>
            </div>
        </div>
<?php include "inc/footer.php"; ?>