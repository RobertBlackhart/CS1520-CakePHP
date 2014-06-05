<?php
echo $this->Html->link('<-- Back to all reviews', array('controller' => 'reviews', 'action' => 'index'));
echo "<br><br>";
echo "<h2>Messages</h2>";
echo "Logged in as " . $username;
echo "<br />";
echo $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout'));
?>

	<table>
		<tr>
			<th>Title</th>
			<th>From</th>
			<th>Options</th>
			<th>Created</th>
		</tr>

		<!-- Here is where we loop through our $reviews array, printing out post info -->

		<?php foreach($messages as $message): ?>
			<tr>
				<td>
					<?php echo $this->Html->link($message['Message']['title'],
						array('controller' => 'messages', 'action' => 'view', $message['Message']['id'])); ?>
				</td>
				<td><?php echo $message['Sender']['username']; ?></td>
				<td>
					<?php
					echo $this->Form->postLink(
						'Delete',
						array('action' => 'delete', $message['Message']['id']),
						array('confirm' => 'Are you sure?')
					);
					?>
				</td>
				<td><?php echo $message['Message']['created']; ?></td>
			</tr>
		<?php
		endforeach;
		unset($message);
		?>
	</table>
<?php
?>