<?php

include 'inc/header.php';
require 'inc/functions.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$topic_name = trim(filter_input(INPUT_POST, 'topic_name', FILTER_SANITIZE_STRING));
	$topic_desc = trim(filter_input(INPUT_POST, 'topic_desc', FILTER_SANITIZE_STRING));
	if (empty($topic_name) || empty($topic_desc)) {
		echo 'Please fill out all of the fields.<br>';
	} else {
		createTopic($topic_name, $topic_desc); // In functions.php
	}
}

displayTopics(); // In functions.php

?>

<form method="post" action="index.php">
  Create a new topic:<br>
  <input type="text" name="topic_name" id="topic_name"><br>
  Enter topic description:<br>
  <input type="text" name="topic_desc" id="topic_desc"><br>
  <input type="submit" name="submit" id="submit" value="Create">
</form>

<?php
include 'inc/footer.php';