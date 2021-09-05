<?php include_once("./../includes/header.php"); ?>
<?php
include_once '../config/connection.php';

  if(isset($_POST["class_add"])) {
    // Array ( [class_name] => qqq [] => aq [] => qqqq [class_add] => )

    if( empty($_POST["class_name"]) ) {
      $msg = 'All fields are required !';	
    } else {
      $class_name = $_POST['class_name'];
      $teacher_name = $_POST['teacher_name'];
      $subject_name = $_POST['subject_name'];

      $query = 'INSERT INTO `class` (`class_name`,`teacher_name`,`subject_name`) 
      VALUES (?,?,?)';
        $query = $db->prepare($query);
        if ($query->execute([$class_name,$teacher_name,$subject_name])) {
          echo "
            <script>
              const msg = 'Done.';
              window.location.href='class_list.php?msg='+msg;
            </script>
            ";
        } else {
          echo "
            <script>
              const msg = 'Sorry, something went wrong!';
              window.location.href='class_list.php?msg='+msg;
            </script>
            ";
        }
    }
	}
?>



<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_class.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Add New class</h6>
    <form method="POST">
      <div class="row">

        <div class="p-2 col-md-4">
          Class Name
          <input type="text" name="class_name" class="form-control" placeholder="Class Name" required>
        </div>

        <div class="p-2 col-md-4">
          Select a Teacher
          <select name="teacher_name" class="form-select" required>
            <!-- Fech Teacher Data -->
            <?php
              $q = "SELECT * FROM `teacher`"; //q = query
              $q = $db->query($q);
              $q->execute();
              $c = $q->rowCount(); //c = count
              $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index
              while ($i < $c) {
                echo "
                  <option value='".$r[$i]["teacher_name"]."'>".$r[$i]["teacher_name"]."</option>
                    ";
                $i++;
              }
            ?>
          </select>
        </div>

        <div class="p-2 col-md-4">
          Subject Name
          <input type="text" name="subject_name" class="form-control" placeholder="Subject Name" required>
        </div>

      </div>
      <button type="submit" name="class_add" class="btn btn-primary">Submit</button>
    </form>

    
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
