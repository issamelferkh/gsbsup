<?php include_once("./../includes/header.php"); ?>
<?php
include_once '../config/connection.php';

  if(isset($_POST["teacher_update"])) {
    // $old_name = $_POST['old_name'];
    $teacher_name = $_POST['teacher_name'];
    $id_teacher = $_POST['id_teacher'];

    // $query = "UPDATE `payement_teacher` SET `teacher_name`=? WHERE `id_teacher`=?"; 
    // $query = $db->prepare($query);
    // $query->execute([$teacher_name,$id_teacher]);

    // $query = "UPDATE `class` SET `teacher_name`=? WHERE `teacher_name`=?"; 
    // $query = $db->prepare($query);
    // $query->execute([$teacher_name,$old_name]);

    $query = "UPDATE `teacher` SET `teacher_name`=? WHERE `id_teacher`=?"; 
    $query = $db->prepare($query);
    if ($query->execute([$teacher_name,$id_teacher])) {
      echo "
        <script>
          const msg = 'Done.';
          window.location.href='teacher_update.php?msg='+msg;
        </script>
        ";
    } else {
      echo "
        <script>
          const msg = 'Sorry, something went wrong!';
          window.location.href='teacher_update.php?msg='+msg;
        </script>
        ";
    }
	}
?>

<!-- Get teacher Data to Update -->
<?php
  $sql = 'SELECT * FROM `teacher` WHERE `id_teacher` like "'.$_GET['id'].'"';
  $result = $db->query($sql);
  $row = $result->fetch(PDO::FETCH_ASSOC);
?>

<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_teacher.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Update Teacher: <?= $row['teacher_name']; ?></h6>
    <form method="POST">
      <input type="hidden" name="id_teacher" value="<?= $_GET['id']; ?>">
      <input type="hidden" name="old_name" value="<?= $_GET['old_name']; ?>">
      <div class="row">
        <div class="p-2 col-md-12">
          <input type="text" name="teacher_name" class="form-control"  value="<?php if (isset($row['teacher_name'])) echo $row['teacher_name']; ?>" placeholder="teacher Full Name">
        </div>
      </div>
      <button type="submit" name="teacher_update" class="btn btn-primary">Submit</button>
    </form>

    
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
