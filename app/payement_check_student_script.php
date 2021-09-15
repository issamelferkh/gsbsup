<?php include_once("./../includes/header.php"); ?>
<?php include_once '../config/connection.php'; ?>

<script>
	$(document).ready( function () {
    $('#table_id').DataTable({
			responsive: true
		});
	} );
</script>

<?php
    // Recover Student Data
    if(isset($_GET["id_student"]) && isset($_GET["student_name"])) {
      $id_student = $_GET["id_student"];
      $student_name = $_GET["student_name"];
    } else {
      $id_student = "";
      $student_name = "";
    }
  ?>

<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_payement.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Check Payement of the Student: <B><?= $student_name ;?></B></h6>
      <!-- Student Table -->
      <div class="table-wrapper">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Payment Date</th>
              <th>Class Name</th>
              <th>Month</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $q = "SELECT * FROM `payement` WHERE `id_student` = '".$id_student."'"; //q = query
              $q = $db->query($q);
              $q->execute();
              $c = $q->rowCount(); //c = count
              $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index
              while ($i < $c) {
                // Recover Class Name
                $q2 = 'SELECT * FROM `class` WHERE `id_class` like "'.$r[$i]["id_class"].'"';
                $q2 = $db->query($q2);
                $r2 = $q2->fetch(PDO::FETCH_ASSOC);

                echo "
                  <tr>
                    <td>".$r[$i]["pay_date"]."</td>
                    <td>".$r2["class_name"]."</td>
                    <td>".$r[$i]["pay_month"]."</td>
                    <td>".$r[$i]["pay_amount"]." Dhs</td>
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
