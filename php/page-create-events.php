<?php 
$category = (isset($_POST['category']))?$_POST['category']:"";
$submitted = (isset($_POST["submit"]))?"submitted":"not submitted";

echo "Hello world222 $submitted";
require_once('initialize.php');
require_once('utilities.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/home.css" type="text/css">

<style>

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.event_creation_div {
	width: 90%;
	margin: auto;
}
h1 {
	color: green;
}
.label_block {
	padding-top: 15px;
	display: block;
	font-size: 1.3rem;
	font-weight: 600;
	color: orange;
}

.label_inline {
	padding-top: 15px;
	font-size: 1.3rem;
	font-weight: 600;
	color: orange;
	width: 20%;
}

input[type=text], textarea, select {
	font-size: 17px;
    width: 100%;
    padding: 12px 20px;
    margin: auto; /*8px 0; */
    display: block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=date], input[type=file] {	
	font-size: 17px;
	width: 40%;
    padding: 12px 20px;
    margin-top: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
     width: 100%;
    background-color: #4CAF50;
    color: white;
	font-size: 1.5rem;
	font-weight: 600;

    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

select {
  margin-bottom: 1em;
  font-size: 17px;

  border: 1;
  border-bottom: 2px solid currentcolor; 
  letter-spacing: .15em;
  border-radius: 0;
  &:focus, &:active {
    outline: 0;
    border-bottom-color: red;
  }
}
option:first-child {
  color: LightGray;
}

@media screen and (max-width: 740px) {

  input, textarea, select, .label_block, .label_inline {
    float: none;
    display: block; 
    text-align: left;
    width: 100%;
    margin: 0;
    padding-bottom: 14px;
	/*padding-top: 14px; */
	}
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}


</style>

</head>
<body>

<div class="topnav">
  <a href="../index.php">Home</a>
  <a class="active" href="create-events.php">Create Events</a>
  <a href="#about">About</a>
  <a href="#contact">Contact</a>  
</div>

<div class="event_creation_div">
 <h1>Event Creation Form</h1>

  <form action="page-create-events.php" method="post" class="event_creation_form" enctype="multipart/form-data">
    <label class="label_block" for="id_eventname">Event Name <span style="color:red">*</span></label> 
    <input type="text" id="id_eventname" name="eventname" placeholder="Event name..">

    <label class="label_block" for="id_eventlocation">Location<span style="color:red">*</span></label>
    <input type="text" id="id_eventlocation" name="eventlocation" placeholder="Location..">
	<label class="label_inline" for="id_start_date">Start Date</label> <input type="date" name="event_start_date" id="id_start_date">
	<label class="label_inline" for="id_end_date">Start Date</label> <input type="date" name="event_end_date" id="id_end_date">

    <label class="label_block" for="id_eventdescription">Description <span style="color:red">*</span></label>
    <textarea type="text" rows="4" id="id_eventdescription" name="eventdescription" placeholder="Description.."> </textarea>
    <label class="label_block" for="id_eventcategory">Category</label>
		<select id="id_eventcategory" name="eventcategory">
			<option value='' <?php if ($category == "") {echo ' selected ';} ?> >Category...</option>
			<?php 	
				$optionArr = array('Sport' => 'Sport', 'Hospitality' => 'Hospitality', 'Music' => 'Music');
				echo gen_select_opts($category, $optionArr);
			?>
		</select>
		
	  <label class="label_inline" for="fileToUpload">File to upload </label> 
	  <input type="file" name="fileToUpload" id="fileToUpload">
	
    <input type="submit" value="Submit" name="submit">
  </form>
</div>

</body>
</html>

<?php

if(isset($_POST["submit"])) {
		require_once('event_management.php');

	$eventName = (isset($_POST['eventname'])?$_POST['eventname']:"");
	$eventLocation = (isset($_POST['eventlocation'])?$_POST['eventlocation']:"");
	$eventStartDate = (isset($_POST['event_start_date'])?$_POST['event_start_date']:"");
	$eventEndDate = (isset($_POST['event_end_date'])?$_POST['event_end_date']:"");
	$eventDescription = (isset($_POST['eventdescription'])?$_POST['eventdescription']:"");
	$eventCategory = (isset($_POST['eventcategory'])?$_POST['eventcategory']:"");
	$eventFileName = $_FILES["fileToUpload"]["name"];
	echo "eventFileName=$eventFileName<br>";
	$eventManager = new EventManagement($eventsDatabase);
	$eventManager->create_event($eventName, $eventLocation, $eventCategory, 
								$eventStartDate, $eventStartDate, $eventDescription, $eventFileName);
}


function uploadFile() {
		echo "Executing uploadFilexxx";

		if(! isset($_POST["submit"])) { return; }
		
	echo "Executing uploadFile";
	$target_dir = UPLOAD_PATH . "/"; /*"../uploads/"; */
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
echo "Hello world";
//uploadFile();


?>


