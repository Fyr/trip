$(function () {
	$('form input, form checkbox, form select, form radio').attr('autocomplete', 'off');

    $('*[rel="tooltip"]').tooltip()
    $('*[rel="tooltip-bottom"]').tooltip({
        placement: "bottom"
    })
    $(".time").setMask('time');

    var listItem = $('#accordion > div > div > ul > li.active').parent().parent().addClass('active-accordion')
    var Index = $('#accordion > div > div').index(listItem)
    $('#accordion > div').each(function(i){
        if (i==Index){
            $(this).accordion({active: 0, heightStyle: "content" ,collapsible: true});
        }else {
            $(this).accordion({active: false, heightStyle: "content" ,collapsible: true});
        }
    })

	$('.navbar-inner li.dropdown .dropdown-menu').hover(function(){
		$(this).closest('.navbar-inner li.dropdown').addClass('open');
	}, function(){
		$(this).closest('.navbar-inner li.dropdown').removeClass('open');
	});

    $('.date').datepicker({
        dateFormat: "dd.mm.yy",
        buttonImage: "/Icons/img/calendar.png",
        showOn: "button",
        buttonImageOnly: true,
        changeYear: true,
        changeMonth: true
    });

    $('.open-fieldset').on('click', function () {
        var content = $(this).parent().next('.fieldset-content')
        if (content.is(':visible')) {
            content.hide(200);
            $(this).children('i').removeClass('opened');
        } else {
            content.show(200);
            $(this).children('i').addClass('opened');
        }
        return false;
    })

    $('.show-popover-content').popover({
        html: true,
        placement: 'bottom',
        trigger: "hover",
        content: function () {
            return $(this).next('.popover-content').html();
        }
    });
})
String.prototype.ucFirst = function() {
	var str = this;
	if (str.length) {
		str = str.charAt(0).toUpperCase() + str.slice(1);
	}
	return str;
};
function _onChange(e, id, ready, type) {
    $('#'+id+' optgroup').hide();
    $('#'+id+' option').hide();
    if (!ready || !$('#'+id+' optgroup[label="'+$(e).find("option:selected").text()+'"] option').length) {
	$('#'+id+' option:selected').removeAttr('selected');
	$('#'+id).val(null);
	//$('#'+id+' optgroup[label="'+$(e).find("option:selected").text()+'"] option').eq(0).attr('selected', 'selected');
    }
    $('#'+id+' optgroup[label="'+$(e).find("option:selected").text()+'"]').show();
    $('#'+id+' optgroup[label="'+$(e).find("option:selected").text()+'"] option').show();
    
    if (type == 'country') {
	_onChange($('#AreaProvinceId'), 'AreaCityId');
    }
}