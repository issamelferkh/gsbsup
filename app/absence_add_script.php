<?php include_once("./../includes/header.php"); ?>
<?php include_once '../config/connection.php'; ?>
<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_absence.php"); ?>

<script>
	$(document).ready( function () {
    $('#table_id').DataTable({
			responsive: true
		});
	} );
</script>

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
    <h6 class="border-bottom pb-2 mb-10">Manage Absence for the Class: <?= $row['class_name']; ?></h6>
    <form method="POST" action="absence_add_script_2.php">
      
      <div class="table-wrapper">
        <!-- Fetch Student in this Class -->
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Absant</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $id_class = $row['id_class'];

            $query3 = "SELECT * FROM `student_has_class` WHERE `id_class` = '".$id_class."' ";
            $query3 = $db->query($query3);
            $query3->execute();
            $count3 = $query3->rowCount(); //c = count
            $row3 = $query3->fetchAll(PDO::FETCH_ASSOC);
            $i3 = 0;
            while($i3 < $count3) {
              $query4 = 'SELECT * FROM `student` WHERE `id_student` = "'.$row3[$i3]["id_student"].'"';
              $result4 = $db->query($query4);
              $row4 = $result4->fetch(PDO::FETCH_ASSOC);
              echo "
                <tr>
                  <td>".$row4["student_name"]."</td>
                  <td><input class='form-check-input' type='checkbox' name='student[]' value='".$row4["id_student"]."' id='".$row4["id_student"]."'></td>
                </tr>
                  ";
              $i3++;
            }
          ?>
          </tbody>
        </table>

        <div class="row">
          <div class="p-2 col-md-3">
            Class Name
            <input type="text" class="form-control"  value="<?php if (isset($row['class_name'])) echo $row['class_name']; ?>" disabled>
          </div>
          <div class="p-2 col-md-3">
            Teacher Name
            <input type="text" class="form-control"  value="<?php if (isset($row2['teacher_name'])) echo $row2['teacher_name']; ?>" disabled>
          </div>
          <div class="p-2 col-md-3">
            Subject Name
            <input type="text" class="form-control"  value="<?php if (isset($row['class_name'])) echo $row['class_name']; ?>" disabled>
          </div>

          <input type="hidden" class="form-control" name="id_class" value="<?php if (isset($row['id_class'])) echo $row['id_class']; ?>" >

          <div class="p-2 col-md-3">
            Date
            <input type="date" class="form-control" name="absence_date">
          </div>
        </div>

        <button type="submit" name="absence_add" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
