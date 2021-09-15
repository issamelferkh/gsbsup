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
      <!-- Student Table -->
      <div class="table-wrapper">
      <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Student Name</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = "SELECT * FROM `student`"; //q = query
              $query = $db->query($query);
              $query->execute();
              $count = $query->rowCount(); //c = count
              $row = $query->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index

              while ($i < $count) {
                echo "
                  <tr>
                    <td><a href='payement_check_student_script.php?id_student=".$row[$i]["id_student"]."&student_name=".$row[$i]["student_name"]."' class='btn btn-success'>C</a> ".$row[$i]["student_name"]."</td>
                  </tr>
                    ";
                $i++;
              }
            ?>
          </tbody>
        </table>
      </div>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
