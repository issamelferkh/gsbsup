<?php include_once("./../includes/header.php"); ?>

<script>
	$(document).ready( function () {
    $('#table_id').DataTable({
			responsive: true
		});
	} );
</script>


<?php
include_once '../config/connection.php';

  if(isset($_GET["teacher_name"])) {
    $teacher_name = $_GET["teacher_name"];
  } else {
    $teacher_name = "";
  }

?>



<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_payement.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Check Payement of the Teacher: <B><?= $teacher_name ;?></B>.</h6>
    <form method="POST">
      <!-- teacher Table -->
      <div class="table-wrapper">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Date</th>
              <th>Description</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $q = "SELECT * FROM `payement_teacher` WHERE `teacher_name` = '".$teacher_name."'"; //q = query
              $q = $db->query($q);
              $q->execute();
              $c = $q->rowCount(); //c = count
              $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index

              while ($i < $c) {
                echo "
                  <tr>
                    <td>".$r[$i]["create_at"]."</td>
                    <td>".$r[$i]["remarque"]."</td>
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
