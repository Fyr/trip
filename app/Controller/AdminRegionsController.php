<?php
App::uses('AdminController', 'Controller');
class AdminRegionsController extends AdminController {
    public $name = 'AdminRegions';
    public $components = array('Table.PCtableGrid');
    public $uses = array('Country', 'City');
    public $helpers = array('ObjectType');
    
    public function beforeRender() {
    	$this->currMenu = 'Regions';
    	parent::beforeRender();
    }
    
    public function index($objectType, $objectID = '') {
        $this->paginate = array(
            'Country' => array(
            	'fields' => array('title')
            ),
        	'City' => array(
        		'conditions' => array('City.country_id' => $objectID),
        		'fields' => array('title')
        	)
        );
        
        $data = $this->PCTableGrid->paginate($objectType);
        $this->set('objectType', $objectType);
        $this->set('objectID', $objectID);
        
        if ($objectType == 'City' && $objectID) {
        	$this->set('country', $this->Country->findById($objectID));
        }
        
    }
    
	public function edit($id = 0, $objectType, $objectID = '') {
		if (!$id) {
			$this->request->data('City.country_id', $objectID);
		}
		if ($this->request->is('put') || $this->request->is('post')) {
			if ($id) {
				$this->request->data($objectType.'.id', $id);
			}
			if ($this->{$objectType}->save($this->request->data)) {
				$id = $this->{$objectType}->id;
				$baseRoute = array('action' => 'index', $objectType, $objectID);
				return $this->redirect(($this->request->data('apply')) ? $baseRoute : array($id, $objectType, $objectID));
			}
		}  elseif ($id) {
			$this->request->data = $this->{$objectType}->findById($id);
		}
		
		if ($objectType == 'City' && $objectID) {
			$this->set('country', $this->Country->findById($objectID));
		}
		$this->set('objectType', $objectType);
		$this->set('objectID', $objectID);
	}
}
