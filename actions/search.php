<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Start a logbook">
    <meta name="author" content="GetBusy LLC. <support@getbusypro.com>">
    <link rel="icon" href="../img/favicon.ico">

    <title>Hamlog</title>

    <!-- Stylesheets for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/hamlog.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400|Anonymous+Pro" rel="stylesheet">

    <script src="https://use.fontawesome.com/8f4ddbac7d.js"></script>

    <!-- Core Javascript -->
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/collapse.js"></script>
    <script src="../js/utctime.js"></script>

  </head>

  <body onload="loadCount()">

    <div class="jumbotron hamlog-head text-center">
      <div class="container">
        <h3>Hello. Insert fancy stuff here.</h3>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-lg-offset-1 col-md-offset-1 col-sm-12 col-xs-12 hamlog-hd-2">
          <div class="panel panel-default">
            <div class="panel-body">
              <strong>Welcome to Hamlog.</strong>
              <p id="outputLog"></p>

              <script>
              function loadCount() {
                var x = document.getElementById("logTable").rows.length - 1;
                document.getElementById('outputLog').innerHTML = "Your search returned <strong>" + x + "</strong> record(s)";
                }
              </script>
              <p><a href="../index.php">Return Home</a></p>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-body">
              <strong>New Search</strong>
              <form role="search" method="GET" action="search.php">
                <div class="input-group add-on">
                  <input class="form-control input-sm" placeholder="Search by Callsign" name="query" id="query" type="text">
                  <div class="input-group-btn">
                    <button class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 hamlog-hd-2">
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
                      $con= new mysqli("localhost","root","root","hamlog");
                      $search = $_GET['query'];
                      //$query = "SELECT * FROM employees
                     // WHERE first_name LIKE '%{$name}%' OR last_name LIKE '%{$name}%'";

                      // Check connection
                      if (mysqli_connect_errno())
                        {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }

                  $result = mysqli_query($con, "SELECT * FROM logbook
                      WHERE callsign LIKE '%$search%' ORDER BY date DESC");

                      while ($row = mysqli_fetch_array($result))
                  {
                            echo  "<tr><td>" . $row["callsign"] . "</td>" . "<td>" . $row["date"] . "</td>" . "<td>" . $row["time"] . "</td>" . "<td>" . $row["frequency"] . "</td>" . "<td>" . $row["mode"]
                            . "</td>" . "<td>" . $row["notes"] . "</td><td>" . '<a href="delete_entry.php?id=' . $row["id"] . '"' . "><i class='fa fa-trash'></i></a></td>" . "</tr>";

                  }

                      mysqli_close($con);
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>


      <!-- Core Javascript -->
      <script src="../js/bootstrap.js"></script>
      <script src="../js/jquery.js"></script>


  </body>

</html>
