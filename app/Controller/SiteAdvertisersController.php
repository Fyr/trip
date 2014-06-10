<?php
App::uses('AppController', 'Controller');
App::uses('SiteController', 'Controller');
class SiteAdvertisersController extends SiteController {
	public $name = 'SiteAdvertisers';
	public $uses = array('Advertiser');
	// public $helpers = array('ArticleVars');
	
	public function view($slug) {
		$article = $this->Advertiser->findBySlug($slug);
		$this->pageTitle = $article['Advertiser']['title'];
		$this->set('article', $article);
	}
}
