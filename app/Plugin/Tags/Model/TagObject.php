<?php
App::uses('AppModel', 'Model');
class TagObject extends AppModel {
    public $useTable = 'tag_objects';
    const RELATED_LIMIT = 10;

    /**
     * 
     * @param type $useTags
     * @param type $id
     * @return type
     */
    public function getRelatedProducts($useTags, $id) {
	$this->bindModel(array(
	    'belongsTo' => array(
		'Product' => array(
		    'foreignKey' => 'object_id',
		    'conditions' => array('TagObject.object_type' => 'Product'),
		    'dependent' => true,
		    'fields' => array(
			'id', 'title'
		    )
		)
	    )
	));
	
	$related = $this->find('all', array(
	    'conditions' => array(
		'tag_id' => $useTags,
		'TagObject.object_id !=' => $id,
		'Product.id !=' => ''
	    ),
	    'fields' => array(
		'DISTINCT(TagObject.object_id)',
		'Product.id',
		'Product.title'
	    ),
	    'limit' => self::RELATED_LIMIT
	));
	
	return $related;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function getUseTags($id) {
	$useTags = $this->find('list', array(
	    'fields' => array('id', 'tag_id'), 
	    'conditions' => array('object_id' => $id)
	));
	
	return array_values($useTags);
    }
}