@if (count($post->comments) > 0)
    <div class="comments">
        <h6 class="mb-3">Comments</h6>
        @foreach ($post->comments as $comments)
            <div class="row g-2 justify-content-center my-3">
                <div class="col-auto">
                    <a class="text-dark" href="{{ route('profile.show', $comments->user->id) }}">
                        @if ($comments->user->image_path === "assets/images/user-solid.svg")
                            <div class="profile-button" id="profileButtonContainer1">
                                <div class="bg">
                                    <div class="letter">
                                        {{ substr($comments->user->full_name, 0, 1) }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <button class="custom-profile-button" id="profileButtonContainer1">
                                <div class="image-bg">
                                    <img src="{{ asset($comments->user->image_path) }}" alt="Profile Image">
                                </div>
                            </button>
                        @endif
                    </a>
                </div>
                <div class="col">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <a class="text-dark" href="{{ route('profile.show', $comments->user->id) }}">
                                <div class="name">
                                    {{ $comments->user->full_name }}
                                </div>
                            </a>
                        </div>
                        <i class="date">
                            @if ($post->deleted_at)
                                Deleted at: {{ $post->deleted_at->format('F j, Y') }}
                            @elseif ($post->updated_at != $post->created_at)
                                Updated at: {{ $post->updated_at->format('F j, Y') }}
                            @else
                                {{ $comments->created_at->format('F j, Y') }}
                            @endif
                        </i>
                        <div class="my-2">
                            <div class="card post-card">
                                <div class="card-body m-2">
                                    <p>{{ $comments->content }}</p>
                                </div>
                            </div>
                        </div>
                        @can('delete', $comments)
                        <form method="POST" action="{{ route('comment.delete', $comments) }}">
                            @csrf
                            @method('DELETE')
                            <div class="col-md-2 text-center">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <i class="text-share">No comments yet. Be the first to comment!</i>
@endif
