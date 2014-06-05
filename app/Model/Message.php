<?php
/**
 * Robert McDermot
 * rom66@pitt.edu
 * Date: 3/4/14
 * Time: 10:25 PM
 */
class Message extends AppModel
{
	public $belongsTo = array(
		'Sender' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'Recipient' => array(
			'className' => 'User',
			'foreignKey' => 'from_id'
		)
	);

    public $validate = array(
        'title' => array('rule' => 'notEmpty'),
        'body' => array('rule' => 'notEmpty')
    );
}