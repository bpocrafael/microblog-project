// profile
const profileImage = document.getElementById('profileImage');
const profileFileInput = document.getElementById('profile_image');

if (profileFileInput){
    profileFileInput.addEventListener('change', function() {
        if (profileFileInput.files.length > 0) {
            const selectedFile = profileFileInput.files[0];
    
            const reader = new FileReader();
    
            reader.onload = function(event) {
                profileImage.src = event.target.result;
            };
            reader.readAsDataURL(selectedFile);
        }
    });
}

// post
const postImage = document.getElementById('postImage');
const postFileInput = document.getElementById('post_image'); 

if (postFileInput) {
    postFileInput.addEventListener('change', function() {
        if (postFileInput.files.length > 0) {
            const selectedFile = postFileInput.files[0];

            const reader = new FileReader();

            reader.onload = function(event) {
                postImage.src = event.target.result;
            };
            reader.readAsDataURL(selectedFile);
        }
    });
}

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

        const query = $(this).find('input[name="query"]').val();
        const searchUrl = $(this).attr('action') + '?query=' + query;
        
        window.location.href = searchUrl;
    });
});

// comment edit
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.editButton');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const commentId = button.getAttribute('data-commentid');
            const editForm = document.getElementById('editForm_' + commentId);
            const commentElement = document.getElementById('commentComment_' + commentId);

            editForm.style.display = 'block';
            commentElement.style.display = 'none';
            button.style.display = 'none';
        });
    });

    const cancelButtons = document.querySelectorAll('.cancel-button');
    const deleteButtons = document.querySelectorAll('.delete-button');
    const submitButtons = document.querySelectorAll('.submit-button');

    cancelButtons.forEach(function(cancelButton) {
        cancelButton.addEventListener('click', function() {
            const commentId = cancelButton.closest('form').getAttribute('id').replace('editForm_', '');
            const editForm = document.getElementById('editForm_' + commentId);
            const commentElement = document.getElementById('commentComment_' + commentId);
            const editButton = document.querySelector(`.editButton[data-commentid="${commentId}"`);

            editForm.style.display = 'none';
            commentElement.style.display = 'block'; 
            editButton.style.display = 'block';
        });
    });

    deleteButtons.forEach(function(deleteButton) {
        deleteButton.addEventListener('click', function(event) {
            event.preventDefault();

            const confirmDelete = confirm('Are you sure you want to delete this comment?');
            if (confirmDelete) {
                const deleteForm = deleteButton.closest('form');
                const commentId = deleteForm.getAttribute('id').replace('deleteForm_', ''); 
                deleteForm.action = deleteForm.action.replace('COMMENT_ID', commentId);
                deleteForm.method = 'DELETE';
                deleteForm.submit(); 
            }
        });
    });

    submitButtons.forEach(function(submitButton) {
        submitButton.addEventListener('click', function() {
            const commentId = submitButton.getAttribute('data-commentid');
            const editedComment = document.getElementById('comment_' + commentId).value;
            const commentElement = document.getElementById('commentComment_' + commentId);
            
            if (editedComment.trim() === '') {
                alert('Comment cannot be empty');
                return;
            }
            if (editedComment.length > 255) {
                alert('Comment exceeds 255 characters');
                return;
            }
            fetch(`/comment/${commentId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    comment: editedComment,
                }),
            })
            .then(response => {
                if (response.ok) {
                    const editForm = document.getElementById('editForm_' + commentId);
                    editForm.style.display = 'none';

                    commentElement.textContent = editedComment;
                    commentElement.style.display = 'block';
                    document.getElementById('comment_' + commentId).value = editedComment;
                    document.querySelector(`.editButton[data-commentid="${commentId}"]`).style.display = 'block';
                } else {
                    const errorMessage = document.getElementById('error-message');
                    errorMessage.textContent = 'Failed to update comment';
                    errorMessage.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
