<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <a class="text-dark" href="{{ route('profile.index', $post->user->username) }}">
                <img src="{{ asset('assets/images/microblog-logo-iconx30.png') }}" alt="Image">
                {{ $post->user->username }}
            </a>
            <div class="container p-3">
                <a id="post-card" href="{{ route('post.show', $post->id, $post->comment) }}">
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
                <!-- Comment Form -->
                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                    @csrf

                    <div class="form-group mt-3">
                        <textarea id="content" name="content" class="form-control" rows="3" placeholder="Add a comment"></textarea>
                    </div>

                    @error('content')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="text-end">
                        <button type="submit" class="btn btn-dark">Add Comment</button>
                    </div>
                </form>
                <!-- End Comment Form -->
                @php
                    $user = auth()->user();
                @endphp
                <div>
                    @if (count($post->comments) > 0)
                        <div class="comments">
                            <h6>Comments</h6>

                            @foreach ($post->comments as $comment)
                                <div class="comment">
                                    {{-- <p>{{ $comment->user->username}} </p> --}}
                                    {{-- <p>{{ $comment->post_id}}</p> --}}
                                    <p>{{ $comment->content }}</p>
                                    {{-- <p>Posted at: {{ $comment->created_at->format('F j, Y H:i') }}</p> --}}
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No comments yet. Be the first to comment!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
