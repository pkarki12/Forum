<?php

function createTopic($name, $desc) {
	include 'inc/conf.php';
	// conf.php connects to database and
	// creates PDO called $forum

	$sql = "INSERT INTO Topics(topic_name, topic_desc) VALUES(?, ?)";

	try {
		$results = $forum->prepare($sql);
		$results->bindValue(1, $name, PDO::PARAM_STR);
		$results->bindValue(2, $desc, PDO::PARAM_STR);
		$results->execute();
	} catch (Exception $e) {
		echo "Error! ";
		echo $e->getMessage();
		return false;
	}

	return true;
}

function displayTopics() {
	include 'inc/conf.php';
	// conf.php connects to database and
	// creates PDO called $forum

	try {
		$sql = "SELECT * FROM Topics";
		$results = $forum->query($sql);
	} catch (Exception $e) {
		echo "Error! ";
		echo $e->getMessage();
		exit;
	}

	while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
		echo '<a href="posts.php?topic_id=' . $row['topic_id'] . '&topic_name=' . $row['topic_name'] . '">';
		echo $row['topic_name'] . '<br>';
		echo $row['topic_desc'] . '<br>';
		echo '</a><hr>';
	}
}

function createPost($topic, $title) {
	include 'inc/conf.php';
	// conf.php connects to database and
	// creates PDO called $forum

	$dt = date('Y-m-d H:i:s');

	$sql = "INSERT INTO Posts(topic_id, post_title, posted_on) VALUES(?, ?, '$dt')";

	try {
		$results = $forum->prepare($sql);
		$results->bindValue(1, $topic, PDO::PARAM_INT);
		$results->bindValue(2, $title, PDO::PARAM_STR);
		$results->execute();
	} catch (Exception $e) {
		echo "Error! ";
		echo $e->getMessage();
		return false;
	}

	return true;
}

function displayPosts($topic) {
	include 'inc/conf.php';
	// conf.php connects to database and
	// creates PDO called $forum

	try {
		$sql = "SELECT * FROM Posts WHERE topic_id = ?";
		$results = $forum->prepare($sql);
		$results->bindValue(1, $topic, PDO::PARAM_INT);
		$results->execute();
	} catch (Exception $e) {
		echo "Error! ";
		echo $e->getMessage();
		exit;
	}

	while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
		echo '<a href="comments.php?post_id=' . $row['post_id'] . '&post_title=' . $row['post_title'] . '">';
		echo $row['post_title'] . '<br>';
		echo $row['posted_on'] . '<br>';
		echo '</a><hr>';
	}
}

function createComment($post, $body) {
	include 'inc/conf.php';
	// conf.php connects to database and
	// creates PDO called $forum

	$dt = date('Y-m-d H:i:s');

	$sql = "INSERT INTO Comments(post_id, comment_body, commented_on) VALUES(?, ?, '$dt')";

	try {
		$results = $forum->prepare($sql);
		$results->bindValue(1, $post, PDO::PARAM_INT);
		$results->bindValue(2, $body, PDO::PARAM_STR);
		$results->execute();
	} catch (Exception $e) {
		echo "Error! ";
		echo $e->getMessage();
		return false;
	}

	return true;
}

function displayComments($post) {
	include 'inc/conf.php';
	// conf.php connects to database and
	// creates PDO called $forum

	try {
		$sql = "SELECT * FROM Comments WHERE post_id = ?";
		$results = $forum->prepare($sql);
		$results->bindValue(1, $post, PDO::PARAM_INT);
		$results->execute();
	} catch (Exception $e) {
		echo "Error! ";
		echo $e->getMessage();
		exit;
	}

	while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
		echo $row['comment_body'] . '<br>';
		echo $row['commented_on'] . '<br>';
		echo '<hr>';
	}
}