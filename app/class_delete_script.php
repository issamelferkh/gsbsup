
<?php include_once '../config/connection.php';?>

<?php
		if(isset($_GET['id'])) {
			$id_class = $_GET['id'];
			$sql = 'DELETE FROM `class` WHERE `id_class` = "'.$id_class.'"';
			$sql = $db->prepare($sql);
			if ($sql->execute()) {
				echo "
					<script>
						const msg = 'Done.';
						window.location.href='class_delete.php?msg='+msg;
					</script>
					";
			} else {
			echo "Sorry, something went wrong";
			}
		} else {
			echo "
					<script>
						const msg = 'Sorry, something went wrong!';
						window.location.href='class_delete.php?msg='+msg;
					</script>
					";
		}
?>