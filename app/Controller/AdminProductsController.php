<?php
App::uses('AdminController', 'Controller');
class AdminProductsController extends AdminController {
    public $name = 'AdminProducts';
    public $components = array('Table.PCTableGrid', 'Article.PCArticle', 'Auth');
    public $uses = array('Category', 'Subcategory', 'Advertiser', 'Product', 'Form.PMForm', 'Form.PMFormValue', 'Tags.Tag', 'Tags.TagObject', 'User');
    public $helpers = array('ObjectType', 'Form.PHFormFields');
    
    public function beforeRender() {
        parent::beforeRender();
        $this->set('objectType', $this->Product->objectType);
    }
    
    private function _getCategoryRights() {
        $userData = $this->User->findById(AuthComponent::user('id'));
        return ($userData['User']['category_rights']) ? array('Product.cat_id' => explode(',', $userData['User']['category_rights'])) : false;
    }
    
    public function index() {

        $this->paginate = array(
	    'fields' => array('id', 'created', 'title', 'teaser', 'published'),
	    'conditions' => array(
		$this->_getCategoryRights()
	    )
        );
        $this->PCTableGrid->paginate('Product');
    }
    
    public function edit($id = 0) {
        $this->loadModel('Media.Media');
        $this->set('aCategories', $this->Category->find('list', array(
            'conditions' => array(
            'id' => $this->_getCategoryRights()
            )
        )));
        $this->set('aSubcategories', $this->Subcategory->find('all', array(
            'fields' => array('id', 'object_id', 'title', 'Category.id', 'Category.title'),
            'order' => 'object_id'
        )));
        
        if (!$id) {
            $this->request->data('Product.object_type', $this->Product->objectType);
        }
        $this->PCArticle->setModel('Product')->edit(&$id, &$lSaved);
        if ($lSaved) {
            if ($this->request->is('put')) {
                // save product params only for updated product
                $form = $this->PMForm->getObject('Subcategory', $this->request->data('Subcategory.id'));
                if ($form && ($data = $this->request->data('PMFormValue'))) {
                    $this->PMFormValue->saveForm('ProductParam', $id, $form['PMForm']['id'], $data);
                }
                // delete tags
                $this->TagObject->deleteAll(array('object_id' => $id));
                // save tags
                $useTags = explode(',', $this->request->data['Tag']['tags']);
                foreach ($useTags as $tag) {
                    if (intval($tag)) {
                    $this->TagObject->create();
                    $this->TagObject->save(array(
                        'tag_id' => $tag,
                        'object_type' => 'Product',
                        'object_id' => $id
                    ));
                    }
                }
            }
            $baseRoute = array('action' => 'index');
            return $this->redirect(($this->request->data('apply')) ? $baseRoute : array($id));
        }
        
        $subcat_id = $this->request->data('Subcategory.id');
        $this->set('form', $this->PMForm->getFields('Subcategory', $subcat_id));
        $this->set('formValues', $this->PMFormValue->getValues('ProductParam', $id));
        $this->set('aAdvertisers', $this->Advertiser->find('list'));
        // Tags
        $allProductTags = '';
        if ($id) {
            if ($allProductTags = $this->TagObject->find('list', array('fields' => array('tag_id'), 'conditions' => array('object_id' => $id)))) {
            $allProductTags = implode(',', $allProductTags);
            }
        }
        $this->PCTableGrid->paginate('Tag');
        $this->set('allProductTags', $allProductTags);
    }
}
