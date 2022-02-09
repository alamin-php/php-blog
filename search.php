<?php include "inc/header.php"; ?>
<?php 
	if(isset($_GET["search"]) || $_GET["search"] !=NULL || !empty($_GET["search"])){
		$search = $_GET["search"];
	}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
<?php 
	$query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%' ";
	$result = $db->select($query);
	if($result){
		while($post = $result->fetch_assoc()){
			if(!$post['cat'] == NULL){
?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
				<h4><?php echo $fm->formatDate($post['date']); ?>, By <a href="#"><?php echo $post['author']; ?></a></h4>
				<img src="admin/<?php echo $post['image']; ?>" alt="post image"/>

					<?php echo $fm->shortenText($post['body'], 400); ?>

				<div class="readmore clear">
					<a href="post.php?id=<?php echo $post['id']; ?>">Read More</a>
				</div>
			</div>
			<?php } ?>
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