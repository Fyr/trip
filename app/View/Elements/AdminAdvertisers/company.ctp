<?php 
echo $this->PHForm->input('Company.name', array('class' => 'input-medium', 'type' => 'text'));
echo $this->PHForm->input('Company.address', array('class' => 'input-xxlarge', 'type' => 'text'));
echo $this->PHForm->input('Company.phone', array('class' => 'input-medium', 'type' => 'text'));
echo $this->PHForm->input('Company.website', array('class' => 'input-xlarge', 'type' => 'text'));
echo $this->PHForm->input('Company.email', array('class' => 'input-medium', 'type' => 'text'));
echo $this->PHForm->input('Company.skype', array('class' => 'input-medium', 'type' => 'text'));
echo $this->PHForm->input('Company.facebook', array('class' => 'input-xlarge', 'type' => 'text'));
?>
<script type="text/javascript">
    $(document).ready(function(){
	$('.form-3actions button[type=submit]').click(function(){
	    if ($('#tab-content-Company').is(':hidden') && !validateCompany()) {
		$('.tab-content').hide();
		$('#tab-content-Company').show().addClass('active');
		$('.nav-tabs li').removeClass('active');
		$('#tab-Company').addClass('active');
	    }
	});
    })
    function validateCompany() {
	if (
		$.trim($('#CompanyName').val()) == '' ||
		$.trim($('#CompanyAddress').val()) == '' ||
		$.trim($('#CompanyPhone').val()) == '' ||
		$.trim($('#CompanyEmail').val()) == ''
	    ) {
	    return false;
	}
	return true;
    }
</script>