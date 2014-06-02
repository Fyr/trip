<?php
App::uses('AdminController', 'Controller');
class AdminUserGroupsController extends AdminController {
    public $name = 'AdminUserGroups';
    public $uses = array('UserGroup');
    
    public function beforeRender() {
    	parent::beforeRender();
    	$this->set('objectType', 'UserGroup');
    }
    
    public function index() {
    	$this->paginate = array(
    		'fields' => array('id', 'title')
    	);
    	$this->PCTableGrid->paginate('UserGroup');
    }
    
    public function edit($id = 0) {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($id) {
				$this->request->data('UserGroup.id', $id);
			}
			if ($this->UserGroup->save($this->request->data)) {
				$id = $this->UserGroup->id;
				$baseRoute = array('action' => 'index');
				return $this->redirect(($this->request->data('apply')) ? $baseRoute : array($id));
			}
		} elseif ($id) {
			$userGroup = $this->UserGroup->findById($id);
			$this->request->data = $userGroup;
		}
    }
}
