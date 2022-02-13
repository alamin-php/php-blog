<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
				<?php 
					if(isset($_GET['delslider'])){
						$id = $_GET['delslider'];

						$query = "SELECT image FROM tbl_slider WHERE id='$id'";
						$getImage = $db->select($query);
						if($getImage){
							while($data = $getImage->fetch_assoc()){
								$delImage = $data['image'];
								if($delImage != NULL){
									unlink($delImage);
								}
							}
						}	
                        
                        $query1 = "DELETE FROM tbl_slider WHERE id='$id'";
								$delslider = $db->delete($query1);
								if($delslider){
									echo "<span class='success'>Slider Delete Successfully!</span>";
								}else{
									echo "<span class='error'>Slider Not Deleted!</span>";
								}
					}
				?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial</th>
							<th>Post Title</th>
							<th>Image</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;
							$query = "SELECT * FROM tbl_slider
							ORDER BY id DESC";
							$sliders = $db->select($query);
							if($sliders){
								while($slider = $sliders->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td class="center"><?php echo $i; ?></td>
							<td class="center"><?php echo $slider["title"]; ?></td>
							<td class="center"><img class="table-image" src="<?php echo $slider["image"] ?>" alt="" srcset=""></td>
                            <td class="center">
                                <?php
                                    if($slider["status"] == '0'){
                                        echo "Active";
                                    }elseif($slider["status"] == '1'){
                                        echo "Inactive";
                                    }
                                ?>
                            </td>
							<td class="center">
								<a href="viewpost.php?viewpostid=<?php echo $slider['id']; ?>">View</a>
                                <?php if(Session::get("userRole") == "0") : ?>
								||
								<a href="editslider.php?sliderid=<?php echo $slider['id']; ?>">Edit</a> ||
								<a onclick="return confirm('Are you sure to delete?')" href="?delslider=<?php echo $slider['id'] ?>">Delete</a>
                                <?php endif; ?>

							</td>
						</tr>
						<?php } ?>
						<?php } ?>
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