function initDate()
{
	$('.js_time').each(function()
	{
		var date = $(this).html();
		var str = moment(date, 'X').fromNow();
		$(this).html(str);
	});
}
function refresh()
{
	$.get('index.php?page=list&ajax', function(html)
	{
		$('.js_list').html(html);
		document.getElementById('scroll').scrollTop = document.getElementById('scroll').scrollHeight;
	});

	$.get('index.php?page=list_user&ajax', function(html)
	{
		$('.js_list_user').html(html);
		initDate();
	});
	$.get('index.php?page=gestion_message&ajax', function(html)
	{
		$('.js_admin_message').html(html);
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
	initDate();
	setInterval(function()
	{
		refresh();
	}, 1000);

});