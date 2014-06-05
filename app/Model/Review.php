<?php

/**
 * Robert McDermot
 * rom66@pitt.edu
 * Date: 3/4/14
 * Time: 10:08 PM
 */
class Review extends AppModel
{
	public $belongsTo = 'User';
	public $hasMany = 'Comment';

	public $validate = array(
		'title' => array('rule' => 'notEmpty'),
		'body' => array('rule' => 'notEmpty'),
		'rating' => array('rule' => 'notEmpty'),
		'media' => array('rule' => 'notEmpty')
	);
}

?>