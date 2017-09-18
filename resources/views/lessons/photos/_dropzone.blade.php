<form class="dropzone" action="{{ route('photos.store', [$user, $lesson]) }}" method="POST" id="addLessonPhotosForm" data-count="{{ $lesson->photos->count() }}">

    {{ csrf_field() }}

</form>