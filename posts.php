<?php

$topic_id = filter_input(INPUT_GET, 'topic_id', FILTER_SANITIZE_NUMBER_INT);
$topic_name = filter_input(INPUT_GET, 'topic_name', FILTER_SANITIZE_STRING);
if (empty($topic_id) || empty($topic_name)) {
	header('location: index.php');
	exit;
}

include 'inc/header.php';
require 'inc/functions.php';

echo $topic_name . '<br>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$post_title = trim(filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_STRING));
	if (empty($post_title)) {
		echo 'Please fill out all of the fields.<br>';
	} else {
		createPost($topic_id, $post_title); // In functions.php
	}
}

displayPosts($topic_id); // In functions.php

?>

<form method="post" action="posts.php?topic_id=<?php echo $topic_id; ?>&topic_name=<?php echo $topic_name; ?>">
  Submit a new post:<br>
  <textarea name="post_title" id="post_title"></textarea><br>
  <input type="submit" name="submit" id="submit" value="Submit Post">
</form>

<?php
include 'inc/footer.php';