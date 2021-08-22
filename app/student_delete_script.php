
<?php include_once '../config/connection.php';?>

<?php
		if(isset($_GET['id'])) {
			$id_student = $_GET['id'];
			$sql = 'DELETE FROM `student` WHERE `id_student` = "'.$id_student.'"';
			$sql = $db->prepare($sql);
			if ($sql->execute()) {
				echo "
					<script>
						const msg = 'Done.';
						window.location.href='student_delete.php?msg='+msg;
					</script>
					";
			} else {
			echo "Sorry, something went wrong";
			}
		} else {
			echo "
					<script>
						const msg = 'Sorry, something went wrong!';
						window.location.href='student_delete.php?msg='+msg;
					</script>
					";
		}
?>