<?php
echo $this->PHForm->input('country_id', array(
    'options' => $aCountry,
    'default' => isset($countryId) ? $countryId : false,
    'onchange' => '_onChange(this, \'ProductProvinceId\', false, \'country\')',
    'required' => true
));
echo $this->PHForm->input('province_id', array(
    'options' => $aProvince,
    'default' => isset($provinceId) ? $provinceId : false,
    'onchange' => '_onChange(this, \'ProductCityId\', false, \'province\')',
    'required' => true
));
echo $this->PHForm->input('city_id', array(
    'options' => $aCity,
    'default' => isset($cityId) ? $cityId : false,
    'onchange' => '_onChange(this, \'ProductAreaId\', false, \'city\')',
    'required' => true
));
echo $this->PHForm->input('area_id', array(
    'options' => $aArea,
    'required' => true
));
?>

<script type="text/javascript">
$(document).ready(function(){
    $('.form-3actions button[type=submit]').click(function(){
	if ($('#tab-content-Region').is(':hidden') && !validateRegion()) {
	    $('.tab-content').hide();
	    $('#tab-content-Region').show().addClass('active');
	    $('.nav-tabs li').removeClass('active');
	    $('#tab-Region').addClass('active');
	}
    });
    _onChange($('#ProductCountryId'), 'ProductProvinceId', true);
    _onChange($('#ProductProvinceId'), 'ProductCityId', true);
    _onChange($('#ProductCityId'), 'ProductAreaId', true);
})
function validateRegion() {
    if (
	    $.trim($('#ProductCountryId').val()) == '' ||
	    $.trim($('#ProductProvinceId').val()) == '' ||
	    $.trim($('#ProductCityId').val()) == '' ||
	    $.trim($('#ProductAreaId').val()) == ''
	) {
	return false;
    }
    return true;
}
</script>