$(document).ready(function () {
    $('#upload-image-button').click(function () {
        const formData = new FormData($('#profile-image-form')[0]);

        $.ajax({
            type: 'POST',
            url: profileStoreRoute,
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                alert(data.message); 
            },
            error: function () {
                alert(xhr.responseJSON.error);
            }
        });
    });
});
