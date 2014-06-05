<?php
echo $this->Html->link('<-- Back to all messages', array('action' => 'index'));
echo "<br><br>";
echo "<h2>" . $message['Message']['title'] . "</h2><br>";
echo "<h1>From: " . $message['Sender']['username'] . "</h1>";
echo $message['Message']['created'] . "<br><br>";
echo $message['Message']['body'] . "<br><br><br>";
echo $this->Html->link('Send a reply to ' . $message['Sender']['username'], array('controller' => 'messages', 'action' => 'add', $message['Sender']['id'], $message['Recipient']['id']));
?>
