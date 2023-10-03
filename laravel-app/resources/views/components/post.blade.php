<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a class="text-dark" href="{{ route('profile.index', $post->user->username) }}">
                <img src="{{ asset('assets/images/microblog-logo-iconx30.png') }}" alt="Image">
                {{ $post->user->username }}
            </a>
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
                <form class="like-form"
                    data-post-id="{{ $post->id }}"
                    action="{{ route(
                        $post->likes->contains('user_id', $user->id) ? 'post.unlike' : 'post.like',
                        $post
                    ) }}" 
                    method="POST">
                    <div class="row justify-content-end align-items-center p-1">
                        <div class="col-md-2 m-2 text-center">
                            <div class="card p-1 likes-count" data-post-id="{{ $post->id }}">
                                {{ $post->likes->count() }} Likes
                            </div>
                        </div>
                        @csrf
                        @if($post->likes->contains('user_id', $user->id))
                            @method('DELETE')
                            <div class="col-md-2 text-center">
                                <button type="submit" class="btn btn-secondary unlike-button">Unlike</button>
                            </div>
                        @else
                            <div class="col-md-2 text-center">
                                <button type="submit" class="btn btn-dark like-button">Like</button>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
