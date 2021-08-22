<?php include_once("./../includes/header.php"); ?>
<?php include_once '../config/connection.php'; ?>
<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_teacher.php"); ?>


<!-- Get teacher Data to Update -->
<?php
  $sql = 'SELECT * FROM `teacher` WHERE `id_teacher` like "'.$_GET['id'].'"';
  $result = $db->query($sql);
  $row = $result->fetch(PDO::FETCH_ASSOC);
?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Add New teacher</h6>
    <form method="POST">
      <div class="row">
        <div class="p-2 col-md-12">
          <input type="text" name="teacher_name" class="form-control" value="<?php if (isset($row['teacher_name'])) echo $row['teacher_name']; ?>" disabled>
        </div>
      </div>
      <button type="submit" name="teacher_add" class="btn btn-primary">Submit</button>
    </form>

    
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
