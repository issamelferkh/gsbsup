<?php include_once("./../includes/header.php"); ?>
<?php
include_once '../config/connection.php';

  if(isset($_POST["student_add"])) {
    if( empty($_POST["student_name"]) ) {
      $msg = 'All fields are required !';	
    } else {
      $student_name = $_POST['student_name'];
      $query = 'INSERT INTO `student` (`student_name`) 
      VALUES (?)';
        $query = $db->prepare($query);
        if ($query->execute([$student_name])) {
          echo "
            <script>
              const msg = 'Done.';
              window.location.href='student_list.php?msg='+msg;
            </script>
            ";
        } else {
          echo "
            <script>
              const msg = 'Sorry, something went wrong!';
              window.location.href='student_list.php?msg='+msg;
            </script>
            ";
        }
    }

	}
?>



<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_student.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Add New Student</h6>
    <form method="POST">
      <div class="row">
        <div class="p-2 col-md-12">
          <input type="text" name="student_name" class="form-control" placeholder="Student Full Name">
        </div>
      </div>
      <button type="submit" name="student_add" class="btn btn-primary">Submit</button>
    </form>

    
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
