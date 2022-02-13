<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
				<?php 
					if(isset($_GET['delpost'])){
						$id = $_GET['delpost'];

						$query = "SELECT image FROM tbl_post WHERE id='$id'";
						$getImage = $db->select($query);
						if($getImage){
							while($data = $getImage->fetch_assoc()){
								$delImage = $data['image'];
								if($delImage != NULL){
									unlink($delImage);
								}
							}
						}					
					}
				?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial</th>
							<th>Post Title</th>
							<th>Description</th>
							<th>Category</th>
							<th>Tags</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;
							$query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post 
							INNER JOIN tbl_category
							ON tbl_post.cat = tbl_category.id
							ORDER BY tbl_post.id DESC";
							$posts = $db->select($query);
							if($posts){
								while($post = $posts->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td class="center"><?php echo $i; ?></td>
							<td class="center"><?php echo $post["title"]; ?></td>
							<td class="center"><?php echo $fm->shortenText($post["body"], 75); ?></td>
							<td class="center"><?php echo $post["name"] ?></td>
							<td class="center"><?php echo $post["tags"] ?></td>
							<td class="center"><img class="table-image" src="<?php echo $post["image"] ?>" alt="" srcset=""></td>
							<td class="center">
								<a href="viewpost.php?viewpostid=<?php echo $post['id']; ?>">View</a> 
								<?php if(Session::get('userId') == $post['userid'] || Session::get('userRole') == '0' ) :?>
								||
								<a href="editpost.php?editpostid=<?php echo $post['id']; ?>">Edit</a> ||
								<a onclick="return confirm('Are you sure to delete?')" href="deletepost.php?delpost=<?php echo $post['id'] ?>">Delete</a>
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