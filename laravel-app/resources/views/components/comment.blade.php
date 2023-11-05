@if (count($post->comments) > 0)
    <div class="comments pb-5 mb-5">
        <div id="error-message" class="alert alert-danger" style="display: none;"></div>
        <h6 class="mb-3">Comments</h6>
        @foreach ($post->comments as $comments)
            <div class="row g-2 justify-content-center my-3">
                <div class="col-auto">
                    <a class="text-dark" href="{{ route('profile.show', $comments->user->id) }}">
                        <x-profile-component :user="$comments->user" />
                    </a>
                </div>
                <div class="col">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <a class="text-dark" href="{{ route('profile.show', $comments->user->id) }}">
                                <div class="name">
                                    {{ $comments->user->full_name }}
                                    <i class="text-identifier">({{$comments->user->username }})</i>
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
                                        class="fa-solid fa-pen"></i>
                                    </button>
                                </div>
                                @can('delete', $comments)
                                    <div class="col-auto">
                                        <button type="button" class="button button-danger" data-bs-toggle="modal" data-bs-target="#deleteCommentModal{{ $comments->id }}">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                        <div class="modal fade" id="deleteCommentModal{{ $comments->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content light-card">
                                                    <div class="modal-header">
                                                        <h6 class="" id="deleteCommentModalLabel">Confirm Deletion</h6>
                                                        <button type="button" class="button button-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this comment?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="button button-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form method="GET" action="{{ route('comment.delete', $comments->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="button button-danger">
                                                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        @endcan
                        <div class="my-2">
                            <div class="card light-card">
                                <div class="card-body m-2">
                                    <p id="commentComment_{{ $comments->id }}">{{ $comments->comment }}</p>
                                    <div class="buttons-container">
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
