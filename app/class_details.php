<?php include_once("./../includes/header.php"); ?>
<?php include_once '../config/connection.php'; ?>
<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_class.php"); ?>


<!-- Get class Data to Update -->
<?php
  $sql = 'SELECT * FROM `class` WHERE `id_class` like "'.$_GET['id'].'"';
  $result = $db->query($sql);
  $row = $result->fetch(PDO::FETCH_ASSOC);

  $query2 = 'SELECT * FROM `teacher` WHERE `id_teacher` like "'.$row['id_teacher'].'"';
  $result2 = $db->query($query2);
  $row2 = $result2->fetch(PDO::FETCH_ASSOC);
?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Class: <?= $row['class_name']; ?></h6>
      <div class="row">
        <div class="p-2 col-md-4">
          Class Name
          <input type="text" class="form-control"  value="<?php if (isset($row['class_name'])) echo $row['class_name']; ?>" disabled>
        </div>
        <div class="p-2 col-md-4">
          Teacher Name
          <input type="text" class="form-control"  value="<?php if (isset($row2['teacher_name'])) echo $row2['teacher_name']; ?>" disabled>
        </div>
        <div class="p-2 col-md-4">
          Subject Name
          <input type="text" class="form-control"  value="<?php if (isset($row['class_name'])) echo $row['class_name']; ?>" disabled>
        </div>
      </div>
      <!-- Fetch Student in this Class -->
      <table id="table_id" class="display">
        <thead>
          <tr>
            <th>Student Name</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $class_name = $row['class_name'];
          $sql = "SELECT * FROM `class` WHERE `student_name` > '' AND `class_name` = '".$class_name."' ";
          $sql = $db->query($sql);
          $sql->execute();
          $count = $sql->rowCount(); //c = count
          $row = $sql->fetchAll(PDO::FETCH_ASSOC);
          $i = 0;
          while($i < $count) {
            echo "
              <tr>
                <td>".$row[$i]["student_name"]."</td>
              </tr>
                ";
            $i++;
          }
        ?>
        </tbody>
      </table>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
