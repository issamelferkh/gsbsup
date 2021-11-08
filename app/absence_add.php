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
<?php include_once("./../includes/nav_scroller_absence.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Class List</h6>
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
$q = "SELECT * FROM `class`"; //q = query
$q = $db->query($q);
$q->execute();
$c = $q->rowCount(); //c = count
$r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
$i = 0; // i = index

while ($i < $c) {
  $query2 = 'SELECT * FROM `teacher` WHERE `id_teacher` = "'.$r[$i]["id_teacher"].'"';
  $result2 = $db->query($query2);
  $row2 = $result2->fetch(PDO::FETCH_ASSOC);

  echo "
    <tr>
      <td><a href='absence_add_script.php?id=".$r[$i]["id_class"]."' class='btn btn-primary'>A</a> ".$r[$i]["class_name"]."</td>
      <td>".$row2["teacher_name"]."</td>
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

