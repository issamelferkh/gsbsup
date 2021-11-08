<?php include_once("./../includes/header.php"); ?>
<?php include_once '../config/connection.php'; ?>
<?php include_once("./../includes/navbar.php"); ?>
<?php include_once("./../includes/nav_scroller_absence.php"); ?>

<main class="container">
  <?php include_once("./../includes/title.php"); ?>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Check Absence</h6>
    <form method="POST" action="absence_check_script.php">
      <div class="row">

        <div class="p-2 col-md-6">
          Select a Class
          <select name="id_class" class="form-select" required>
            <!-- Fech Class Data -->
            <?php
              $q = "SELECT * FROM `class`"; //q = query
              $q = $db->query($q);
              $q->execute();
              $c = $q->rowCount(); //c = count
              $r = $q->fetchAll(PDO::FETCH_ASSOC); // r = row
              $i = 0; // i = index
              while ($i < $c) {
                echo "
                  <option value='".$r[$i]["id_class"]."'>".$r[$i]["class_name"]."</option>
                    ";
                $i++;
              }
            ?>
          </select>
        </div>

        <div class="p-2 col-md-6">
          Month
          <input type="month" name="absence_date" class="form-control" required>
        </div>

      </div>
      <button type="submit" name="absence_check" class="btn btn-primary">Submit</button>
    </form>
      </div>
  </div>
</main>

<?php include_once("./../includes/footer.php"); ?>
