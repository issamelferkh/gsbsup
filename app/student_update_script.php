<?php include_once("./../includes/header.php"); ?>
<?php
include_once '../config/connection.php';

  if(isset($_POST["student_update"])) {
    $student_name = $_POST['student_name'];
    $id_student = $_POST['id_student'];

    $query = "UPDATE `student` SET `student_name`=? WHERE `id_student`=?"; 
    $query = $db->prepare($query);
    if ($query->execute([$student_name,$id_student])) {
      echo "
        <script>
          const msg = 'Done.';
          window.location.href='student_update.php?msg='+msg;
        </script>
        ";
    } else {
      echo "
        <script>
          const msg = 'Sorry, something went wrong!';
          window.location.href='student_update.php?msg='+msg;
        </script>
        ";
    }
	}
?>

<!-- Get Student Data to Update -->
<?php
  $sql = 'SELECT * FROM `student` WHERE `id_student` like "'.$_GET['id'].'"';
  $result = $db->query($sql);
  $row = $result->fetch(PDO::FETCH_ASSOC);
?>

<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_student.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Update Student</h6>
    <form method="POST">
      <input type="hidden" name="id_student" value="<?= $_GET['id']; ?>">
      <div class="row">
        <div class="p-2 col-md-12">
          <input type="text" name="student_name" class="form-control"  value="<?php if (isset($row['student_name'])) echo $row['student_name']; ?>" placeholder="Student Full Name">
        </div>
      </div>
      <button type="submit" name="student_update" class="btn btn-primary">Submit</button>
    </form>

    
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
