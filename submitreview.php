<?php include 'pullasession.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <link rel="stylesheet" href="pulla.css">
</head>
<header id="review-header">
<nav>
    <h1>Submit a review</h1>
    <div id="links">
    <a href="pulla.php">Back to homepage</a>
    <?php
        if ($logged_in == false) {
        echo "<a href='login.php'>Login to submit a review</a>";
      } else {
       echo "<a href='logout.php'> Log out </a>";
      };
        ?>
        </div>
        
</nav>
</header>

<body>

<?php


$name=$partoftown=$address=$date=$review="";

function test_inputs($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER['REQUEST_METHOD']=='POST') {
    $name = test_inputs($_POST["bakeryname"]);
    $partoftown = test_inputs($_POST["partoftown"]);
    $address = test_inputs($_POST["address"]);
    $date = test_inputs($_POST["date"]);
    $review = test_inputs($_POST["review"]);
    include "pullaconnect.php";
$query = "INSERT INTO reviews(bakeryname,partoftown,address,review,datereviewed)";
$query .= "VALUES ('$name', '$partoftown','$address','$review','$date')";

$result = mysqli_query($connection, $query);

if (!$result) {
  die('Query insertion failed');
}
}
?>

<?php
 if ($_SERVER['REQUEST_METHOD'] == "POST") {
  echo 'Thank you for your review!';
} else {
  ?> 
  <form id="review-form" method="post">
  <label for="bakery">Bakery</label>
  <input type="text" id="bakery" name="bakeryname" maxlength="60" required>
 <label for="address">Address</label>
 <input type="text" id="address" name="address" maxlength="200"required>
 <label for="partoftown">Part of town</label>
 <input type="text" id="partoftown" name="partoftown" maxlength="120" required>
 <label for="date">Date</label>
 <input type="date" id="date" name="date" required>
 <label for="review">Review</label>
 <input type="text" id="review" name="review" maxlength="600"required>
  <input type="submit" name="submit" value="Submit Review">
  </form>
  <?php
}

?>

</body>
</html>