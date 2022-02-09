<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
				<?php 
					if(isset($_GET['delpost'])){
						$id = $_GET['delpost'];

						$query = "DELETE FROM tbl_post WHERE id='$id'";
						$delpost = $db->delete($query);
						if($delpost){
							echo "<span class='success'>Post Deleted Successfully!</span>";
						}else{
							echo "<span class='error'>Post Not Delete!</span>";
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
							ORDER BY tbl_post.title DESC";
							$posts = $db->select($query);
							if($posts){
								while($post = $posts->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $post["title"]; ?></td>
							<td><?php echo $fm->shortenText($post["body"], 30); ?></td>
							<td class="center"> <?php echo $post["name"] ?></td>
							<td class="center"> <img width="60px" height="40px" src="<?php echo $post["image"] ?>" alt="" srcset=""></td>
							<td><a href="editpost.php?editpostid=<?php echo $post['id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?delpost=<?php echo $post['id'] ?>">Delete</a></td>
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