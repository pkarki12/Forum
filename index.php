<?php

include 'inc/header.php';
require 'inc/functions.php';

echo '<div id="subtitle">Select a Topic</div>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$topic_name = trim(filter_input(INPUT_POST, 'topic_name', FILTER_SANITIZE_STRING));
	$topic_desc = trim(filter_input(INPUT_POST, 'topic_desc', FILTER_SANITIZE_STRING));
	if (empty($topic_name) || empty($topic_desc)) {
		echo '<div class="alert">Please fill out all of the fields.</div>';
	} else {
		createTopic($topic_name, $topic_desc); // In functions.php
	}
}

displayTopics(); // In functions.php

?>

<form method="post" action="index.php" class="panel">
  Create a new topic:<br>
  <input type="text" name="topic_name" id="topic_name_form"><br>
  Enter topic description:<br>
  <textarea name="topic_desc" id="topic_desc_form"></textarea><br>
  <input type="submit" name="submit" id="submit" value="Create">
</form>

<?php
include 'inc/footer.php';