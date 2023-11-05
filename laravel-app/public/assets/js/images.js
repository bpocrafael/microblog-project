// Function to handle file input changes
function handleFileInputChange(inputElement, imageElement, maxSizeInBytes) {
    if (!inputElement) return;

    inputElement.addEventListener('change', function () {
        const files = inputElement.files;
        if (files.length === 0) return;

        const selectedFile = files[0];
        if (!selectedFile || !selectedFile.type.startsWith('image/')) {
            const message = 'Please select a valid image file.';
            showAlert(inputElement, message);
            return;
        }
        
        if (selectedFile.size > maxSizeInBytes) {
            const message = 'File is too large. Please select a smaller image (Less than 2MB).';
            showAlert(inputElement, message);
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            imageElement.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    });
}

function showAlert(inputElement, message) {
    $('#alertModal').modal('show');
    $('#alertModal .modal-body').html(message);
    inputElement.value = '';
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
