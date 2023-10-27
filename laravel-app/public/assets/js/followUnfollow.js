$(document).ready(function () {
    $('.follow-button').each(function () {
        const button = $(this);
        const isFollowing = button.data('isFollowing');
        updateButtonText(button, isFollowing);
    });

    $(document).on('click', '.follow-button', $.throttle(500 ,function () {
        const button = $(this);
        const userId = button.data('user-id');
        const isFollowing = button.data('isFollowing');
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const url = isFollowing ? button.data('delete-url') : button.data('url');

        $.ajax({
            url: url,
            type: isFollowing ? 'DELETE' : 'PUT',
            data: {
                user: userId,
                _token: csrfToken,
            },
            success: function () {
                handleFollowUnfollow(button, isFollowing);
                const currentLocation = ['/profile/', '/post/', '/follow/'];
                if (currentLocation.some(substring => window.location.href.includes(substring))) {
                    location.reload();
                }
            }
        });
    }));
});

function handleFollowUnfollow(button, isFollowing) {
    button.data('is-following', !isFollowing);
    updateButtonText(button, !isFollowing);
}

function updateButtonText(button, isFollowing) {
    const buttonText = button.find('.button-text');
    if (isFollowing) {
        buttonText.html('<i class="fa-solid fa-circle-check"></i> Following');
        return;
    }
    buttonText.html('<i class="fa-regular fa-circle-check"></i> Follow');
}
