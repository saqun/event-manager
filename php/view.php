<link rel="stylesheet" href="css/view.css">

<?php 
$eventManager = new EventManagement($eventsDatabase);
$all_data = $eventManager->search($keyword, $location, $category);
?>
  
<table class="events_table">
  	  <tr class="tab_header">
        <th>IMG</th>
        <th>Description</th>
        <th>Category</th>
  	  </tr>
	  
<?php while ($row = mysqli_fetch_assoc($all_data)) { ?>

<tr class="tr_body">
<!--
  <td align="center" width="20%"> <img src="images/address.png" alt="Image" height="32" width="32"> </td>
  -->
  <td align="center" width="20%"> <div id="imgdiv"> <img src="images/address.png" alt="Image">  </div> </td>
  <td width="55%"> 
		<h3 class="event_name"> <?php echo h($row['name']); ?> </h3>
		<p class="event_location"> <?php echo h($row['location']); ?> </p>
		<p class="event_description"> <?php echo h($row['description']); ?> </p>
  </td>
  <td width="30%"> 
	<p class="event_category"> <?php echo h($row['category']); ?></p>
  	<p class="event_date"> <?php echo formatted_date($row['start']) . " : " .  formatted_date($row['finish']); ?> </p>
  </td>
</tr>
<?php } ?>
</table>

   <?php
	  $eventManager->free_data($all_data);
  ?>
  </div>
  

  