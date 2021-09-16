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
// INSERT INTO `payement`(`id_payement`, `id_class`, `id_teacher`, ``, `pay_month`, `pay_date`, `pay_amount`, `remarque`, `create_at`) 
if(isset($_POST["payement_add_student2"])) {
    print_r($_POST);
  if( empty($_POST["student"]) ) {
    $msg = 'All fields are required !';	
  } else {
    // print_r($_POST);

    $student = explode(",", $_POST['student']);
    $id_student = $student[0];
    $student_name = $student[1];

    $class_name = $student_class[1];
    $teacher_name = $student_class[2];

  //   $pay_date = $_POST['pay_date'];
  //   $pay_month = $_POST['pay_month'];
  //   $pay_amount = $_POST['pay_amount'];
  //   $pay_amount_teacher = 70;

  //   // Add to Payment Teacher
  //   $student_name = $student_class[0];
  //   $remarque = "<B>".$student_name."</B> from <B>".$class_name."</B> class 
  //             paid GSB School <B>".$pay_amount." Dhs</B> of which <B>".$pay_amount_teacher." Dhs</B> for the Teacher <B>".$teacher_name."</B> 
  //             for the month <B>".$pay_month."</B>";

  //   $query = 'INSERT INTO `payement_teacher` (`teacher_name`,`class_name`,`pay_amount`,`pay_month`,`remarque`,`pay_date`) 
  //   VALUES (?,?,?,?,?,?)';
  //   $query = $db->prepare($query);
  //   $query->execute([$teacher_name,$class_name,$pay_amount_teacher,$pay_month,$remarque,$pay_date]);


  //   $query = 'INSERT INTO `payement` (`student_name`,`class_name`,`pay_month`,`pay_amount`,`pay_date`) 
  //   VALUES (?,?,?,?,?)';
  //     $query = $db->prepare($query);
  //     if ($query->execute([$student_name,$class_name,$pay_month,$pay_amount,$pay_date])) {
  //       echo "
  //         <script>
  //           const msg = 'Done.';
  //           window.location.href='payement_add_student.php?msg='+msg;
  //         </script>
  //         ";
  //     } else {
  //       echo "
  //         <script>
  //           const msg = 'Sorry, something went wrong!';
  //           window.location.href='payement_add_student.php?msg='+msg;
  //         </script>
  //         ";
  //     }
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
            <select name="class" class="form-select">
              <?php
                $q = "SELECT * FROM `class`"; //q = query
                $q = $db->query($q);
                $q->execute();
                $c = $q->rowCount(); //c = count
                $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
                $i = 0; // i = index
                while ($i < $c) {
                  $query = 'SELECT * FROM `student_has_class` WHERE `id_student` = "'.$id_student.'" AND `id_class` = "'.$r[$i]["id_class"].'"';
                  $query = $db->prepare($query);
                  $query->execute();
                  $count = $query->rowCount();
                  $row = $query->fetchAll(\PDO::FETCH_ASSOC);
                  if ($count > 0) {
                    echo "<option value='".$r[$i]["id_class"].",".$r[$i]["class_name"]."'>".$r[$i]["class_name"]."</option>";
                  } else {
                    echo "<option value='Emplty' >This student not assigned to any class</option>";

                  }

                  $i++;
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
      <button type="submit" name="payement_add_student2" class="btn btn-primary">Submit</button>
    </form>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
