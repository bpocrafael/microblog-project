$(document).ready(function () {
    $("#delete-image-button").on('click', function () {
        const postImageElement = $("#postImage");
        const hasImageAttached = postImageElement.attr("src") !== undefined && postImageElement.attr("src").trim() !== '';

        if (hasImageAttached) {
            if (confirm("Are you sure you want to delete this image?")) {
                $.ajax({
                    type: 'GET',
                    url: postImageDelete,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.message) {
                            alert(response.message);
                            location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        var errorMessage = "Error deleting image";
                        if (xhr.status === 404) {
                            errorMessage = "Image not found";
                        }
                        console.log(errorMessage);
                    }
                });
            }
        } else {
            alert("No image is attached to delete.");
        }
    });
});
