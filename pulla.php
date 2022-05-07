<?php 
include 'pullasession.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="pulla.css" />
    <title>Helsinki Pulla Connoisseur</title>
  </head>
  <body>
    <header>
      <nav>
        <h1>🧁 Helsinki Pulla Connoisseur</h1>
        <?php
        if ($logged_in == false) {
        echo "<a href='login.php'>Login to submit a review</a>";
      } else {
       echo "<a href='logout.php'> Log out </a>";
      };
        ?>
      </nav>
      <div id="pulla-intro">
        <p>
          Read and submit reviews of bakeries in Helsinki and find the best
          pulla in town.
        </p>
      </div>
    </header>

    <main>
      <div id="search">
        <form action="" method="GET">
        <p>Search by part of town</p>
        <select name="partoftown">
          <option disabled selected>Select an area</option>
          <?php include "pullaconnect.php";
          $reviews = mysqli_query($connection, "SELECT DISTINCT partoftown FROM reviews");

          while ($data = mysqli_fetch_array($reviews)) {
            echo "<option value='" . htmlspecialchars($data['partoftown']) ."'>" . htmlspecialchars($data['partoftown']) ."</option>";
          }
          ?>
        </select>

        <input type="submit" value="Find a bakery near me"/>
        <?php
        if(isset($_GET['partoftown'])) {
          $partoftown = $_GET['partoftown'];
          $results = mysqli_query($connection, "SELECT partoftown,datereviewed, bakeryname, address, review FROM reviews WHERE partoftown = '$partoftown'");
          while ($data = mysqli_fetch_array($results)) {
            echo "<div class='town-result'>" . htmlspecialchars($data['partoftown']) . "<br>" . htmlspecialchars($data['datereviewed']) . "<br>" . htmlspecialchars($data['bakeryname']) ."<br>" . htmlspecialchars($data['address']) . "<br>" . "<i>" . htmlspecialchars($data['review']) ."</i>" . "</div>";
          }
        }
        ?>
        </form>

        <form action="" method="GET">
        <p>Search by bakery</p>
        <select name="bakeryname">
        <option disabled selected>Select a bakery</option>
        <?php $bakeryreviews = mysqli_query($connection, "SELECT DISTINCT bakeryname FROM reviews");

while ($data = mysqli_fetch_array($bakeryreviews)) {
  echo "<option value='" . htmlspecialchars($data['bakeryname']) ."'>" . htmlspecialchars($data['bakeryname']) ."</option>";
}
        ?>
        </select>

        <input type="submit" value="Find a bakery"/>
        <?php
        if(isset($_GET['bakeryname'])) {
          $bakeryname = $_GET['bakeryname'];
          $results = mysqli_query($connection, "SELECT partoftown,datereviewed, bakeryname, address, review FROM reviews WHERE bakeryname = '$bakeryname'");
          while ($data = mysqli_fetch_array($results)) {
            echo "<div class='town-result'>" . htmlspecialchars($data['partoftown']) . "<br>" . htmlspecialchars($data['datereviewed']) . "<br>" . htmlspecialchars($data['bakeryname']) ."<br>" . htmlspecialchars($data['address']) . "<br>" . "<i>" . htmlspecialchars($data['review']) ."</i>" . "</div>";
          }
        }
        ?>
        </form>
      </div>
    </main>
    <footer>
      <div id="contact-us"></div>
    </footer>
  </body>
</html>
