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
<?php include_once("./../includes/nav_scroller_teacher.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Teacher List</h6>
    <div class="table-wrapper">
      <!-- <table id="table_id" class="display"> -->
      <table id="table_id" class="display">
        <thead>
          <tr>
            <th>Stdent Name</th>
          </tr>
        </thead>
        <tbody>
          <?php
$q = "SELECT * FROM `teacher`"; //q = query
$q = $db->query($q);
$q->execute();
$c = $q->rowCount(); //c = count
$r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
$i = 0; // i = index

while ($i < $c) {
  echo "
    <tr>
      <td><center><a href='teacher_details.php?id=".$r[$i]["id_teacher"]."' class='btn btn-success'>M</a> ".$r[$i]["teacher_name"]."</center></td>
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

