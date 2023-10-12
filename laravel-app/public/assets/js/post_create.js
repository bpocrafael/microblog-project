
$(document).ready(function() {
    function previewImage() {
        var photoInput = document.getElementById('photo');
        var photoPreview = document.getElementById('photo-preview');
        var previewImage = document.getElementById('preview-image');

        photoInput.addEventListener('change', function () {
            if (photoInput.files && photoInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(photoInput.files[0]);
            }
        });
    }

    previewImage();
});