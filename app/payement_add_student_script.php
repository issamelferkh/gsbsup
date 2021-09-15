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

  // Recover Class and Teacher and Payment Data to insert to DB
  if(isset($_POST["payement_add_student"])) {
    $class_teacher_data = explode(",", $_POST['class_teacher_data']);

    $id_class = $class_teacher_data[0];
    $class_name = $class_teacher_data[1];
    $id_teacher = $class_teacher_data[2];
    $teacher_name = $class_teacher_data[3];
    $id_student = $_POST["id_student"];
    $student_name = $_POST["student_name"];

    $pay_date = $_POST['pay_date'];
    $pay_month = $_POST['pay_month'];
    $pay_amount = $_POST['pay_amount'];
    $pay_amount_teacher = 70;

    $remarque = "<B>".$student_name."</B> from <B>".$class_name."</B> class 
                  paid GSB School <B>".$pay_amount." Dhs</B> of which <B>".$pay_amount_teacher." Dhs</B> for the Teacher <B>".$teacher_name."</B> 
                  for the month <B>".$pay_month."</B>";

    // Add to Payment to Teacher
    $query = 'INSERT INTO `payement_teacher` (`id_student`, `id_class`, `id_teacher`,`pay_amount`,`pay_month`,`remarque`,`pay_date`) 
    VALUES (?,?,?,?,?,?,?)';
    $query = $db->prepare($query);
    $query->execute([$id_student, $id_class, $id_teacher,$pay_amount_teacher,$pay_month,$remarque,$pay_date]);

    // Add to Payment to Student
    $query = 'INSERT INTO `payement` (`id_student`, `id_class`, `id_teacher`, `pay_month`,`pay_amount`,`pay_date`) 
    VALUES (?,?,?,?,?,?)';
    $query = $db->prepare($query);
    if ($query->execute([$id_student, $id_class, $id_teacher ,$pay_month,$pay_amount,$pay_date])) {
      echo "
        <script>
          const msg = 'Done.';
          window.location.href='payement_add_student.php?msg='+msg;
        </script>
        ";
    } else {
      echo "
        <script>
          const msg = 'Sorry, something went wrong!';
          window.location.href='payement_add_student.php?msg='+msg;
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
            <select name="class_teacher_data" class="form-select">
              <?php
                $query =' SELECT `student_has_class`.`id_student`, `student_has_class`.`id_class`, `teacher`.`id_teacher`, 
                                  `class`.`class_name`, `teacher`.`teacher_name`
                          FROM `student_has_class`
                          INNER JOIN `class` ON `class`.`id_class` = `student_has_class`.`id_class`
                          INNER JOIN `teacher` ON `teacher`.`id_teacher` = `class`.`id_teacher`
                          WHERE `id_student` = "'.$id_student.'"
                ';
                $query = $db->prepare($query);
                $query->execute();
                $c = $query->rowCount();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $i = 0; 
                if ($c > 0) {
                  while ($i < $c) {
                    echo "<option value='".$row[$i]["id_class"].",".$row[$i]["class_name"].",".$row[$i]["id_teacher"].",".$row[$i]["teacher_name"]."'>".$row[$i]["class_name"]."</option>";
                    $i++;
                  }
                } else {
                  echo "<option value='Emplty' >This student not assigned to any class</option>";

                }
              ?>
            </select>
          </div>
          
        <div class="p-2 col-md-3">
          <input type="hidden" name="id_student" value="<?= $id_student ?>" />
          <input type="hidden" name="student_name" value="<?= $student_name ?>" />
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
      <button type="submit" name="payement_add_student" class="btn btn-primary">Submit</button>
    </form>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
