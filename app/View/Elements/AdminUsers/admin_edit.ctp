<?
	echo $this->PHForm->input('User.user_group_id', array('class' => 'input-medium', 'options' => $groups));
	echo $this->PHForm->input('User.username', array('class' => 'input-medium'));
	echo $this->PHForm->input('User.first_name', array('class' => 'input-medium'));
	echo $this->PHForm->input('User.middle_name', array('class' => 'input-medium'));
	echo $this->PHForm->input('User.last_name', array('class' => 'input-medium'));
	echo $this->PHForm->input('User.email', array('class' => 'input-medium'));
	echo $this->PHForm->input('User.phone', array('class' => 'input-medium'));
    echo $this->PHForm->input('User.password', array(
    	'class' => 'input-medium', 
    	'required' => false,
    	'label' => array('text' => __('Change password'), 'class' => 'control-label')
    ));
    echo $this->PHForm->input('User.password_confirm', array('class' => 'input-medium', 'type' => 'password', 'required' => false));
    echo $this->PHForm->input('User.active');