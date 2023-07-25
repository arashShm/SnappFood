<hr>
<div>
    <h2>comments</h2>
</div>
<div>
    <form action="{{ route('comment.store') }}" class="form form-group " method="POST">
        @csrf
        <input type="hidden" name="owner_id" value="{{ $owner_id }}">
        <input type="hidden" name="owner_type" value="{{ $owner_type }}">
        <textarea name="text" rows="3" placeholder="... Please share your Idea with us "
            class="commentText form-control text-left"></textarea>
        <div class="">
            <button class="btn btn-primary my-3" type="submit">send</button>
        </div>
    </form>


</div>
<hr>

@foreach ($list as $comment)
    <div class="alert comment ">
        <div>
            <h6 class="text-danger">: {{ $comment->user->name }}</h6>
        </div>
        <hr>
        <div>
            {{ $comment->text }}
        </div>
        <hr>
        <div class="mt-0">
            <p><small class="text-muted">{{ $comment->created_at }}</small></p>
        </div>
    </div>
@endforeach
