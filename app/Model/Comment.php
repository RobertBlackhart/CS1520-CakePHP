<?php
/**
 * Robert McDermot
 * rom66@pitt.edu
 * Date: 3/4/14
 * Time: 10:23 PM
 */
class Comment extends AppModel
{
    public $belongsTo = array('User', 'Review');

    public $validate = array(
        'body' => array('rule' => 'notEmpty')
    );
}