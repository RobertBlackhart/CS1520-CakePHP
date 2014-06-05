<?php
/**
 * Robert McDermot
 * rom66@pitt.edu
 * Date: 3/4/14
 * Time: 10:19 PM
 */
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
	public $validate = array(
		'username' => array('rule' => 'notEmpty'),
		'password' => array('rule' => 'notEmpty')
	);

	public $hasMany = array(
		'MessageSent' => array(
			'className' => 'Message',
			'foreignKey' => 'user_id'
		),
		'MessageReceived' => array(
			'className' => 'Message',
			'foreignKey' => 'from_id'
		), 'Review', 'Comment'
	);

	public function beforeSave($options = array())
	{
		if(isset($this->data[$this->alias]['password']))
		{
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
	}
}

?>