<?php include_once("./../includes/header.php"); ?>
<?php
include_once '../config/connection.php';

  if(isset($_POST["class_update"])) {
    // print_r($_POST);
    $class_name = $_POST['class_name'];
    $id_teacher = $_POST['id_teacher'];
    $subject_name = $_POST['subject_name'];
    $id_class = $_POST['id_class'];

    $query = "UPDATE `class` SET `class_name`=?,`id_teacher`=?,`subject_name`=? WHERE `id_class`=?"; 
    $query = $db->prepare($query);
    if ($query->execute([$class_name,$id_teacher,$subject_name,$id_class])) {
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
        <div class="p-2 col-md-4">
          Class Name
          <input type="text" name="class_name" class="form-control"  value="<?php if (isset($row['class_name'])) echo $row['class_name']; ?>" placeholder="class Full Name" required>
        </div>

        <div class="p-2 col-md-4">
          Select a Teacher
          <select name="id_teacher" class="form-select" required>
            <!-- Fech Teacher Data -->
            <?php
              $q = "SELECT * FROM `teacher`"; //q = query
              $q = $db->query($q);
              $q->execute();
              $c = $q->rowCount(); //c = count
              $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index
              while ($i < $c) {
                echo "
                  <option value='".$r[$i]["id_teacher"]."'>".$r[$i]["teacher_name"]."</option>
                    ";
                $i++;
              }
            ?>
          </select>
        </div>

        <div class="p-2 col-md-4">
          Subject Name
          <input type="text" name="subject_name" class="form-control" value="<?php if (isset($row['subject_name'])) echo $row['subject_name']; ?>" placeholder="Subject Name" required>
        </div>

      </div>
      <button type="submit" name="class_update" class="btn btn-primary">Submit</button>
    </form>    
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
