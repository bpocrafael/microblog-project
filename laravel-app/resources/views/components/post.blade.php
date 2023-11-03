<div class="post-container my-5">
    <div class="row g-2 justify-content-center">
        <div class="col-auto">
            <x-profile-component :user="$post->user" />
        </div>
        <div class="col-md-6">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
                        <div class="name">
                            {{ $post->user->full_name }}
                            <i class="text-identifier">({{$post->user->username }})</i>
                            @if ($post->user->id === $authUser->id)
                                <i class="fa-regular fa-user fa-xs ms-2" title="you"></i>
                            @endif
                        </div>
                    </a>
                </div>
                <div class="col">
                    <x-follow-button :user="$post->user" />
                </div>
                <i class="date">
                    @if ($post->isEdited())
                        {{ $post->updated_at->format('F j, Y  h:i A') }}  <i class="fa-solid fa-pen"></i>  Edited
                    @else
                        {{ $post->created_at->format('F j, Y h:i A') }}
                    @endif
                </i>
                <div class="my-2">
                    <a id="post-card" href="{{ route('post.show', $post->id) }}">
                        <div class="card post-card">
                            <div class="card-body m-2">
                                <p class="word-to-highlight">{!! nl2br(e($post->content)) !!}</p>
                                @if ($post->isShared())
                                    @php 
                                        $originalPost = $post->originalPost;
                                    @endphp
                                        @can('view-post', $post)
                                            <a class="text-share" href="{{ route('post.show', $originalPost->id) }}">
                                                <div class="d-flex align-items-center mt-4">
                                                    <div class="text-share m-1">Shared from
                                                        @if ($post->isOriginalDeleted())
                                                            a deleted Post
                                                        @else
                                                        {{ $originalPost->user->username }}'s Post
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card post-card-share">
                                                    <div class="card-body mb-3">
                                                        <p class="word-to-highlight">{!! nl2br(e($originalPost->content)) !!}</p>
                                                        @if ($originalPost->media)
                                                        <img src="{{ asset($originalPost->media->getFilePathAttribute()) }}" class="post-media" alt="Post Image">
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        @else
                                            <div class="card bg-light">
                                                <div class="card-body m-2">
                                                    <i class="text-share">Content unavailable.</i>
                                                </div>
                                            </div>
                                        @endcan
                                @elseif ($post->media)
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
