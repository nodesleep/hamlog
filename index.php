<?php
$connect = mysqli_connect("localhost", "root", "root", "hamlog");
$record_per_page = 8;
$page = '';
if(isset($_GET["page"]))
{
 $page = $_GET["page"];
}
else
{
 $page = 1;
}

$start_from = ($page-1)*$record_per_page;

$query = "SELECT * FROM logbook order by date DESC LIMIT $start_from, $record_per_page";
$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Start a logbook">
    <meta name="author" content="Matthew Sweet <themattbook@gmail.com>">
    <link rel="icon" href="img/favicon.ico">

    <title>Hamlog</title>

    <!-- Stylesheets -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/hamlog.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400|Anonymous+Pro" rel="stylesheet">

    <script src="https://use.fontawesome.com/8f4ddbac7d.js"></script>

    <!-- Core Javascript -->
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/collapse.js"></script>
    <script src="js/utctime.js"></script>

  </head>

  <body onload="loadCount()">

    <div class="jumbotron hamlog-head text-center">
      <div class="container">
        <h3>Hello. Insert fancy stuff here.</h3>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-lg-offset-1 col-md-offset-1 col-sm-12 col-xs-12 hamlog-hd-3">
          <div class="panel panel-default">
            <div class="panel-body">
              <form role="search" method="GET" action="actions/search.php">
                <div class="input-group add-on">
                  <input class="form-control input-sm" placeholder="Search by Callsign" name="query" id="query" type="text">
                  <div class="input-group-btn">
                    <button class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-body">
              <strong>Welcome to Hamlog.</strong>
              <p>
                <?php

                $sql="SELECT * FROM logbook";

                if ($records=mysqli_query($connect,$sql))
                  {
                  // Return the number of rows in result set
                  $rowcount=mysqli_num_rows($records);
                  printf("There are currently <strong>%d</strong> contact(s) logged.\n",$rowcount);
                  }

                ?>
                <br \>
                <?php

                $sql = "SELECT id, callsign, date FROM logbook ORDER BY id DESC LIMIT 1";
                $recent = $connect->query($sql);

                if ($recent->num_rows > 0) {
                    // output data of each row
                    while($row = $recent->fetch_assoc()) {
                      printf("Most recent entry was <strong>" . $row['callsign'] . "</strong> on <strong>" . $row['date'] . "</strong>");
                    }
                } else {
                    echo "You haven't made any entries yet.";
                }

                ?>
              </p>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-body">
              <strong>Current/Universal Time:</strong>
              <p><span id="local"></span><br \><span id="universal"></span></p>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-body">
              <p><strong>User Options</strong></p>
              <p><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#entryModal"><i class="fa fa-plus"></i> Add Logbook Entry</button> <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#helpModal">Need Help?</button></p>
            </div>
          </div>
        </div>

        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 hamlog-hd-3">
          <div class="panel panel-default">
            <div class="panel-body">
              <table class="table table-hover table-striped" id="logTable">
                <thead>
                  <tr>
                    <th>Callsign</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Frequency</th>
                    <th>Mode</th>
                    <th>Notes (Signal report, Comments)</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while($row = mysqli_fetch_array($result))
                  {
                  ?>
                  <tr>
                   <td><?php echo $row["callsign"]; ?></td>
                   <td><?php echo $row["date"]; ?></td>
                   <td><?php echo $row["timesent"]; ?></td>
                   <td><?php echo $row["frequency"]; ?></td>
                   <td><?php echo $row["mode"]; ?></td>
                   <td><?php echo $row["notes"]; ?></td>
                   <td><?php echo "<a href='actions/delete_entry.php?id=" . $row["id"] . "'</a><i class='fa fa-trash'></i>"; ?></td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>

              <div class="col-md-12 text-center">
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                      <?php
                      $page_query = "SELECT * FROM logbook ORDER BY date ASC";
                      $page_result = mysqli_query($connect, $page_query);
                      $total_records = mysqli_num_rows($page_result);
                      $total_pages = ceil($total_records/$record_per_page);
                      $start_loop = $page;
                      $difference = $total_pages - $page;
                      if($difference <= 5)
                      {
                       $start_loop = $total_pages - 0;
                      }
                      $end_loop = $start_loop + 4;
                      if($page > 1)
                      {
                       echo "<li><a href='index.php?page=1'>First</a></li>";
                       echo "<li><a href='index.php?page=".($page - 1)."'><<</a></li>";
                      }
                      for($i=$start_loop; $i<=$end_loop; $i++)
                      {
                       echo "<li><a href='index.php?page=".$i."'>".$i."</a></li>";
                      }
                      if($page <= $end_loop)
                      {
                       echo "<li><a href='index.php?page=".($page + 1)."'>>></a></li>";
                       echo "<li><a href='index.php?page=".$total_pages."'>Last</a></li>";
                      }


                      ?>
                  </ul>
                </nav>
              </div>

            </div>
          </div>

        </div>
      </div>

    <div class="modal fade" id="entryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <form method="POST" class="entryform" action="actions/enter_log.php">
              <div class="form-group">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Entry</h4>
              </div>
              <div class="form-group">
                <label for="frequency">Callsign</label>
                <input type="text" class="form-control" required name="callsign" placeholder="Their callsign">
              </div>
              <div class="form-group">
                <label for="frequency">Date</label>
                <input type="text" class="form-control" required name="date" placeholder="Date in YYYY-MM-DD format">
              </div>
              <div class="form-group">
                <label for="frequency">Time</label>
                <input type="text" class="form-control" required name="timesent" placeholder="Time in GMT">
              </div>
              <div class="form-group">
                <label for="frequency">Frequency</label>
                <input type="text" class="form-control" required name="frequency" placeholder="Frequency in Mhz">
              </div>
              <div class="form-group">
                <label for="frequency">Mode</label>
                <input type="text" class="form-control" required name="mode" placeholder="Specify AM/FM/C4FM/SSB etc">
              </div>
              <div class="form-group">
                <label for="frequency">Notes</label>
                <input type="text" class="form-control" name="notes" maxlength="100" placeholder="Any notes you want to add">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Add Entry">
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-solid">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">How To Use</h3>
      </div>
          <div class="modal-body">
            <h4>Adding an Entry</h4>
            <p>To add an entry, simply click the <strong class="alert-success">"+ Add New Entry"</strong> button in <strong>User Options</strong> on the left. You will be given a popup prompting you for all of the relevant information required to make a complete entry. Upon saving, the page will automatically display your new entry.</p>
            <h4>Removing an Entry</h4>
            <p>To remove, simply click the trash can icon <strong class="alert-info">"<i class="fa fa-trash"></i>"</strong> on the furthest right column of the corresponding entry. The page will automatically display the updated information, with the entry no longer stored.</p>
            <h4>Something else?</h4>
            <p>Feel free to send me an email, by clicking this link here: <a href="mailto:themattbook@gmail.com">themattbook@gmail.com</a>. It may take me a little while to respond, but rest assured we'll figure the issue out and get it fixed.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Thanks, I got it!</button>
          </div>
        </div>
      </div>
    </div>


      <!-- Core Javascript -->
      <script src="js/bootstrap.js"></script>
      <script src="js/jquery.js"></script>


  </body>

</html>
