<?php
App::uses('AppController', 'Controller');
App::uses('SiteController', 'Controller');
class SitePagesController extends SiteController {
	public $name = 'SitePages';
	public $uses = array('Page', 'News', 'Product', 'Category');
	// public $helpers = array('ArticleVars');

	public function home() {
		$this->layout = 'home';
		$this->currLink = 'Home';
		
		$aCategories = $this->Category->find('all');
		$this->set('aCategoryArticles', $aCategories);
	}
	
	public function view($slug) {
		$article = $this->Page->findBySlug($slug);
		$this->pageTitle = $article['Page']['title'];
		$this->set('article', $article);
	}
}
