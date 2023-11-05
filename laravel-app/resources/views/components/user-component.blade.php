<div class="row justify-content-center">
        <div class="card m-2">
            <div class="card-body">
                <div class="row justify-content-between align-items-center">
                    <div class="col-sm-auto">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <x-profile-component :user="$user" />
                            </div>
                            <div class="col-sm">
                                <label class="name">
                                    <a class="text-dark" href="{{ route('profile.show', $user->id) }}">
                                        <span class="text-to-highlight">{{ $user->full_name }}</span>
                                        <i class="text-identifier text-to-highlight">({{$user->username }})</i>
                                        @if ($user->id === $authUser->id)
                                            <i class="fa-regular fa-user fa-xs ms-2" title="you"></i>
                                        @endif
                                    </a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto my-3">
                        @if($authUser->isNot($user))
                            <div class="col-auto">
                                <x-follow-button :user="$user" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</div>