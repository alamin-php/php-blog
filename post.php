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


				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
<?php 
	$catid = $result['cat'];
	$relatedQuery = "SELECT * FROM tbl_post WHERE cat = '$catid' ORDER BY rand() LIMIT 6";
	$relatedPost = $db->select($relatedQuery);
	if($relatedPost){
		while($rresult = $relatedPost->fetch_assoc()){?>
		
		<a href="post.php?id=<?php echo $rresult['id'];  ?>"><img src="admin/<?php echo $rresult['image'] ?>" alt="post image"/></a>
		
		<?php

		}
	}
?>

				</div>

				<?php } ?>

				<?php }else{
				header("Location: 404.php");
				}

				?>
	</div>

		</div>

		<?php include "inc/sidebar.php"; ?>
	</div>
	<?php include "inc/footer.php"; ?>