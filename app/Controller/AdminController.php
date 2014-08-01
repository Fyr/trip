<?php
App::uses('AppController', 'Controller');
class AdminController extends AppController {
	public $name = 'Admin';
	public $layout = 'admin';
	public $uses = array();

	public function _beforeInit() {
	    // auto-add included modules - did not included if child controller extends AdminController
	    $this->components = array_merge(array('Core.PCAuth', 'Table.PCTableGrid'), $this->components);
	    $this->helpers = array_merge(array('Html', 'Table.PHTableGrid', 'Form.PHForm'), $this->helpers);
	    
		$this->aNavBar = array(
			'Page' => array('label' => __('Static Pages'), 'href' => array('controller' => 'AdminContent', 'action' => 'index', 'Page')),
			// 'News' => array('label' => __('News'), 'href' => array('controller' => 'AdminContent', 'action' => 'index', 'News')),
			'Regions' => array('label' => __('Regions'), 'href' => '', 'submenu' => array(
				'Countries' => array('label' => __('Countries'), 'href' => array('controller' => 'AdminRegions', 'action' => 'index', 'Country')),
				'Provincies' => array('label' => __('Provincies'), 'href' => array('controller' => 'AdminRegions', 'action' => 'index', 'Province')),
				'Cities' => array('label' => __('Cities'), 'href' => array('controller' => 'AdminRegions', 'action' => 'index', 'City')),
				'Areas' => array('label' => __('Areas'), 'href' => array('controller' => 'AdminRegions', 'action' => 'index', 'Area')),
			)),
			'Category' => array('label' => __('Categories'), 'href' => array('controller' => 'AdminContent', 'action' => 'index', 'Category')),
			'Advertisement' => array('label' => __('Advertisement'), 'href' => '', 'submenu' => array(
				'Forms' => array('label' => __('Product parameters'), 'href' => array('controller' => 'AdminFields', 'action' => 'index')),
				'Advertisers' => array('label' => __('Advertisers'), 'href' => array('controller' => 'AdminAdvertisers', 'action' => 'index')),
				'Products' => array('label' => __('Products'), 'href' => array('controller' => 'AdminProducts', 'action' => 'index')),
				'Tags' => array('label' => __('Tags'), 'href' => array('controller' => 'AdminTags', 'action' => 'index')),
			)),
			// 'slider' => array('label' => __('Slider'), 'href' => array('controller' => 'AdminSlider', 'action' => 'index')),
			'Users' => array('label' => __('Users'), 'href' => '', 'submenu' => array(
				//'UserGroups' => array('label' => __('Groups'), 'href' => array('controller' => 'AdminUserGroups', 'action' => 'index')),
				'Users' => array('label' => __('Users'), 'href' => array('controller' => 'AdminUsers', 'action' => 'index'))
			))
			// 'settings' => array('label' => __('Settings'), 'href' => array('controller' => 'AdminSettings', 'action' => 'index'))
		);
	}
	
	public function beforeFilter() {
	    if (!$this->isAdmin()) {
		    unset($this->aNavBar['Regions']);
		    unset($this->aNavBar['Category']);
		    unset($this->aNavBar['Advertisement']['submenu']['Forms']);
		    unset($this->aNavBar['Advertisement']['submenu']['Tags']);
		    unset($this->aNavBar['Advertisement']['submenu']['Advertisers']);
		    unset($this->aNavBar['Users']);
		    unset($this->aNavBar['Page']);
	    }
	    $this->currMenu = $this->_getCurrMenu();
	    $this->currLink = $this->currMenu;
	    $this->aBottomLinks = $this->aNavBar;
	}

	public function index() {
	}
	
	protected function _getCurrMenu() {
		$curr_menu = strtolower(str_ireplace('Admin', '', $this->request->controller)); // By default curr.menu is the same as controller name
		foreach($this->aNavBar as $currMenu => $item) {
			if (isset($item['submenu'])) {
				foreach($item['submenu'] as $_currMenu => $_item) {
					if (strtolower($_currMenu) === $curr_menu) {
						return $currMenu;
					}
				}
			}
		}
		return $curr_menu;
	}

	public function delete($id) {
		$this->autoRender = false;

		$model = $this->request->query('model');
		if ($model) {
			$this->loadModel($model);
			if (strpos($model, '.') !== false) {
				list($plugin, $model) = explode('.',$model);
			}
			$this->{$model}->delete($id);
		}
		if ($backURL = $this->request->query('backURL')) {
			$this->redirect($backURL);
			return;
		}
		$this->redirect(array('controller' => 'Admin', 'action' => 'index'));
	}
	
	public function isAdmin() {
		return AuthComponent::user('id') == 1;
	}
}
