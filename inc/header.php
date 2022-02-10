<?php include "config/config.php"; ?>
<?php include "lib/Database.php"; ?>
<?php include "helpers/Format.php"; ?>
<?php 
	$db = new Database();
	$fm = new Format();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Basic Website</title>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<?php 
				$query = "SELECT * FROM tbl_slogan WHERE id='1'";
				$result_row = $db->select($query);
				if($result_row){
					while($value = $result_row->fetch_assoc()){
					
			?>
			<div class="logo">
				<img src="admin/<?php echo $value['logo']; ?>" alt="Logo"/>
				<h2><?php echo $value['title']; ?></h2>
				<p><?php echo $value['slogan']; ?></p>
			</div>
			<?php } ?>
			<?php } ?>
		</a>
		<div class="social clear">
			<?php 
				$query = "SELECT * FROM tbl_social";
				$social = $db->select($query);
				if($social){
				while($value = $social->fetch_assoc()){
			?>
			<div class="icon clear">
				<a href="<?php echo $value['facebook'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $value['twitter'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $value['linkedin'] ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $value['google'] ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
			<?php } ?>
			<?php } ?>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<li><a id="active" href="index.php">Home</a></li>
		<li><a href="about.php">About</a></li>	
		<li><a href="contact.php">Contact</a></li>
	</ul>
</div>