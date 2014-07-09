<?php
App::uses('AppModel', 'Model');
class Tag extends AppModel {
    public function beforeDelete($cascade = true) {
	
	parent::beforeDelete($cascade);
	
	App::import('model','Tags.TagObject');
	$this->bindModel(array('hasOne' => array('Tags.TagObject')));
	
	$this->TagObject = new TagObject();
	$this->TagObject->deleteAll(array('tag_id' => $this->id));
	
	return true;
    }
}