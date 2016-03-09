function refresh()
{
	$.get('index.php?page=list&ajax', function(html)
	{
		$('.js_list').html(html);
	});
}

$('document').ready(function()
{
	$('.js_form').submit(function(info)
	{
		info.preventDefault();
		var message = $('.js_in').val();
		$.post('tchat', {content:message,action:"sendMessage"}, function()
		{
			$('.js_in').val('').focus();
			refresh();
		});
		return false;
	});
	setInterval(function()
	{
		refresh();
	}, 1000);
});