<?php include "config/config.php"; ?>
<?php include "lib/Database.php"; ?>
<?php include "helpers/Format.php"; ?>
<?php include "inc/header.php"; ?>
<?php include "inc/slider.php"; ?>

<?php 
	$db = new Database();
	$fm = new Format();
?>
<?php 
	$per_page = 3;
	if(isset($_GET["page"])){
		$page = $_GET["page"];
	}else{
		$page =1;
	}
	$start_from = ($page-1) * $per_page;
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
<?php 
	$query = "SELECT * FROM tbl_post ORDER BY id DESC LIMIT $start_from, $per_page";
	$result = $db->select($query);
	if($result){
		while($post = $result->fetch_assoc()){
?>
			<div class="samepost clear">
				<h2><a href="post.php?postid=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
				<h4><?php echo $fm->formatDate($post['date']); ?>, By <a href="#"><?php echo $post['author']; ?></a></h4>
				 <a href="#"><img src="admin/upload/<?php echo $post['image']; ?>" alt="post image"/></a>
				<p>
					<?php echo $fm->shortenText($post['body'], 400); ?>
				</p>
				<div class="readmore clear">
					<a href="post.php">Read More</a>
				</div>
			</div>
		<?php }?>
		<?php
			$query = "SELECT * FROM tbl_post";
			$result = $db->select($query);
			$total_rows = mysqli_num_rows($result);
			$total_pages = ceil($total_rows/$per_page);
		
			echo "<span class='pagination'><a href='index.php?page=1'>First Page</a>";
			for($i=1; $i <= $total_pages; $i++){
				echo "<a href='index.php?page=$i'>$i</a>";
			}
			echo "<a href='index.php?page=$total_pages'>Last Page</a></span>";
		
	}else{
		header("Location:404.php");
	} 
	?>

		</div>
		<?php include "inc/sidebar.php"; ?>
	</div>
<?php include "inc/footer.php"; ?>