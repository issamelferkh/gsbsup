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
  // Recover Teacher Data
  if(isset($_GET["id_teacher"]) && isset($_GET["teacher_name"])) {
    $id_teacher = $_GET["id_teacher"];
    $teacher_name = $_GET["teacher_name"];
  } else {
    $id_teacher = "";
    $teacher_name = "";
  }

  // Recover Class and Payment Data to insert to DB
  if(isset($_POST["payement_add_teacher"])) {

    print_r($_POST);
    $id_teacher = $_POST['id_teacher'];
    $teacher_name = $_POST['teacher_name'];

    $class_data = explode(",", $_POST['class_data']);
    $id_class = $class_data[0];
    $class_name = $class_data[1];

    $pay_date = $_POST['pay_date'];
    $pay_month = $_POST['pay_month'];
    $pay_amount = $_POST['pay_amount'];
    $remarque = "GSB School paid <B>".$pay_amount." Dhs</B> to <B>".$teacher_name."</B> of <B>".$class_name."</B> class for the month <B>".$pay_month."</B>";
    $pay_amount = $pay_amount * (-1);


    // Add to Payment to Teacher
    $query = 'INSERT INTO `payement_teacher` (`id_teacher`,`id_class`,`pay_month`,`pay_amount`,`remarque`,`pay_date`) 
    VALUES (?,?,?,?,?,?)';
      $query = $db->prepare($query);
      if ($query->execute([$id_teacher,$id_class,$pay_month,$pay_amount,$remarque,$pay_date])) {
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
?>



<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_payement.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Add New Student Payement</h6>
    <form method="POST">
      <div class="row">
        <div class="p-2 col-md-3">
          Select Class<br>
            <select name="class_data" class="form-select">
              <?php
                $query =' SELECT `class`.`id_class`, `class`.`class_name`
                          FROM `class`
                          WHERE `class`.`id_teacher` = "'.$id_teacher.'"
                ';
                $query = $db->prepare($query);
                $query->execute();
                $c = $query->rowCount();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $i = 0; 
                if ($c > 0) {
                  while ($i < $c) {
                    echo "<option value='".$row[$i]["id_class"].",".$row[$i]["class_name"]." '>".$row[$i]["class_name"]."</option>";
                    $i++;
                  }
                } else {
                  echo "<option value='Emplty' >This student not assigned to any class</option>";

                }
              ?>
            </select>
          </div>
          
        <div class="p-2 col-md-3">
          <input type="hidden" name="id_teacher" value="<?= $id_teacher ?>" />
          <input type="hidden" name="teacher_name" value="<?= $teacher_name ?>" />
          Payment Date
          <input type="date" name="pay_date" class="form-control" placeholder="Payment Date" required >
        </div>
        <div class="p-2 col-md-3">
          Month
          <input type="month" name="pay_month" class="form-control" placeholder="Class Name" required >
        </div>
        <div class="p-2 col-md-3">
          Amount
          <input type="text" name="pay_amount" class="form-control" placeholder="Amount on Dhs" required >
        </div>
      </div>
      <button type="submit" name="payement_add_teacher" class="btn btn-primary">Submit</button>
    </form>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
