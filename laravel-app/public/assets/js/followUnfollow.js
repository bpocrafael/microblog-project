$(document).ready(function () {
    $('.follow-button').each(function () {
        const button = $(this);
        const isFollowing = button.data('isFollowing') === true;
        updateButtonText(button, isFollowing);
    });

    $(document).on('click', '.follow-button', function () {
        const button = $(this);
        const userId = button.data('user-id');
        const isFollowing = button.data('isFollowing') === true;
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const url = isFollowing ? button.data('delete-url') : button.data('url');

        $.ajax({
            url: url,
            type: isFollowing ? 'DELETE' : 'PUT',
            data: {
                user: userId,
                _token: csrfToken,
            },
            beforeSend: function () {
                button.prop('disabled', true);
            },
            success: function () {
                handleFollowUnfollow(button, isFollowing);
				if (window.location.href.includes('/profile/')) {
					location.reload();
				}
            }
        });
    });
});

function handleFollowUnfollow(button, isFollowing) {
    button.data('is-following', !isFollowing);

    setTimeout(function () {
		button.prop('disabled', false);
        updateButtonText(button, !isFollowing);
    }, 400);
}

function updateButtonText(button, isFollowing) {
    const buttonText = button.find('.button-text');
    if (isFollowing) {
        buttonText.html('<i class="fa-solid fa-circle-check"></i> Following');
		return;
    }
	buttonText.html('<i class="fa-regular fa-circle-check"></i> Follow');
}
