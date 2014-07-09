<?php
App::uses('AppHelper', 'View/Helper');
class ObjectTypeHelper extends AppHelper {
    public $helpers = array('Html');
    
    private function _getTitles() {
        $Titles = array(
            'index' => array(
                'Article' => __('Articles'),
                'Page' => __('Static pages'),
                'News' => __('News'),
                'Category' => __('Categories'),
                'Subcategory' => __('Subcategories'),
                'Product' => __('Products'),
                'FormField' => __('Tech.params'),
                'User' => __('Users'),
                'UserGroup' => __('User groups'),
                'Advertiser' => __('Advertisers'),
                'Country' => __('Countries'),
                'City' => __('Cities'),
		'Tag' => __('Tags'),
            ), 
            'create' => array(
                'Article' => __('Create Article'),
                'Page' => __('Create Static page'),
                'News' => __('Create News article'),
                'Category' => __('Create Category'),
                'Subcategory' => __('Create Subcategory'),
                'Product' => __('Create Product'),
                'FormField' => __('Create Parameter'),
                'User' => __('Create User'),
                'UserGroup' => __('Create user group'),
                'Advertiser' => __('Create Advertiser'),
                'Country' => __('Create Country'),
                'City' => __('Create City'),
		'Tag' => __('Create Tags'),
            ),
            'edit' => array(
                'Article' => __('Edit Article'),
                'Page' => __('Edit Static page'),
                'News' => __('Edit News article'),
                'Category' => __('Edit Category'),
                'Subcategory' => __('Edit Subcategory'),
                'Product' => __('Edit Product'),
                'User' => __('Edit User'),
                'UserGroup' => __('Edit user group'),
                'Advertiser' => __('Edit Advertiser'),
                'Country' => __('Edit Country'),
                'City' => __('Edit City'),
		'Tag' => __('Edit Tags'),
            )
        );
        return $Titles;
    }
    
    public function getTitle($action, $objectType) {
        $aTitles = $this->_getTitles();
        return (isset($aTitles[$action][$objectType])) ? $aTitles[$action][$objectType] : $aTitles[$action]['Article'];
    }
    
    public function getBaseURL($objectType, $objectID = '') {
        return $this->Html->url(array('action' => 'index', $objectType, $objectID));
    }
}