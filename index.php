<?php 
$output = NULL;

$keyword = (isset($_POST['keyword']))?$_POST['keyword']:"";
$keyhtml = htmlspecialchars($keyword, ENT_QUOTES, "UTF-8");
$location = (isset($_POST['location']))?$_POST['location']:"";
$category = (isset($_POST['category']))?$_POST['category']:"";

require_once('php/initialize.php');
require_once('php/utilities.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/home.css" type="text/css">
</head>
<body>
<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="php/page-create-events.php">Create Events</a>
  <a href="#about">About</a>
  <a href="#contact">Contact</a>
  <div class="search-container">
    <form action="index.php" method="post">
      <input type="text"  name="keyword" <?php if (isset($keyword) && $keyword != "") {echo "value='$keyhtml'";} else {echo "placeholder=Search..";} ?>>
		<select name="location">
			<option value='' <?php if ($location == "") {echo ' selected ';} ?> >Location...</option>
			<?php 	$optionArr = array('losangeles' => 'Los Angeles', 'newyork' => 'New York', 'philadelphia' => 'Philadelphia',
							'houston' => 'Houston');
					echo gen_select_opts($location,$optionArr); 
			?>
		</select>
		<select name="category">
			<option value='' <?php if ($category == "") {echo ' selected ';} ?> >Category...</option>
			<?php 	
				$optionArr = array('sport' => 'Sport', 'hospitality' => 'Hospitality', 'music' => 'Music');
				echo gen_select_opts($category, $optionArr);
			?>
		</select>
		
		<button type="submit" name="submit"><i class="fa fa-search"></i></button>
    </form>

  </div>
  
</div>
<div class="home_message">
<h2> Search for events by keywords, location or category ... </h2>
</div>
<?php
if (isset($_POST['submit'])) {
	require_once('php/event_management.php');
	include 'php/view.php';
}
?>
</body>
</html>

