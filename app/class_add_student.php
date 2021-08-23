<?php include_once("./../includes/header.php"); ?>
<?php include_once '../config/connection.php'; ?>
<script>
	$(document).ready( function () {
    $('#table_id').DataTable({
			responsive: true
		});
	} );
</script>

<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_class.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">class List</h6>
    <div class="table-wrapper">
      <!-- <table id="table_id" class="display"> -->
      <table id="table_id" class="display">
        <thead>
          <tr>
            <th>Class Name</th>
            <th>Teacher</th>
            <th>Subject</th>
          </tr>
        </thead>
        <tbody>
          <?php
$q = "SELECT * FROM `class` WHERE `student_name` = ''"; //q = query
$q = $db->query($q);
$q->execute();
$c = $q->rowCount(); //c = count
$r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
$i = 0; // i = index

while ($i < $c) {
  echo "
    <tr>
      <td><a href='class_add_student_script.php?id_class=".$r[$i]["id_class"]."&class_name=".$r[$i]["class_name"]."' class='btn btn-primary'>A</a> ".$r[$i]["class_name"]."</td>
      <td>".$r[$i]["teacher_name"]."</td>
      <td>".$r[$i]["subject_name"]."</td>
    </tr>
      ";
  $i++;
}
                          
          ?>
        </tbody>
      </table>


    </div>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>

