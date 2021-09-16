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

  if(isset($_POST["payement_check_student"])) {
    if( empty($_POST["student_class"]) ) {
      $msg = 'All fields are required !';	
      $student_name = "";
      $class_name = "";
    } else {
      $student_class = explode(",", $_POST['student_class']);
      $student_name = $student_class[0];
      $class_name = $student_class[1];
    }
	} else {
    $student_name = "";
    $class_name = "";
  }
?>



<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_payement.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Check Payement of the Student: <B><?= $student_name ;?></B> from the Class: <B><?= $class_name ;?></B></h6>
    <form method="POST">
      <!-- Student Table -->
      <div class="table-wrapper">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Payment Date</th>
              <th>Month</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $q = "SELECT * FROM `payement` WHERE `student_name` = '".$student_name."' AND `class_name` = '".$class_name."'"; //q = query
              $q = $db->query($q);
              $q->execute();
              $c = $q->rowCount(); //c = count
              $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index

              while ($i < $c) {
                echo "
                  <tr>
                    <td>".$r[$i]["pay_date"]."</td>
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
      <button type="submit" name="payement_add_student" class="btn btn-primary">Submit</button>
    </form>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
