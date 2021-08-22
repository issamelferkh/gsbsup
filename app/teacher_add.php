<?php include_once("./../includes/header.php"); ?>
<?php
include_once '../config/connection.php';

  if(isset($_POST["teacher_add"])) {
    if( empty($_POST["teacher_name"]) ) {
      $msg = 'All fields are required !';	
    } else {
      $teacher_name = $_POST['teacher_name'];
      $query = 'INSERT INTO `teacher` (`teacher_name`) 
      VALUES (?)';
        $query = $db->prepare($query);
        if ($query->execute([$teacher_name])) {
          echo "
            <script>
              const msg = 'Done.';
              window.location.href='teacher_list.php?msg='+msg;
            </script>
            ";
        } else {
          echo "
            <script>
              const msg = 'Sorry, something went wrong!';
              window.location.href='teacher_list.php?msg='+msg;
            </script>
            ";
        }
    }

	}
?>



<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_teacher.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Add New Teacher</h6>
    <form method="POST">
      <div class="row">
        <div class="p-2 col-md-12">
          <input type="text" name="teacher_name" class="form-control" placeholder="Teacher Full Name">
        </div>
      </div>
      <button type="submit" name="teacher_add" class="btn btn-primary">Submit</button>
    </form>

    
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
