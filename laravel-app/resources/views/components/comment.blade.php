@if (count($post->comments) > 0)
    <div class="comments">
        <div id="error-message" class="alert alert-danger" style="display: none;"></div>
        <h6 class="mb-3">Comments</h6>
        @foreach ($post->comments as $comments)
            <div class="row g-2 justify-content-center my-3">
                <div class="col-auto">
                    <a class="text-dark" href="{{ route('profile.show', $comments->user->id) }}">
                        @if ($comments->user->image_path === 'assets/images/user-solid.svg')
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
                            @if ($comments->updated_at != $comments->created_at)
                                Updated at: {{ $comments->updated_at->format('F j, Y h:i A') }}  <i class="fa Edited-solid fa-pen"></i>  
                            @else
                                {{ $comments->created_at->format('F j, Y h:i A') }}
                            @endif
                        </i>
                        @can('edit', $comments)
                            <div class="row justify-content-end">
                                <div class="col-auto">
                                    <button class="button button-light editButton" data-commentid="{{ $comments->id }}"><i
                                            class="fa-solid fa-pen"></i></button>
                                </div>
                            </div>
                        @endcan
                        <div class="my-2">
                            <div class="card post-card">
                                <div class="card-body m-2">
                                    <p id="commentComment_{{ $comments->id }}">{{ $comments->comment }}</p>
                                    <div class="buttons-container">
                                        @can('delete', $comments)
                                            <form method="GET"
                                                action="{{ route('comment.delete', $post->id, $comments->id) }}"
                                                id="deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <div class="col-md-2 text-center">
                                                    <button type="submit" class="btn btn-sm btn-danger deleteButton"
                                                        style="display: none;">Delete</button>
                                                </div>
                                            </form>
                                        @endcan
                                        @can('edit', $comments)
                                            <form method="POST"
                                                action="{{ route('comment.edit', $comments->id, $comments->comment) }}"
                                                style="display: none;" class="editForm" id="editForm_{{ $comments->id }}">
                                                @csrf
                                                <input type="hidden" name="comment_id" value="{{ $comments->id }}">
                                                <div class="form-group my-3">
                                                    <textarea name="comment" id="comment_{{ $comments->id }}" class="form-control" style="height:100px"
                                                        placeholder="Edit your comment here">{{ $comments->comment }}</textarea>
                                                </div>
                                                <div class="row justify-content-between g-3">
                                                    <div class="col-auto">
                                                        <button type="button"
                                                            class="button button-primary submit-button me-3"
                                                            data-commentid="{{ $comments->id }}">Submit</button>
                                                        <button type="button"
                                                            class="button button-secondary cancel-button">Cancel</button>
                                                    </div>
                                                    <div class="col-auto text-end">
                                                        <button type="button" class="button button-danger delete-button"><i
                                                                class="fa-regular fa-trash-can"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <i class="text-share">No comments yet. Be the first to comment!</i>
@endif
