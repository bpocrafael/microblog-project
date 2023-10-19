<div class="post-container my-5">
    <div class="row g-2 justify-content-center">
        <div class="col-auto">
            <x-profile-component :post="$post" />
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
                    <a id="post-card" href="{{ route('post.show', $post->id) }}">
                        <div class="card post-card">
                            <div class="card-body m-2">
                                <p>{{ $post->content }}</p>
                                @if ($post->isShared())
                                    @php 
                                        $originalPost = $post->originalPost;
                                    @endphp
                                        <a class="text-share" href="{{ route('post.show', $originalPost->id) }}">
                                            @can ('view-post', $originalPost)
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
                                                        <p>{{ $originalPost->content }}</p>
                                                        @if ($originalPost->media)
                                                        <img src="{{ asset($originalPost->media->getFilePathAttribute()) }}" class="post-media" alt="Post Image">
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                            <div class="card bg-light">
                                                <div class="card-body m-2">
                                                    <i class="text-share">Content unavailable.</i>
                                                </div>
                                            </div>
                                        </a>
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
