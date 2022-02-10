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
    if(!isset($_GET["delpage"]) || $_GET["delpage"] == NULL){
        echo "<script>window.location = 'index.php';</script>";
    }else{
            $delid = $_GET["delpage"];
            $query = "DELETE FROM  tbl_page WHERE id = '$delid'";
            $pageDelete = $db->delete($query);
            if($pageDelete){
                echo "<script>alert('Page Deleted Successfully');</script>";
                echo "<script>window.location = 'index.php';</script>";
            }else{
                echo "<script>alert('Page Not Delete');</script>";
                echo "<script>window.location = 'index.php';</script>";
            }
        }

?>