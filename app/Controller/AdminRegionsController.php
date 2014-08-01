<?php
App::uses('AdminController', 'Controller');
class AdminRegionsController extends AdminController {
    public $name = 'AdminRegions';
    public $components = array('Table.PCtableGrid');
    public $uses = array('Country', 'City', 'Province', 'Area');
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
	    'Province' => array(
		'fields' => array('title', 'country_id')
	    ),
	    'City' => array(
		'fields' => array('title', 'province_id')
	    ),
	    'Area' => array(
		'fields' => array('title', 'city_id')
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
	    if ($this->request->is(array('put', 'post'))) {
		if ($id) {
			$this->request->data($objectType.'.id', $id);
		}
		if ($this->{$objectType}->save($this->request->data)) {
			$id = $this->{$objectType}->id;
			$baseRoute = array('action' => 'index', $objectType, $objectID);
			return $this->redirect(($this->request->data('apply')) ? $baseRoute : array($id, $objectType, $objectID));
		}
	    }  elseif ($id) {
		$dataId = $this->{$objectType}->findById($id);
		$this->request->data = $dataId;
		if (isset($dataId['City']['province_id'])) {
		    $provinceId = $this->Province->findById($dataId['City']['province_id']);
		    $this->set('countryId', $provinceId['Province']['country_id']);
		} else if (isset($dataId['Area']['city_id'])) {
		    $cityId = $this->City->findById($dataId['Area']['city_id']);
		    $provinceId = $this->Province->findById($cityId['City']['province_id']);
		    $this->set('countryId', $provinceId['Province']['country_id']);
		    $this->set('provinceId', $cityId['City']['province_id']);
		    $this->set('cityId', $dataId['Area']['city_id']);
		}
	    }

	    
	    $aCountry = $this->Country->find('list');
	    $aProvince_ = $this->Province->find('all');
	    $aCity_ = $this->City->find('all');
	    //
	    foreach ($aCountry as $cKey => $cName) {
		foreach ($aProvince_ as $pKey => $pName) {
		    if ($cKey == $aProvince_[$pKey]['Province']['country_id']) {
			$aProvince[$cName][$aProvince_[$pKey]['Province']['id']] = $aProvince_[$pKey]['Province']['title'];
		    }
		}
	    }
	    foreach ($aProvince_ as $pKey => $pName) {
		foreach ($aCity_ as $cKey => $cName) {
		    if ($aProvince_[$pKey]['Province']['id'] == $aCity_[$cKey]['City']['province_id']) {
			$aCity[$aProvince_[$pKey]['Province']['title']][$aCity_[$cKey]['City']['id']] = $aCity_[$cKey]['City']['title'];
		    }
		}
	    }

	    $this->set('aCountry', isset($aCountry) ? $aCountry : array());
	    $this->set('aProvince', isset($aProvince) ? $aProvince : array());
	    $this->set('aCity', isset($aCity) ? $aCity : array());

	    $this->set('objectType', $objectType);
	    $this->set('objectID', $objectID);
	}
}
