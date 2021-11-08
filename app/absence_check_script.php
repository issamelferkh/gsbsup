<?php include_once("./../includes/header.php"); ?>
<?php include_once '../config/connection.php'; ?>
<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_absence.php"); ?>

<script>
	$(document).ready( function () {
    $('#table_id').DataTable({
			responsive: true
		});
	} );
</script>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <?php
      if(isset($_POST["absence_check"])) {
        $id_class = $_POST['id_class'];
        $sql = 'SELECT * FROM `class` WHERE `id_class` like "'.$id_class.'"';
        $result = $db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
      }
    ?>
    <h6 class="border-bottom pb-2 mb-10">Manage Absence for the Class: <?= $row['class_name']; ?> in the Month: <?= $_POST['absence_date'] ;?></h6>
      <div class="table-wrapper">
        <table class="table table-bordered">
          <thead class="table-dark">
            <tr>
              <th scope="col">Student Name</th>
              <th scope="col">01</th>
              <th scope="col">02</th>
              <th scope="col">03</th>
              <th scope="col">04</th>
              <th scope="col">05</th>
              <th scope="col">06</th>
              <th scope="col">07</th>
              <th scope="col">08</th>
              <th scope="col">09</th>
              <th scope="col">10</th>
              <th scope="col">11</th>
              <th scope="col">12</th>
              <th scope="col">13</th>
              <th scope="col">14</th>
              <th scope="col">15</th>
              <th scope="col">16</th>
              <th scope="col">17</th>
              <th scope="col">18</th>
              <th scope="col">19</th>
              <th scope="col">20</th>
              <th scope="col">21</th>
              <th scope="col">22</th>
              <th scope="col">23</th>
              <th scope="col">24</th>
              <th scope="col">25</th>
              <th scope="col">26</th>
              <th scope="col">27</th>
              <th scope="col">28</th>
              <th scope="col">29</th>
              <th scope="col">30</th>
              <th scope="col">31</th>
            </tr>
          </thead>
          <tbody>
<?php
  if(isset($_POST["absence_check"])) {
    $id_class = $_POST['id_class'];
    $absence_month = strtotime($_POST['absence_date']);
    $absence_date = date('m', $absence_month);

    $query =' SELECT  `id_absence`, `absence`.`id_class`, `absence`.`id_student`, `absent`, `absence_date`, 
                      `class`.`class_name`, `student`.`student_name` 
              FROM `absence` 
              INNER JOIN `class` ON `class`.`id_class` = `absence`.`id_class` 
              INNER JOIN `student` ON `student`.`id_student` = `absence`.`id_student`
              WHERE `absence`.`id_class`  = "'.$id_class.'" AND MONTH(`absence_date`) = "'.$absence_date.'"
              GROUP BY `absence`.`id_student`
              ORDER BY `student`.`student_name`
            ';
    $query = $db->prepare($query);
    $query->execute();
    $c = $query->rowCount();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    $i = 0; 
    while ($i < $c) {
      echo "
          <tr>
            <th scope='row'>".$row[$i]['student_name']."</th>
          ";

      // Check absent days per student ############################################################
      $timestamp = strtotime($row[$i]['absence_date']);
      $absence_day = date('d', $timestamp);
      $day_c = 1;
      while ($day_c < 32) {
        $query2 =' SELECT * FROM `absence` 
              WHERE `id_student`  = "'.$row[$i]['id_student'].'" AND MONTH(`absence_date`) = "'.$absence_date.'" AND DAY(`absence_date`) = "'.$day_c.'"
            ';
        $query2 = $db->prepare($query2);
        $query2->execute();
        $c2 = $query2->rowCount();
        $row2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $i2 = 0; 
        if ($i2 < $c2 AND $row2[$i2]['absent']) {
            echo "<td>X</td>";
        } else {
          echo "<td></td>";
        }
       
        $day_c++;
      }




      



          

        // echo "
        //     <td>".$absent."</td>
            
        //     
        //     <td></td>
        //     <td></td>
        //     <td>X</td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td>X</td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td>X</td>
        //     <td></td>
        //     <td></td>
        //     <td>X</td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     ";

        echo "
          </tr>
          ";
      $i++;
    }
	}

?>

            
           
          </tbody>
        </table>
      </div>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
