$(document).ready(function () {
	const UNREAD_NOTIF_COUNT = parseInt($('#notif-bell').data('count'));
	if (UNREAD_NOTIF_COUNT > 0) {
		$('#notif-dot').removeClass('d-none');
	}
});

$(document).on('click', '#mark-all', $.throttle(500, function () {
    const _url = $(this).data('url');
    const _csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: _url,
        type: 'GET',
        dataType: 'json',
        data: {
            _token: _csrfToken,
        },
        success: function (res) {
            if (res.success) {
                handleMarkAsRead();
            }
        }
    });
}));

function handleMarkAsRead() {
	$('.unread').each(function () {
		$(this).removeClass('unread');
		$(this).addClass('read');
	})
	$('#notif-dot').addClass('d-none');
}