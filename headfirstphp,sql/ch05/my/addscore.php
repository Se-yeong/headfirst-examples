<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Guitar Wars - Add Your High Score</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Guitar Wars - Add Your High Score</h2>
  <p>Welcome, Guitar Warrior, do you have what it takes to crack the high score list? If so, just <a href="addscore.php">add your own score</a>.</p>
  <hr>
<?php

  require_once('appvars.php');

  if (isset($_POST['submit'])) {
    // Grab the score data from the POST
    $name = $_POST['name'];
    $score = $_POST['score'];
    $screenshot = $_FILES['screenshot']['name'];
    $screenshot_size = $_FILES['screenshot']['size'];
    $screenshot_type = $_FILES['screenshot']['type'];

    if (!empty($name) && !empty($score) && !empty($screenshot)) {
      if(($screenshot_type == 'image/gif' || $screenshot_type == 'image/jpeg' || $screenshot_type == 'image/pjpeg' || $screenshot_type == 'image/png') && ($screenshot_size <= GW_MAXFILESIZE) &&
        ( $screenshot_size > 0) ){
        if($_FILES['file']['error'] == 0){
                // Connect to the database
          $screenshot = time() . $screenshot;
          $target = GW_UPLOADPATH. $screenshot;

          if(move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)){
            $dbc = mysqli_connect('localhost', 'root', 'glwlsl10', 'headfirst');

            // Write the data to the database
            $query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$screenshot')";
            mysqli_query($dbc, $query);

            // Confirm success with the user
            echo '<p>Thanks for adding your new high score!</p>';
            echo '<p><strong>Name:</strong> ' . $name . '<br />';
            echo '<strong>Score:</strong> ' . $score . '</p>';
            echo '<p><image src ="' . $target . '" alt="Score image"></p>';
            echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';
            // Clear the score data to clear the form
            mysqli_close($dbc);

            $name = "";
            $score = "";
            $screenshot = "";
          }
          else{
            echo '<p class="error">Sorry, there was a problem uploading your screen shot image. Please upload another image.</p>';
          }

        }


      }
      else{
        echo '<p class="error">Sorry, the screen shot must be a GIF, JEPG, or PNG image file no greater than'.(GW_MAXFILESIZE/1024).'KB in size. Please upload another image.</p>';
      }
      @unlink($_FILES['screenshot']['tmp_name']);




    }
    else {
      echo '<p class="error">Please enter all of the information to add your high score.</p>';
    }
  }
?>

  <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="32768">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
    <label for="score">Score:</label>
    <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" />
    <input type="file" id="screenshot" name="screenshot">
    <hr />
    <input type="submit" value="Add" name="submit" />
  </form>
</body>
</html>
