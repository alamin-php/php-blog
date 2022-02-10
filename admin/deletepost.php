<?php include "../lib/Session.php"; ?>
<?php 
	Session::init();
	Session::checkSession();
?>
<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>

<?php 
	$db = new Database();
?>
<?php
    if(!isset($_GET["delpost"]) || $_GET["delpost"] == NULL){
        echo "<script>window.location = 'postlist.php';</script>";
    }else{
            $delid = $_GET["delpost"];
            $query = "DELETE FROM  tbl_post WHERE id = '$delid'";
            $pageDelete = $db->delete($query);
            if($pageDelete){
                echo "<script>alert('Post Deleted Successfully');</script>";
                echo "<script>window.location = 'postlist.php';</script>";
            }else{
                echo "<script>alert('Post Not Delete');</script>";
                echo "<script>window.location = 'postlist.php';</script>";
            }
        }

?>