document.addEventListener("DOMContentLoaded", function () {
    // Logout
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

    // Form Submission
    $('form').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const submitButtons = $('button[type=submit]', form).not('form[role="search"]');

        submitButtons.prop('disabled', true);
        submitButtons.find('.spinner-border').removeClass('d-none');

        setTimeout(function () {
            submitButtons.prop('disabled', false);
            submitButtons.find('.spinner-border').addClass('d-none');
        }, 1000);

        // Submit after a delay to avoid spam
        setTimeout(function () {
            form.off('submit').submit();
        }, 700);
    });

    // Textarea
    const contentTextarea = document.getElementById('content');

    if (contentTextarea) {
        contentTextarea.addEventListener('input', function () {
            adjustTextareaHeight(this);
        });
    }

    function adjustTextareaHeight(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }
});
