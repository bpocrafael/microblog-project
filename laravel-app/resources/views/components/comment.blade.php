<div>
    @if (count($comments) > 0)
        <div class="comments">
            <h6>Comments</h6>

            @foreach ($comments as $comment)
                <div class="comment">
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>No comments yet. Be the first to comment!</p>
    @endif
</div>
