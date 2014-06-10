<?
App::uses('AppModel', 'Model');
App::uses('Article', 'Article.Model');
class Category extends Article {
	public $hasOne = array(
		'Media' => array(
			'foreignKey' => 'object_id',
			'conditions' => array('Media.object_type' => 'Category', 'Media.main' => 1),
			'dependent' => true
		)
	);

	protected $objectType = 'Category';
}
