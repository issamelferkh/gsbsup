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
    <h6 class="border-bottom pb-2 mb-10">Check Student Payement</h6>
    <form method="POST" action="payement_check_student_script.php">
      <!-- Student Table -->
      <div class="table-wrapper">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Stdent Name</th>
              <th>Class Name</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $q = "SELECT * FROM `class` WHERE `student_name` > '' "; //q = query
              $q = $db->query($q);
              $q->execute();
              $c = $q->rowCount(); //c = count
              $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index

              while ($i < $c) {
                echo "
                  <tr>
                    <td><input type='radio' class='form-check-input' name='student_class' value='".$r[$i]["student_name"].",".$r[$i]["class_name"]."'> ".$r[$i]["student_name"]."</td>
                    <td>".$r[$i]["class_name"]."</td>
                  </tr>
                    ";
                $i++;
              }
                            
            ?>
          </tbody>
        </table>
      </div>
      <button type="submit" name="payement_check_student" class="btn btn-primary">Submit</button>
    </form>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
