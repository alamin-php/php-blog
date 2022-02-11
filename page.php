<?php include "inc/header.php"; ?>
<?php 
	if(!isset($_GET["pageid"]) || $_GET["pageid"] == NULL){
		header("Location: 404.php");
	}else{
		$id = $_GET["pageid"];
	}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php 
				$query = "SELECT * FROM tbl_page WHERE id='$id'";
				$result = $db->select($query);
				if($result){
					while($page = $result->fetch_assoc()){
						
			?>
			<div class="about">
				<h2><?php echo $page["name"]; ?></h2>
				<?php echo $page['body']; ?>
	</div>
	<?php } ?>
	<?php }else{
		header("Location: 404.php");
		} 
	?>

		</div>
		<<?php include "inc/sidebar.php"; ?>
	</div>
<?php include "inc/footer.php"; ?>