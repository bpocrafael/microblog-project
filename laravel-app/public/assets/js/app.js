var profileImage = document.getElementById('profileImage');
var fileInput = document.getElementById('profile_image');

fileInput.addEventListener('change', function() {
    if (fileInput.files.length > 0) {
        var selectedFile = fileInput.files[0];

        var reader = new FileReader();

        reader.onload = function(event) {
            profileImage.src = event.target.result;
        };
        reader.readAsDataURL(selectedFile);
    }
});
