<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a class="text-dark" href="{{ route('profile.show', $user->id) }}">
                <img src="{{ asset('assets/images/microblog-logo-iconx30.png') }}" alt="Image">
                {{ $post->user->username }}
            </a>
            @if ($post->isShared())
                @php 
                    $originalPost = $post->originalPost;
                @endphp
                <div class="d-flex align-items-center">
                    <div class="text ms-3 m-1">Shared from
                        <a class="text-dark" href="{{ route('post.show', $originalPost->id) }}">
                            {{ $originalPost->user->username }}'s Post
                        </a>
                    </div>
                </div>
            @endif
            <div class="container p-3">
                <a id="post-card" href="{{ route('post.show', $post->id) }}">
                    <div class="card">
                        <div class="card-body">
                            <p>{{ $post->content }}</p>
                        </div>
                        <div class="card-footer fst-italic">
                            @if ($post->deleted_at)
                                Deleted at: {{ $post->deleted_at->format('F j, Y') }}
                            @elseif ($post->updated_at)
                                Updated at: {{ $post->updated_at->format('F j, Y') }}
                            @else
                                Created at: {{ $post->created_at->format('F j, Y') }}
                            @endif
                        </div>
                    </div>
                </a>
                @include('post.form_actions')
            </div>
        </div>
    </div>
</div>
