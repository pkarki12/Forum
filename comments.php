<?php

$post_id = filter_input(INPUT_GET, 'post_id', FILTER_SANITIZE_NUMBER_INT);
$post_title = filter_input(INPUT_GET, 'post_title', FILTER_SANITIZE_STRING);
if (empty($post_id) || empty($post_title)) {
	header('location: index.php');
	exit;
}

include 'inc/header.php';
require 'inc/functions.php';

echo '<div class="panel"><strong>Post: </strong><br>' . $post_title . '</div>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$comment_body = trim(filter_input(INPUT_POST, 'comment_body', FILTER_SANITIZE_STRING));
	if (empty($comment_body)) {
		echo '<div class="alert">Please fill out all of the fields.</div>';
	} else {
		createComment($post_id, $comment_body); // In functions.php
	}
}

displayComments($post_id);

?>

<form method="post" class="panel" action="comments.php?post_id=<?php echo $post_id; ?>&post_title=<?php echo $post_title; ?>">
  Leave a comment:<br>
  <textarea name="comment_body" id="topic_desc_form"></textarea><br>
  <input type="submit" name="submit" id="submit" value="Post comment">
</form>

<?php
include 'inc/footer.php';