<a class="text-dark" href="{{ route('profile.show', $user->id) }}">
    @if ($user->image_path === "assets/images/user-solid.svg")
        <div class="profile-button" id="profileButtonContainer1">
            <div class="bg">
                <div class="letter">
                    {{ $user->first_letter }}
                </div>
            </div>
        </div>
    @else
        <button class="custom-profile-button" id="profileButtonContainer1">
            <div class="image-bg">
                <img src="{{ asset($user->image_path) }}" alt="Profile Image">
            </div>
        </button>
    @endif
</a>
