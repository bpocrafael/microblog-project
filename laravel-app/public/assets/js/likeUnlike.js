$(document).ready(function() {
    $('[data-is-liked]').each(function() {
        const isLiked = $(this).data('is-liked');
        const postId = $(this).data('post-id');
        const likeButton = $('#saveLike[data-post-id="' + postId + '"]');
        const unlikeButton = $('#saveUnlike[data-post-id="' + postId + '"]');

        if (isLiked) {
            likeButton.hide();
            unlikeButton.show();
        } else {
            likeButton.show();
            unlikeButton.hide();
        }
    });
});

$(document).on('click', '#saveLike, #saveUnlike', function () {
    const _element = $(this);
    const _post_id = _element.data('post-id');
    const _url = _element.data('url');
    const _action = _element.data('action')
    const _csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: _url,
        type: _action === 'unlike' ? 'DELETE' : 'POST',
        dataType: 'json',
        data: {
            post: _post_id,
            _token: _csrfToken,
        },
        beforeSend: function () {
            _element.prop('disabled', true);
        },
        success: function (res) {
            if (res.success) {
                handleLikeUnlike(_post_id, _action, _element);
            }
        }
    });
});

function handleLikeUnlike(postId, action, element) {
    const _likeCounter = $('#like-count-' + postId);
    const _likedCounter = $('#liked-count-' + postId);

    const likeButton = $(`#saveLike[data-post-id="${postId}"][data-action="like"]`);
    const unlikeButton = $(`#saveUnlike[data-post-id="${postId}"][data-action="unlike"]`);

    
    setTimeout(function () {
        element.prop('disabled', false);

        if (action === 'unlike') {
            _likeCounter.text(parseInt(_likeCounter.text()) - 1);
            _likedCounter.text(parseInt(_likedCounter.text()) - 1);
            likeButton.show();
            unlikeButton.hide();
            return;
        }

        _likeCounter.text(parseInt(_likeCounter.text()) + 1);
        _likedCounter.text(parseInt(_likedCounter.text()) + 1);
        likeButton.hide();
        unlikeButton.show();

    }, 400);
}
