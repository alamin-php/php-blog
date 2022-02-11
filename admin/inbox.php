<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
				<?php 
					if(isset($_GET["seenid"])){
						$id = $_GET["seenid"];
						$query = "UPDATE tbl_contact SET status='1' WHERE id='$id'";
						$update_row = $db->update($query);
						if($update_row){
							echo "<span class='success'>Message sent in the seen Box</span>";
						}else{
							echo "<span class='error'>Someting wrong in there !</span>";
						}
					}

				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$i=0;
						$query = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC";
						$rows = $db->select($query);
						if($rows){
							while($result = $rows->fetch_assoc()){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $result['id']; ?>"><?php echo $result['fname']; ?> <?php echo $result['lname']; ?></a></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $result['message']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || 
								<a href="replaymsg.php?msgid=<?php echo $result['id']; ?>">Replay</a> || 
								<a onclick="return confirm('Are you sure to Move the Message?')" href="?seenid=<?php echo $result['id']; ?>">Seen</a></td>
						</tr>
						<?php } ?>
						<?php } ?>
					</tbody>
				</table>
               </div>
            </div>
			<div class="box round first grid">
                <h2>Seen Message</h2>
				<?php 
							if(isset($_GET['delid'])){
								$delid = $_GET['delid'];
								$query = "DELETE FROM tbl_contact WHERE id='$delid'";
								$delmsg = $db->delete($query);
								if($delmsg){
									echo "<span class='success'>Message Delete Successfully!</span>";
								}else{
									echo "<span class='error'>Message Not Deleted!</span>";
								}
							}
						?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$i=0;
						$query = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC";
						$rows = $db->select($query);
						if($rows){
							while($result = $rows->fetch_assoc()){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['fname']; ?> <?php echo $result['lname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $result['message']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><a onclick="return confirm('Are you sure to delete?')" href="?delid=<?php echo $result['id']; ?>">Delete</a></td>
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

    $('.datatable').dataTable();message
    setSidebarHeight();
    });
</script>
<?php include "inc/footer.php"; ?>