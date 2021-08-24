<?php include_once("./../includes/header.php"); ?>
<?php
include_once '../config/connection.php';

  if(isset($_POST["class_update"])) {
    $class_name = $_POST['class_name'];
    $id_class = $_POST['id_class'];

    $query = "UPDATE `class` SET `class_name`=? WHERE `id_class`=?"; 
    $query = $db->prepare($query);
    if ($query->execute([$class_name,$id_class])) {
      echo "
        <script>
          const msg = 'Done.';
          window.location.href='class_update.php?msg='+msg;
        </script>
        ";
    } else {
      echo "
        <script>
          const msg = 'Sorry, something went wrong!';
          window.location.href='class_update.php?msg='+msg;
        </script>
        ";
    }
	}
?>

<!-- Get class Data to Update -->
<?php
  $sql = 'SELECT * FROM `class` WHERE `id_class` like "'.$_GET['id'].'"';
  $result = $db->query($sql);
  $row = $result->fetch(PDO::FETCH_ASSOC);
?>

<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_class.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Update Class: <?= $row['class_name']; ?></h6>
    <form method="POST">
      <input type="hidden" name="id_class" value="<?= $_GET['id']; ?>">
      <div class="row">
        <div class="p-2 col-md-12">
          <input type="text" name="class_name" class="form-control"  value="<?php if (isset($row['class_name'])) echo $row['class_name']; ?>" placeholder="class Full Name">
        </div>
      </div>
      <button type="submit" name="class_update" class="btn btn-primary">Submit</button>
    </form>

    
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
