<div>
    @if (count($post->comments) > 0)
        <div class="comments">
            <h6 class="ms-5">Comments</h6>
            @foreach ($post->comments as $comments)
                <div class="row justify-content-center">
                    <div class="col-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="comment-user mb-2">
                                    <img src="{{ asset('assets\images\microblog-logo-iconx30.png') }}"
                                        alt="Temporary Profile Image" class="user-profile-image">
                                    <span class="username">{{ $comments->user->username }}</span>
                                </div>
                                <div class="comment-content">
                                    <p>{{ $comments->content }}</p>
                                </div>
                            </div>
                            <div class="card-footer">{{ $comments->created_at->format('F j, Y h:m A') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No comments yet. Be the first to comment!</p>
    @endif
</div>
