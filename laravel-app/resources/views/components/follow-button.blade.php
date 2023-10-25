@if ($authUser->isNot($user))
    <div class="col-auto">
        <button class="button button-light follow-button"
                data-user-id="{{ $user->id }}"
                data-is-following="{{ $isFollowing ? 'true' : 'false' }}"
                data-url="{{ $followRoute }}"
                data-delete-url="{{ $unfollowRoute }}"
        >
            <span class="button-text">
                <i class="fa-regular fa-circle-check"></i>
                {{ $isFollowing ? 'Following' : 'Follow' }}
            </span>
        </button>
    </div>
@endif
