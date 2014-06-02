<?php
App::uses('AdminController', 'Controller');
class AdminAdvertisersController extends AdminController {
    public $name = 'AdminAdvertisers';
    public $uses = array('Advertiser', 'User');
    
    public function beforeRender() {
    	parent::beforeRender();
    	$this->set('objectType', 'Advertiser');
    }
    
    public function index() {
    	$this->paginate = array(
    		'fields' => array('id', 'created', 'title', 'slug', 'teaser', 'active')
    	);
    	$this->PCTableGrid->paginate('Advertiser');
    }
    
    public function edit($id = 0) {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($id) {
				$this->request->data('Advertiser.id', $id);
			}
			if ($this->Advertiser->save($this->request->data)) {
				$id = $this->Advertiser->id;
				$baseRoute = array('action' => 'index');
				return $this->redirect(($this->request->data('apply')) ? $baseRoute : array($id));
			}
		} elseif ($id) {
			$data = $this->Advertiser->findById($id);
			$this->request->data = $data;
		}
		$this->set('users', $this->User->getOptions());
    }
}
