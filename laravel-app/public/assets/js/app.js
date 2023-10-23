// profile
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

// logout
document.addEventListener("DOMContentLoaded", function () {
    const logoutLink = document.querySelector(".text-share-link");
    
    if (logoutLink) {
        logoutLink.addEventListener("click", function (event) {
            event.preventDefault();
            const logoutForm = document.getElementById('logout-form');
            
            if (logoutForm) {
                logoutForm.submit();
            }
        });
    }
});

// search
$(document).ready(function() {
    $('form[role="search"]').submit(function(e) {
        e.preventDefault();
    });
});
