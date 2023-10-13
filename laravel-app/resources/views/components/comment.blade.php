<div>
    @if (count($post->comments) > 0)
        <div class="comments">
            <h6 class="mt-0 m-3">Comments</h6>
            @foreach ($post->comments as $comments)
                <div class="row justify-content-center">
                    <div class="col-11">
                        <div class="comment-user mb-2">
                            <a href="{{ route('profile.show', $post->user->id) }}" class="text-dark">
                                <img src="{{ asset('assets\images\microblog-logo-iconx30.png') }}"
                                    alt="Temporary Profile Image" class="user-profile-image">
                                <span class="username">{{ $comments->user->username }}</span>
                            </a>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="comment-content">
                                    <p>{{ $comments->content }}</p>
                                </div>
                            </div>
                            <div class="card-footer fst-italic">{{ $comments->created_at->format('F j, Y h:m A') }}
                            </div>
                        </div>
                        <form method="POST" action="{{ route('comment.delete', $comments) }}">
                            @csrf
                            @method('DELETE')
                            <div class="col-md-2 text-center">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    @endforeach
</div>
@else
<p>No comments yet. Be the first to comment!</p>
@endif
</div>
