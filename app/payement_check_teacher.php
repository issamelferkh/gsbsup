<?php include_once("./../includes/header.php"); ?>
<?php include_once '../config/connection.php'; ?>

<script>
	$(document).ready( function () {
    $('#table_id').DataTable({
			responsive: true
		});
	} );
</script>

<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_payement.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Check Teacher Payement</h6>
    <form method="POST" action="payement_check_student_script.php">
      <!-- Student Table -->
      <div class="table-wrapper">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Teacher Name</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $q = "SELECT * FROM `teacher`"; //q = query
              $q = $db->query($q);
              $q->execute();
              $c = $q->rowCount(); //c = count
              $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index

              while ($i < $c) {
                $total = 0;

                $q2 = 'SELECT * FROM `payement_teacher` WHERE `teacher_name`="'.$r[$i]['teacher_name'].'"';
                $q2 = $db->query($q2);
                $q2->execute();
                $c2 = $q2->rowCount(); //c = count
                $r2 = $q2->fetchAll(PDO::FETCH_ASSOC); // r = row
                $j = 0; // i = index

                while ($j < $c2) {
                  $total = $total + $r2[$j]["pay_amount"];
                  $j++;
                }

                echo "
                  <tr>
                    <td><a href='payement_check_teacher_script.php?teacher_name=".$r[$i]["teacher_name"]."' class='btn btn-success'>M</a> ".$r[$i]["teacher_name"]."</td>
                    <td><a href='payement_check_teacher_script.php?teacher_name=".$r[$i]["teacher_name"]."'>".$total." </a></td>
                  </tr>
                    ";
                $i++;
              }
            ?>
          </tbody>
        </table>
      </div>
    </form>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>











<!-- SELECT * FROM `payement_teacher` WHERE `teacher_name` = 'teacher 01' AND `class_name` = 'class 01' 
SELECT * FROM `payement_teacher` WHERE `teacher_name` = 'Teacher 02' AND `class_name` = 'Class 02'
SELECT * FROM `payement_teacher` WHERE `teacher_name` = 'Teacher 04' AND `class_name` = 'Class 03'
SELECT * FROM `payement_teacher` WHERE `teacher_name` = 'Teacher 01' AND `class_name` = 'Class_05'
SELECT * FROM `payement_teacher` WHERE `teacher_name` = 'Teacher 01' AND `class_name` = 'Class_06' -->
