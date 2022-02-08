<?php include "inc/header.php"; ?>
<?php include "inc/slider.php"; ?>

<?php 
	$db = new Database();
	$fm = new Format();
?>
<?php 
	if(isset($_GET["category"])){
		$id = $_GET["category"];
	}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
<?php 
	$query = "SELECT * FROM tbl_post WHERE id =$id ";
	$result = $db->select($query);
	if($result){
		while($post = $result->fetch_assoc()){
?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
				<h4><?php echo $fm->formatDate($post['date']); ?>, By <a href="#"><?php echo $post['author']; ?></a></h4>
				 <a href="#"><img src="admin/upload/<?php echo $post['image']; ?>" alt="post image"/></a>
				<p>
					<?php echo $fm->shortenText($post['body'], 400); ?>
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $post['id']; ?>">Read More</a>
				</div>
			</div>
		<?php }?>
		<?php
		
	}else{
		header("Location:404.php");
	} 
	?>

		</div>
		<?php include "inc/sidebar.php"; ?>
	</div>
<?php include "inc/footer.php"; ?>