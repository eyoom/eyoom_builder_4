$(function()
{
	$('input[type="checkbox"]:checked, input[type="radio"]:checked').addClass('checked');
	
	$('.eyoom-form').on('change', 'input[type="radio"]', function()
	{
		$(this).closest('.eyoom-form').find('input[name="' + $(this).attr('name') + '"]').removeClass('checked');
		$(this).addClass('checked');
	});
	
	$('.eyoom-form').on('change', 'input[type="checkbox"]', function()
	{
		$(this).toggleClass('checked');
	});
});