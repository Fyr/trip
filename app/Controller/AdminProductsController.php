<?php
App::uses('AdminController', 'Controller');
class AdminProductsController extends AdminController {
    public $name = 'AdminProducts';
    public $components = array('Table.PCTableGrid', 'Article.PCArticle', 'Auth');
    public $uses = array('Category', 'Subcategory', 'Advertiser', 'Product', 'Form.PMForm', 'Form.PMFormValue', 'Tags.Tag', 'Tags.TagObject', 'User', 'Country', 'Province', 'City', 'Area');
    public $helpers = array('ObjectType', 'Form.PHFormFields');
    
    public function beforeRender() {
        parent::beforeRender();
        $this->set('objectType', $this->Product->objectType);
    }
    
    private function _getCategoryRights($fieldId = false) {
        $userData = $this->User->findById(AuthComponent::user('id'));
	$fields = $fieldId ? 'id' : 'Product.cat_id';
        return ($userData['User']['category_rights']) ? array($fields => explode(',', $userData['User']['category_rights'])) : false;
    }
    
    public function index() {

        $this->paginate = array(
	    'fields' => array('id', 'created', 'title', 'teaser', 'published'),
	    'conditions' => array(
		$this->_getCategoryRights()
	    ),
	    'limit' => 50
        );
        $this->PCTableGrid->paginate('Product');
    }
    
    public function edit($id = 0) {
        $this->loadModel('Media.Media');
        $this->set('aCategories', $this->Category->find('list', array(
            'conditions' => array(
		$this->_getCategoryRights(true)
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
	//
	$aCountry = $this->Country->find('list');
	$aProvince_ = $this->Province->find('all');
	$aCity_ = $this->City->find('all');
	$aArea_ = $this->Area->find('all');
	
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
	foreach ($aCity_ as $cKey => $cName) {
	    foreach ($aArea_ as $aKey => $aName) {
		if ($aCity_[$cKey]['City']['id'] == $aArea_[$aKey]['Area']['city_id']) {
		    $aArea[$aCity_[$cKey]['City']['title']][$aArea_[$aKey]['Area']['id']] = $aArea_[$aKey]['Area']['title'];
		}
	    }
	}

	$this->set('aCountry', isset($aCountry) ? $aCountry : array());
	$this->set('aProvince', isset($aProvince) ? $aProvince : array());
	$this->set('aCity', isset($aCity) ? $aCity : array());
	$this->set('aArea', isset($aArea) ? $aArea : array());
	
	if ($id) {
	    $areaId = $this->Product->find('first', array('conditions' => array('Product.id' => $id)));
	    if (isset($areaId['Product']['area_id'])) {
		//найдем id города
		$cityId = $this->Area->find('first', array('conditions' => array('Area.id' => $areaId['Product']['area_id'])));
		$cityId = $this->City->find('first', array('conditions' => array('City.id' => $cityId['Area']['city_id'])));
		if (isset($cityId['City']['id'])) {
		    //найдем id области
		    $provinceId = $this->Province->find('first', array('conditions' => array('Province.id' => $cityId['City']['province_id'])));
		    if (isset($provinceId['Province']['id'])) {
		    	//найдем id страны
			$countryId = $provinceId['Province']['country_id'];
			
			$this->set('countryId', $countryId);
			$this->set('provinceId', $provinceId['Province']['id']);
			$this->set('cityId', $cityId['City']['id']);
			$this->set('areaId', $areaId['Product']['area_id']);
		    }
		}
	    }
	}
    }
}
