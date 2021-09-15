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

  if(isset($_POST["payement_add_teacher"])) {
    if( empty($_POST["teacher_class"]) ) {
      $msg = 'All fields are required !';	
    } else {
      $teacher_class = explode(",", $_POST['teacher_class']);
      $teacher_name = $teacher_class[0];
      $class_name = $teacher_class[1];

      $pay_date = $_POST['pay_date'];
      $pay_month = $_POST['pay_month'];
      $pay_amount = $_POST['pay_amount'];
      $remarque = "GSB School paid <B>".$pay_amount." Dhs</B> to <B>".$teacher_name."</B> of <B>".$class_name."</B> class for the month <B>".$pay_month."</B>";
      $pay_amount = $pay_amount * (-1);

      $query = 'INSERT INTO `payement_teacher` (`teacher_name`,`class_name`,`pay_month`,`pay_amount`,`remarque`,`pay_date`) 
      VALUES (?,?,?,?,?,?)';
        $query = $db->prepare($query);
        if ($query->execute([$teacher_name,$class_name,$pay_month,$pay_amount,$remarque,$pay_date])) {
          echo "
            <script>
              const msg = 'Done.';
              window.location.href='payement_check_teacher.php?msg='+msg;
            </script>
            ";
        } else {
          echo "
            <script>
              const msg = 'Sorry, something went wrong!';
              window.location.href='payement_check_teacher.php?msg='+msg;
            </script>
            ";
        }
    }

	}
?>



<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_payement.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Add New teacher Payement</h6>
      <!-- teacher Table -->
      <div class="table-wrapper">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Teacher Name</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $q = "SELECT * FROM `teacher`"; //q = query
              $q = $db->query($q);
              $q->execute();
              $c = $q->rowCount(); //c = count
              $row = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index

              while ($i < $c) {
                echo "
                  <tr>
                    <td><a href='payement_add_teacher_script.php?id_teacher=".$row[$i]["id_teacher"]."&teacher_name=".$row[$i]["teacher_name"]."' class='btn btn-primary'>A</a> ".$row[$i]["teacher_name"]."</td>
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
