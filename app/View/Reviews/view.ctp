<?php
echo $this->Html->link('<-- Back to all reviews', array('action' => 'index'));
echo "<br><br>";
echo "<h2>" . $review['Review']['title'] . "</h2><br>";
echo "<h1>By: " . $review['User']['username'] . "</h1>";
echo $review['Review']['created'] . "<br>";
echo "<h1>Rating: " . $review['Review']['rating'] . "<h1>";
echo "<h1>Type: " . $review['Review']['media'] . "<h1>";
echo $review['Review']['body'] . "<br><br><br>";
echo $this->Html->link('Send a message to ' . $review['User']['username'], array('controller' => 'messages', 'action' => 'add', $review['User']['id'], $userid));
echo "<br><br>Comments:<br><br>";
foreach ($review['Comment'] as $comment)
{
	echo $comment['body'] . "<br><br>";
	echo "by: " . $comment['username'] . "  ";
	if($username == $comment['username'])
	{
		echo $this->Html->link(
			'Edit',
			array('controller' => 'comments', 'action' => 'edit', $comment['id'], $review['Review']['id'])
		);
		echo " ";
		echo $this->Form->postLink(
			'Delete',
			array('controller' => 'comments', 'action' => 'delete', $comment['id'], $review['Review']['id']),
			array('confirm' => 'Are you sure?')
		);
	}
	echo "<br>";
	echo "Created: " . $comment['created'];
	echo "<hr>";
}
echo "<br>";
echo $this->Html->link('Add a new comment', array('controller' => 'comments', 'action' => 'add', $review['Review']['id']));
?>
