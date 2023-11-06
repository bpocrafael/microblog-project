// Function to handle file input changes
function handleFileInputChange(inputElement, imageElement, maxSizeInBytes) {
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
        
        if (selectedFile.size > maxSizeInBytes) {
            alert('File is too large. Please select a smaller image.');
            inputElement.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            imageElement.removeAttribute('hidden');
            imageElement.src = event.target.result;

            const initialsElement = imageElement.previousElementSibling;
            initialsElement.hidden = true;
        };

        reader.readAsDataURL(selectedFile);
    });
}

const maxSizeInBytes = 2 * 1024 * 1024; 

// Profile
const profileImage = document.getElementById('profileImage');
const profileFileInput = document.getElementById('profile_image');
handleFileInputChange(profileFileInput, profileImage, maxSizeInBytes);

// Post Create
const postImage = document.getElementById('preview-image');
const postFileInput = document.getElementById('photo');
handleFileInputChange(postFileInput, postImage, maxSizeInBytes);

// Post Update
const postUpdateImage = document.getElementById('postImage');
const postUpdateFileInput = document.getElementById('post_image');
handleFileInputChange(postUpdateFileInput, postUpdateImage, maxSizeInBytes);
