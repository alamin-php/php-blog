<?php include "inc/header.php"; ?>

<?php 
	if(!isset($_GET["id"]) || $_GET["id"] == NULL){
		header("Location: 404.php");
	}else{
		$id =  $_GET["id"];
	}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php 
					$query = "SELECT * FROM tbl_post WHERE id=$id";
					$post = $db->select($query);
					if($post){
						while($result = $post->fetch_assoc()){
							
				?>
				<h2><?php echo $result["title"]; ?></h2>
				<h4><?php echo $fm->formatDate($result["date"]) ?>, By <?php echo $result["author"]; ?></h4>
				<img src="admin/<?php echo $result['image']; ?>" alt="MyImage"/>
				<p><?php echo $result["body"]; ?></p>

				<?php } ?>

				<?php }else{
					header("Location: 404.php");
				}

				?>
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
					<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
					<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
					<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
					<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
					<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
				</div>
	</div>

		</div>

		<?php include "inc/sidebar.php"; ?>
	</div>
	<?php include "inc/footer.php"; ?>