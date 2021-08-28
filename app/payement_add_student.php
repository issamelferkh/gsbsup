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

  if(isset($_POST["payement_add_student"])) {
    if( empty($_POST["student_class"]) ) {
      $msg = 'All fields are required !';	
    } else {
      // [student_class] => issam, aaaa [pay_month] => 2021-06 [pay_amount] => 12

      $student_class = explode(",", $_POST['student_class']);
      $student_name = $student_class[0];
      $class_name = $student_class[1];
      $teacher_name = $student_class[2];

      $pay_date = $_POST['pay_date'];
      $pay_month = $_POST['pay_month'];
      $pay_amount = $_POST['pay_amount'];
      $pay_amount_teacher = 70;

      // Add to Payment Teacher
      $student_name = $student_class[0];
      $remarque = "<B>".$student_name."</B> from <B>".$class_name."</B> class 
                paid GSB School <B>".$pay_amount." Dhs</B> of which <B>".$pay_amount_teacher." Dhs</B> for the Teacher <B>".$teacher_name."</B> 
                for the month <B>".$pay_month."</B>";

      $query = 'INSERT INTO `payement_teacher` (`teacher_name`,`class_name`,`pay_amount`,`pay_month`,`remarque`,`pay_date`) 
      VALUES (?,?,?,?,?,?)';
      $query = $db->prepare($query);
      $query->execute([$teacher_name,$class_name,$pay_amount_teacher,$pay_month,$remarque,$pay_date]);


      $query = 'INSERT INTO `payement` (`student_name`,`class_name`,`pay_month`,`pay_amount`,`pay_date`) 
      VALUES (?,?,?,?,?)';
        $query = $db->prepare($query);
        if ($query->execute([$student_name,$class_name,$pay_month,$pay_amount,$pay_date])) {
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

	}
?>



<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_payement.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Add New Student Payement</h6>
    <form method="POST">
      <!-- Student Table -->
      <div class="table-wrapper">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Stdent Name</th>
              <th>Class Name</th>
              <!-- <th>Teacher Name</th>
              <td>".$r[$i]["teacher_name"]."</td> -->

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
                    <td><input type='radio' class='form-check-input' name='student_class' value='".$r[$i]["student_name"].",".$r[$i]["class_name"].",".$r[$i]["teacher_name"]."'> ".$r[$i]["student_name"]."</td>
                    <td>".$r[$i]["class_name"]."</td>
                  </tr>
                    ";
                $i++;
              }
                            
            ?>
          </tbody>
        </table>
      </div>
      <!-- Other Inputs -->
      <div class="row">
        <div class="p-2 col-md-4">
          Payment Date
          <input type="date" name="pay_date" class="form-control" placeholder="Payment Date" required >
        </div>
        <div class="p-2 col-md-4">
          Month
          <input type="month" name="pay_month" class="form-control" placeholder="Class Name" required >
        </div>
        <div class="p-2 col-md-4">
          Amount
          <input type="text" name="pay_amount" class="form-control" placeholder="Amount on Dhs" required >
        </div>
      </div>
      <button type="submit" name="payement_add_student" class="btn btn-primary">Submit</button>
    </form>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
