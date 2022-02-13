<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Full Name</th>
							<th>User Name</th>
							<th>Email Address</th>
							<th>Deatails</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(isset($_GET['deluser'])){
								$deluser = $_GET['deluser'];
								$query = "DELETE FROM tbl_user WHERE id='$deluser'";
								$deluser = $db->delete($query);
								if($deluser){
									echo "<span class='success'>Category Delete Successfully!</span>";
								}else{
									echo "<span class='error'>Category Not Deleted!</span>";
								}
							}
						?>
						<?php 
							$query = "SELECT * FROM tbl_user ORDER BY id DESC";
							$users = $db->select($query);
							if($users){
								$i=0;
								while($result = $users->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result["name"]; ?></td>
							<td><?php echo $result["username"]; ?></td>
							<td><?php echo $result["email"]; ?></td>
							<td><?php echo $fm->shortenText($result["details"], 50); ?></td>
							<td>
                                <?php 
                                    if($result["role"] == 0){
                                        echo "Admin";
                                    }elseif($result["role"] == 1){
                                        echo "Author";
                                    }elseif($result["role"] == 2){
                                        echo "Editor";
                                    }
                                ?>
                            </td>
							<td><a href="viewuser.php?userid=<?php echo $result['id']; ?>">View</a> ||
                             <a onclick="return confirm('Are you sure to delete');" href="?deluser=<?php echo $result['id']; ?>">Delete</a></td>
						</tr>
						<?php } ?>
						<?php }else{
							echo "No data found";
						} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include "inc/footer.php"; ?>