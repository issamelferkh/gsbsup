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

  if(isset($_POST["class_add"])) {
    if( empty($_POST["id_student"]) ) {
      $msg = 'All fields are required !';	
    } else {
      $id_class = $_POST['id_class'];
      $id_teacher = $_POST['id_teacher'];
      $id_student = $_POST['id_student'];

    // Check if already this Student exist in this Class
      $query5 = 'SELECT * FROM `student_has_class` WHERE `id_class`="'.$id_class.'" AND `id_student`="'.$id_student.'"';
      $query5 = $db->prepare($query5);
      $query5->execute();
      $count5 = $query5->rowCount();
      $row5 = $query5->fetchAll(\PDO::FETCH_ASSOC);

      if ($count5 > 0) {
        echo "This Student already in this class";
      } else {
        // Add this Student to this Class
        $query = 'INSERT INTO `student_has_class` (`id_class`,`id_teacher`,`id_student`) 
        VALUES (?,?,?)';
        $query = $db->prepare($query);
        if ($query->execute([$id_class,$id_teacher,$id_student])) {
          echo "
            <script>
              const msg = 'Done.';
              window.location.href='class_add_student_script.php?msg='+msg&id_class=".$id_class.";
            </script>
            ";
        } else {
          echo "
            <script>
              const msg = 'Sorry, something went wrong!';
              window.location.href='class_add_student.php?msg='+msg;
            </script>
            ";
        }
      }


    }
	}
?>



<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_class.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- Fetch class Data -->
    <?php
      $sql = 'SELECT * FROM `class` WHERE `id_class` like "'.$_GET['id_class'].'"';
      $result = $db->query($sql);
      $row = $result->fetch(PDO::FETCH_ASSOC);

      $query2 = 'SELECT * FROM `teacher` WHERE `id_teacher` = "'.$row["id_teacher"].'"';
      $result2 = $db->query($query2);
      $row2 = $result2->fetch(PDO::FETCH_ASSOC);

    ?>
    <h6 class="border-bottom pb-2 mb-10">Add Students to <B><?= $row['class_name']; ?></B></h6>
      <div class="row">
        <div class="p-2 col-md-4">
          Class Name
          <input type="text" class="form-control" value="<?php if (isset($row['class_name'])) echo $row['class_name']; ?>" disabled>
        </div>
        <div class="p-2 col-md-4">
          Teacher Name
          <input type="text" class="form-control"  value="<?php if (isset($row2['teacher_name'])) echo $row2['teacher_name']; ?>" disabled>
        </div>
        <div class="p-2 col-md-4">
          Subject Name
          <input type="text" class="form-control"  value="<?php if (isset($row['subject_name'])) echo $row['subject_name']; ?>" disabled>
        </div>
      </div>

      <form method="POST">
        <div class="row">
          <input type="hidden" name="id_class" value="<?= $_GET['id_class']; ?>" >
          <input type="hidden" name="id_teacher" value="<?= $_GET['id_teacher']; ?>" >

          <div class="p-2 col-md-12">
          Select Student<br>
            <select name="id_student" class="form-select">
              <!-- Fech Student Data to add to this Class-->
              <?php
                $q = "SELECT * FROM `student`"; //q = query
                $q = $db->query($q);
                $q->execute();
                $c = $q->rowCount(); //c = count
                $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
                $i = 0; // i = index
                while ($i < $c) {
                  echo "
                    <option value='".$r[$i]["id_student"]."'>".$r[$i]["student_name"]."</option>
                      ";
                  $i++;
                }
              ?>
            </select>
          </div>
          <div class="p-2 col-md-4">
            <button type="submit" name="class_add" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
      <br>
      <br>

      <!-- Fetch Student in this Class -->
      <table id="table_id" class="display">
        <thead>
          <tr>
            <th>Student List</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $id_class = $row['id_class'];

          $query3 = "SELECT * FROM `student_has_class` WHERE `id_class` = '".$id_class."' ";
          $query3 = $db->query($query3);
          $query3->execute();
          $count3 = $query3->rowCount(); //c = count
          $row3 = $query3->fetchAll(PDO::FETCH_ASSOC);
          $i3 = 0;
          while($i3 < $count3) {
            $query4 = 'SELECT * FROM `student` WHERE `id_student` = "'.$row3[$i3]["id_student"].'"';
            $result4 = $db->query($query4);
            $row4 = $result4->fetch(PDO::FETCH_ASSOC);


            echo "
              <tr>
                <td>".$row4["student_name"]."</td>
              </tr>
                ";
            $i3++;
          }
        ?>
        </tbody>
      </table>
  </div>

</main>

<?php include_once("./../includes/footer.php"); ?>
