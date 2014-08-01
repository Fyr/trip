<div class="span8 offset2">
<?
    $id = $this->request->data($objectType.'.id');
    // $objectType = $this->request->data('Article.object_type');
    // $objectID = $this->request->data('Article.object_id');
    
    $title = $this->ObjectType->getTitle(($id) ? 'edit' : 'create', $objectType);
    echo $this->element('admin_title', compact('title'));
    echo $this->PHForm->create($objectType);
    echo $this->element('admin_content');
    //
    echo $this->PHForm->input('title', array('required' => true));
    
    if ($objectType == 'Province') {
	echo $this->PHForm->input('country_id', array('options' => $aCountry));
    }
    
    else if ($objectType == 'City') {
	echo $this->PHForm->input('country_id', array(
	    'options' => $aCountry,
	    'default' => isset($countryId) ? $countryId : false,
	    'onchange' => '_onChange(this, \'CityProvinceId\', false)',
	    'required' => true
	));
	echo $this->PHForm->input('province_id', array(
	    'options' => $aProvince,
	    'required' => true
	));
    }
    
    else if ($objectType == 'Area') {
	echo $this->PHForm->input('country_id', array(
	    'options' => $aCountry,
	    'default' => isset($countryId) ? $countryId : false,
	    'onchange' => '_onChange(this, \'AreaProvinceId\', false, \'country\')',
	    'required' => true
	));
	echo $this->PHForm->input('province_id', array(
	    'options' => $aProvince,
	    'onchange' => '_onChange(this, \'AreaCityId\', false, \'province\')',
	    'default' => isset($provinceId) ? $provinceId : false,
	    'required' => true,
	));
	echo $this->PHForm->input('city_id', array(
	    'options' => $aCity,
	    'required' => true
	));
    }
    //
    echo $this->element('admin_content_end');
    $backURL = $this->Html->url(array('action' => 'index', $objectType));
    echo $this->element('Form.form_actions', array('backURL' => $backURL));
    echo $this->PHForm->end();
?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    _onChange($('#CityCountryId'), 'CityProvinceId', true);
    _onChange($('#AreaCountryId'), 'AreaProvinceId', true);
    _onChange($('#AreaProvinceId'), 'AreaCityId', true);
});
</script>
