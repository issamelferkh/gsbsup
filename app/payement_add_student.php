<?php include_once("./../includes/header.php"); ?>
<?php include_once '../config/connection.php'; ?>
<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_payement.php"); ?>

<script>
	$(document).ready( function () {
    $('#table_id').DataTable({
			responsive: true
		});
	} );
</script>

<?php 

  if(isset($_POST["payement_add_student1"])) {
      if( empty($_POST["class"]) ) {
        $msg = 'All fields are required !';	
      } else {
        $student = explode(",", $_POST['student']);
        $id_student = $student[0];
        $student_name = $student[1];

          //   $student_name = $student_class[0];
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
<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Add New Student Payement</h6>
    <form method="POST" action="payement_add_student_script.php?student=sss">
      <!-- Student Table -->
      <div class="table-wrapper">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Student Name</th>
            </tr>
          </thead>
          <!-- <td><input type='radio' class='form-check-input' name='student_class' value='".$r[$i]["student_name"].",".$r[$i]["class_name"].",".$r[$i]["teacher_name"]."'> ".$r[$i]["student_name"]."</td> -->

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
                    <td><input type='radio' class='form-check-input' name='student' value='".$row[$i]["id_student"].",".$row[$i]["student_name"]."'> ".$row[$i]["student_name"]."</td>
                  </tr>
                    ";
                $i++;
              }
            ?>
          </tbody>
        </table>
      </div>
      <button type="submit" name="payement_add_student1" class="btn btn-primary">Submit</button>
    </form>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
