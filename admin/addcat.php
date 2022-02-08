<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                   <?php
                   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
                       $name = $fm->validation($_POST['name']);
                       if(empty($name)){
                           echo "<span class='error'>Field must not be empty!</span>";
                        }else{
                            $name = mysqli_real_escape_string($db->link, $name);
                            $query = "INSERT INTO tbl_category (name) VALUES('$name')";
                            $catinsert = $db->insert($query);
                            if($catinsert){
                                echo "<span class='success'>Category Inserted Successfully!</span>";
                           }
                       }
                   }
                   ?>
                 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
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