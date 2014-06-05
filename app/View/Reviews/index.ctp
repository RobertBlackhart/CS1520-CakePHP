<h2>Reviews</h2>
<?php
if(!$username)
{
	echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
	echo " or ";
	echo $this->Html->link('Create a new user', array('controller' => 'users', 'action' => 'add'));
} else
{
	echo "Logged in as " . $username;
	echo "<br />";
	echo $this->Html->link('View your messages', array('controller' => 'messages', 'action' => 'index'));
	echo "<br />";
	echo $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout'));
}
?>

<table>
	<tr>
		<th>Title</th>
		<th>By</th>
		<th>Rating</th>
		<th>Media</th>
		<th>Options</th>
		<th>Created</th>
	</tr>

	<!-- Here is where we loop through our $reviews array, printing out post info -->

	<?php foreach($reviews as $review): ?>
		<tr>
			<td>
				<?php echo $this->Html->link($review['Review']['title'],
					array('controller' => 'reviews', 'action' => 'view', $review['Review']['id'])); ?>
			</td>
			<td><?php echo $review['User']['username']; ?></td>
			<td><?php echo $review['Review']['rating']; ?></td>
			<td><?php echo $review['Review']['media']; ?></td>
			<?php if($username == $review['User']['username'])
			{ ?>
				<td>
					<?php
					echo $this->Html->link(
						'Edit',
						array('action' => 'edit', $review['Review']['id'])
					);
					?>
					<?php
					echo $this->Form->postLink(
						'Delete',
						array('action' => 'delete', $review['Review']['id']),
						array('confirm' => 'Are you sure?')
					);
					?>
				</td>
			<?php } else echo "<td></td>"; ?>
			<td><?php echo $review['Review']['created']; ?></td>
		</tr>
	<?php
	endforeach;
	unset($review);
	?>
</table>
<?php
echo "<br><br>";
echo $this->Html->link('Add Review', array('controller' => 'reviews', 'action' => 'add'));
?>