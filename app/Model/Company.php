<?php
App::uses('AppModel', 'Model');
class Company extends AppModel {
    public $validate = array(
	'name' => array(
	    'checkNotEmpty' => array(
		'rule' => 'notEmpty'
	    )
	),
	'address' => array(
	    'checkNotEmpty' => array(
		'rule' => 'notEmpty'
	    )
	),
	'phone' => array(
	    'checkNotEmpty' => array(
		'rule' => 'notEmpty'
	    )
	),
	'email' => array(
	    'checkNotEmpty' => array(
		'rule' => 'notEmpty'
	    )
	),
    );
}