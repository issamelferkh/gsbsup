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
    // class_add_student_script.php?id_class=32&class_name=classtest
    if( empty($_POST["student_name"]) ) {
      $msg = 'All fields are required !';	
    } else {
      $id_class = $_POST['id_class'];
      $class_name = $_POST['class_name'];
      $student_name = $_POST['student_name'];

      $query = 'INSERT INTO `class` (`class_name`,`student_name`) 
      VALUES (?,?)';
      $query = $db->prepare($query);
      if ($query->execute([$class_name,$student_name])) {
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


      // $query = "UPDATE `student` SET `id_class`=?,`class_name`=? WHERE `student_name`=?"; 
      // $query = $db->prepare($query);
      // if ($query->execute([$id_class,$class_name,$student_name])) {
      //   echo "
      //     <script>
      //       const msg = 'Done.';
      //       window.location.href='class_add_student.php?msg='+msg;
      //     </script>
      //     ";
      // } else {
      //   echo "
      //     <script>
      //       const msg = 'Sorry, something went wrong!';
      //       window.location.href='class_add_student.php?msg='+msg;
      //     </script>
      //     ";
      // }
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
    ?>
    <h6 class="border-bottom pb-2 mb-10">Add Students to <B><?= $row['class_name']; ?></B></h6>
      <div class="row">
        <div class="p-2 col-md-4">
          Class Name
          <input type="text" class="form-control" value="<?php if (isset($row['class_name'])) echo $row['class_name']; ?>" disabled>
        </div>
        <div class="p-2 col-md-4">
          Teacher Name
          <input type="text" class="form-control"  value="<?php if (isset($row['teacher_name'])) echo $row['teacher_name']; ?>" disabled>
        </div>
        <div class="p-2 col-md-4">
          Subject Name
          <input type="text" class="form-control"  value="<?php if (isset($row['subject_name'])) echo $row['subject_name']; ?>" disabled>
        </div>
      </div>

      <form method="POST">
        <div class="row">
          <input type="hidden" name="id_class" value="<?= $_GET['id_class']; ?>" >
          <input type="hidden" name="class_name" value="<?= $_GET['class_name']; ?>" >

          <div class="p-2 col-md-4">
            <select name="student_name" class="form-select">
              <option selected>Add Student</option>
              <!-- Fech Student Data to add to this Class-->
              <?php
                $q = "SELECT * FROM `student` WHERE `student_name` NOT IN 
                    (SELECT `student_name` FROM `class` WHERE `class_name` LIKE '".$_GET['class_name']."')
                  "; //q = query
                // $q = "SELECT * FROM `student` WHERE `student_name` NOT LIKE 'a'"; //q = query
                $q = $db->query($q);
                $q->execute();
                $c = $q->rowCount(); //c = count
                $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
                $i = 0; // i = index
                while ($i < $c) {
                  echo "
                    <option value='".$r[$i]["student_name"]."'>".$r[$i]["student_name"]."</option>
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
          $class_name = $row['class_name'];
          $sql = "SELECT * FROM `class` WHERE `student_name` > '' AND `class_name` = '".$class_name."' ";
          $sql = $db->query($sql);
          $sql->execute();
          $count = $sql->rowCount(); //c = count
          $row = $sql->fetchAll(PDO::FETCH_ASSOC);
          $i = 0;
          while($i < $count) {
            echo "
              <tr>
                <td>".$row[$i]["student_name"]."</td>
              </tr>
                ";
            $i++;
          }
        ?>
        </tbody>
      </table>
  </div>

</main>

<?php include_once("./../includes/footer.php"); ?>
