<?php
App::uses('AppModel', 'Model');
App::uses('User', 'Model');
class Advertiser extends AppModel {
	
	public $belongsTo = array(
		'User'
	);
	
	public $validate = array(
		'username' => array(
			'checkNotEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Field is mandatory',
			),
			'checkNameLen' => array(
				'rule' => array('between', 5, 15),
				'message' => 'The name must be between 5 and 15 characters'
			),
			'checkIsUnique' => array(
				'rule' => 'isUnique',
				'message' => 'That name has already been taken'
			)
		),
		'email' => array(
			'checkEmail' => array(
				'rule' => 'email',
				'message' => 'Email is incorrect'
			),
			'checkIsUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This email has already been used'
			)
		)
	);
}
