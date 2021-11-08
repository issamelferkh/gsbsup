
<?php include_once '../config/connection.php';?>

<?php
	if(isset($_POST["absence_add"])) {
		if( empty($_POST["id_class"]) || empty($_POST["absence_date"])) {
			echo "
				<script>
					const msg = 'All fields are required !';
					window.location.href='absence_add.php?msg='+msg;
				</script>
				";
		} else {

			$id_class = $_POST['id_class'];
			$absent = 1;
			$flag = 1;
			$absence_date = $_POST['absence_date'];
			$student=$_POST['student'];  
			foreach($student as $std)  
				{  
					$id_student = $std;
					$query = 'INSERT INTO `absence` (`id_class`, `id_student`, `absent`, `absence_date`) 
					VALUES (?,?,?,?)';
					$query = $db->prepare($query);
					if ($query->execute([$id_class, $id_student, $absent, $absence_date])) {
						$msg = "done";
					} else {
						$flag = 0;
					}
				}

				if ($flag) {
					echo "
						<script>
							const msg = 'Done.';
							window.location.href='absence_add.php?msg='+msg;
						</script>
						";
				} else {
					echo "
						<script>
							const msg = 'Sorry, something went wrong!';
							window.location.href='absence_add.php?msg='+msg;
						</script>
						";
				}
			}
		}
?>