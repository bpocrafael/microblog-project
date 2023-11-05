const AUTH_ID = parseInt($('#header').data('auth'));
const PUSHER_KEY = '1930e0b5383f5f5e3d90';
const PUSHER_CLUSTER = 'ap1';

Echo = new Echo({
    broadcaster: 'pusher',
    key: PUSHER_KEY,
    cluster: PUSHER_CLUSTER,
    forceTLS: true,
    authEndpoint: "/broadcasting/auth",
});

Pusher.logToConsole = true;


const CHANNEL = Echo.private(`notification-channel.${AUTH_ID}`);

CHANNEL.listen('PostLiked', (e) => {
    handleNotificationEvent('PostLiked', e.message, e.notificationUrl, e.createdAt);
});

CHANNEL.listen('PostCommented', (e) => {
    handleNotificationEvent('PostCommented', e.message, e.notificationUrl, e.createdAt);
});

CHANNEL.listen('PostShared', (e) => {
    handleNotificationEvent('PostShared', e.message, e.notificationUrl, e.createdAt);
});

function handleNotificationEvent(event, message, notificationUrl, createdAt) {
    console.log(`${event} event received`);
    $('#notif-dot').removeClass('d-none');
    const notificationItem = `
        <li class="notif-list-item unread">
            <a class="dropdown-item p-3 px-4" href="${notificationUrl}">
                <h6 class="text-identifier d-flex">${message}</h6>
                <i class="date">${createdAt}</i>
            </a>
        </li>
    `;

    $(notificationItem).insertAfter($('#dropdown-divider'));
}

document.addEventListener("DOMContentLoaded", function () {
    // Toasts
    const toastElement = document.querySelector('.toast');
    if (toastElement) {
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
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
