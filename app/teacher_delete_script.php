
<?php include_once '../config/connection.php';?>

<?php
		if(isset($_GET['id'])) {
			$id_teacher = $_GET['id'];
			$sql = 'DELETE FROM `teacher` WHERE `id_teacher` = "'.$id_teacher.'"';
			$sql = $db->prepare($sql);
			if ($sql->execute()) {
				echo "
					<script>
						const msg = 'Done.';
						window.location.href='teacher_delete.php?msg='+msg;
					</script>
					";
			} else {
			echo "Sorry, something went wrong";
			}
		} else {
			echo "
					<script>
						const msg = 'Sorry, something went wrong!';
						window.location.href='teacher_delete.php?msg='+msg;
					</script>
					";
		}
?>