// Function to handle file input changes
function handleFileInputChange(inputElement, imageElement) {
    if (!inputElement) return;

    inputElement.addEventListener('change', function () {
        const files = inputElement.files;
        if (files.length === 0) return;

        const selectedFile = files[0];
        if (!selectedFile || !selectedFile.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            inputElement.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            imageElement.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    });
}

// Profile
const profileImage = document.getElementById('profileImage');
const profileFileInput = document.getElementById('profile_image');
handleFileInputChange(profileFileInput, profileImage);

// Post
const postImage = document.getElementById('preview-image');
const postFileInput = document.getElementById('photo');
handleFileInputChange(postFileInput, postImage);
