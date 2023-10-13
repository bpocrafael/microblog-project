document.addEventListener('DOMContentLoaded', function() {
    function previewImage() {
        const photoInput = document.getElementById('photo');
        const previewImage = document.getElementById('preview-image');

        photoInput.addEventListener('change', function () {
            const file = photoInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    previewImage();
});
