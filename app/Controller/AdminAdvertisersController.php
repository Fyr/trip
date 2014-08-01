<?php
App::uses('AdminController', 'Controller');
class AdminAdvertisersController extends AdminController {
    public $name = 'AdminAdvertisers';
    public $uses = array('Advertiser', 'User', 'Company');
    
    public function beforeRender() {
    	parent::beforeRender();
    	$this->set('objectType', 'Advertiser');
    }
    
    public function index() {
    	$this->paginate = array(
    		'fields' => array('id', 'created', 'title', 'slug', 'teaser', 'active'),
		'limit' => 50
    	);
    	$this->PCTableGrid->paginate('Advertiser');
    }
    
    public function edit($id = 0) {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($id) {
				$this->request->data('Advertiser.id', $id);
			}
			if ($this->Advertiser->save($this->request->data('Advertiser'))) {
				$id = $this->Advertiser->id;
				// <!-- company
				$this->request->data('Company.advertiser_id', $id);
				if ($companyId = $this->Company->findByAdvertiserId($id)) {
				    $this->request->data('Company.id', $companyId['Company']['id']);
				}
				$this->Company->save($this->request->data('Company'));
				// company --!>
				$baseRoute = array('action' => 'index');
				return $this->redirect(($this->request->data('apply')) ? $baseRoute : array($id));
			}
		} elseif ($id) {
			$data = $this->Advertiser->findById($id);
			$data2 = $this->Company->findByAdvertiserId($id);
			$data = Hash::merge($data, $data2);
			$this->request->data = $data;
		}
		$this->set('users', $this->User->getOptions());
    }
}
