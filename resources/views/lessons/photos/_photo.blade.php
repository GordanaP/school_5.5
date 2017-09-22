<form action="{{ route('photos.destroy', $photo) }}" method="POST">

    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <button class="btn lesson__photos-remove">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </button>

</form>

<a href="{{ asset($photo->path) }}" data-lightbox="{{ $photo->lesson_id }}" data-title="My caption">
    <img src="{{ asset($photo->thumbnail_path) }}" class="image">
</a>