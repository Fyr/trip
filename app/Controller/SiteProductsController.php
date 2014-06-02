<?php
App::uses('AppController', 'Controller');
App::uses('SiteController', 'Controller');
class SiteProductsController extends SiteController {
	public $name = 'SiteProducts';
	public $uses = array('Product', 'Form.PMFormValue', 'Category', 'Subcategory');

	public function index() {
		$this->pageTitle = __('Products');
		$this->paginate = array(
			'conditions' => array('Product.published' => 1),
			'limit' => 2, 
			'order' => 'Product.created DESC'
		);
		$this->paginate['conditions'] = array_merge($this->paginate['conditions'], $this->postConditions($this->params->query['data']));
		$this->set('products', $this->paginate('Product'));
		
		if ($cat_id = Hash::get($this->params->query, 'data.Product.cat_id')) {
			$cat = $this->Category->findById($cat_id);
			$this->set('currCat', $cat_id);
			$this->pageTitle = $cat['Category']['title'];
			
		}
		
		if ($subcat_id = Hash::get($this->params->query, 'data.Product.subcat_id')) {
			$subcat = $this->Subcategory->findById($subcat_id);
			$this->set('currSubcat', $subcat_id);
			$this->pageTitle = $subcat['Subcategory']['title'];
		}
	}
	
	public function view($id) {
		$article = $this->Product->findById($id);
		$this->pageTitle = $article['Product']['title'];
		$this->set('article', $article);
		$this->set('techParams', $this->PMFormValue->getValues('ProductParam', $id));
		$this->set('aMedia', $this->Media->getObjectList('Product', $id));
		$this->set('currCat', $article['Category']['id']);
		$this->set('currSubcat', $article['Subcategory']['id']);
	}
}
