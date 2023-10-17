@if ($post->isContentAvailableFor($authUser))
    <div class="post-container my-5">
        <div class="row g-2 justify-content-center">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-auto">
                <a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
                    @if ($post->user->image_path === "assets/images/user-solid.svg")
                        <div class="profile-button" id="profileButtonContainer1">
                            <div class="bg">
                                <div class="letter">
                                    {{ substr($post->user->full_name, 0, 1) }}
                                </div>
                            </div>
                        </div>
                    @else
                        <button class="custom-profile-button" id="profileButtonContainer1">
                            <div class="image-bg">
                                <img src="{{ asset($post->user->image_path) }}" alt="Profile Image">
                            </div>
                        </button>
                    @endif
                </a>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-auto">
                        <a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
                            <div class="name">
                                {{ $post->user->full_name }}
                                @if ($post->user->id === $authUser->id)
                                    <i class="text-identifier">(you)</i>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        @include('partials._follow')
                    </div>
                    <i class="date">
                        @if ($post->updated_at != $post->created_at)
                            {{ $post->updated_at->format('F j, Y') }}  <i class="fa-solid fa-pen"></i>  Edited
                        @else
                            {{ $post->created_at->format('F j, Y') }}
                        @endif
                    </i>
                    <div class="my-2">
                        @if ($post->isShared())
                            @php 
                                $originalPost = $post->originalPost;
                            @endphp
                            <div class="d-flex align-items-center">
                                <div class="text-share m-1">Shared from
                                    @if ($post->isOriginalDeleted())
                                        a deleted Post
                                    @else
                                        <a class="text-share-link" href="{{ route('post.show', $originalPost->id) }}">
                                            {{ $originalPost->user->username }}'s Post
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <a id="post-card" href="{{ route('post.show', $post->id) }}">
                            <div class="card post-card">
                                <div class="card-body m-2">
                                    <p>{{ $post->content }}</p>
                                    @if ($post->media)
                                        <img src="{{ asset($post->media->getFilePathAttribute()) }}" class="post-media" alt="Post Image">
                                    @endif
                                </div>
                            </div>
                        </a>
                        @include('post.form_actions')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
