
<?php include_once '../config/connection.php';?>

<?php
		if(isset($_GET['id'])) {
			$id_payement_teacher = $_GET['id'];
			$sql = 'DELETE FROM `payement_teacher` WHERE `id_payement_teacher` = "'.$id_payement_teacher.'"';
			$sql = $db->prepare($sql);
			if ($sql->execute()) {
				echo "
					<script>
						const msg = 'Done.';
						window.location.href='payement_check_teacher.php?msg='+msg;
					</script>
					";
			} else {
			echo "Sorry, something went wrong";
			}
		} else {
			echo "
					<script>
						const msg = 'Sorry, something went wrong!';
						window.location.href='payement_check_teacher.php?msg='+msg;
					</script>
					";
		}
?>