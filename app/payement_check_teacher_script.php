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
  if(isset($_GET["teacher_name"])) {
    $id_teacher = $_GET["id_teacher"];
    $teacher_name = $_GET["teacher_name"];
  } else {
    $id_teacher = "";
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
              <th>Payment Date</th>
              <th>Description</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $q = "SELECT * FROM `payement_teacher` WHERE `id_teacher` = '".$id_teacher."'"; //q = query
              $q = $db->query($q);
              $q->execute();
              $c = $q->rowCount(); //c = count
              $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index

              while ($i < $c) {
                echo "
                  <tr>
                    <td><a href='payement_delete_teacher_script.php?id=".$r[$i]["id_payement_teacher"]."' onclick='return myConfirm();' class='btn btn-danger'>X</a> ".$r[$i]["pay_date"]."</td>
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

<script>
  function myConfirm() {
    var result = confirm("Are you sure to delete this item?");
    if (result==true) {
    return true;
    } else {
    return false;
    }
  }
</script>

<?php include_once("./../includes/footer.php"); ?>
