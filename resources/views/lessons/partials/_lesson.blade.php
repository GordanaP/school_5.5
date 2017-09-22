<header class="lesson__title grayscale-20">
    <h1 class="flex align-center ls-1">
        <img src="{{ asset('images/icons/maths.svg') }}" alt="" width="7%">
        <span>{{ $lesson->title }}</span>
    </h1>
</header>
<section class="col-md-12 lesson__ratings">
    <a href="#"><i class="fa fa-star"></i></a>
    <a href="#"><i class="fa fa-star"></i></a>
    <a href="#"><i class="fa fa-star"></i></a>
    <i class="fa fa-star"></i>
    <i class="fa fa-star"></i>
</section>
<section class="lesson__details">
    <main class="col-md-8">
        <h4>
            <img src="{{ asset('images/icons/key.png') }}" alt="" width="5%">
            Topic
        </h4>
        <p>{{ $lesson->topic }}</p>

        <hr>

        <h4>
            <img src="{{ asset('images/icons/goal.png') }}" alt="" width="5%">
            Learning objectives
        </h4>
        <p>{{ $lesson->goals }}</p>

        <hr>

        <!-- Materials -->
        <h4>
            <img src="{{ asset('images/icons/pin.png') }}" alt="" width="5%">
            Materials
        </h4>

        <p class="text-uppercase ls-1 readings">Readings</p>
        @foreach ($lesson->readings as $reading)
            <p>
                <i class="fa fa-circle" aria-hidden="true" style="color: #9ccc65"></i> {{ $reading->title }}
            </p>
        @endforeach

        <p class="text-uppercase ls-1 media">Media</p>
        <p>
            <i class="fa fa-circle" aria-hidden="true" style="color: #ffc64d"></i>
            <a href="https://www.youtube.com/watch?v=QIU_UbkPnaU">
                How to sqaure any 2 digit number in your head
            </a>
        </p>
    </main>
    <aside class="col-md-4 lesson__teacher">
        <div class="well text-center">
            <img src="{{ asset('images/teachers/teacher.jpg') }}" alt="{{ $lesson->teacher->first_name }}" class="img-circle">
            <p class="text-uppercase lesson__teacher-name">{{ $lesson->teacher->full_name }}</p>
            <p class="mb-6"><b>Subject:</b> <span>{{ $lesson->subject->name }}</span></p>
            <p><b>Year:</b> {{ $lesson->year }}</p>
        </div>
    </aside>
</section>

<!-- Photos -->
<footer class="lesson__photos row">
    <div class="col-md-12" id="gallery-images">
        <ul>
        @foreach ($lesson->photos as $photo)
            <li class="col-md-3">
                @include('lessons.photos._photo')
            </li>
        @endforeach
        </ul>
    </div>
</footer>

<section class="col-md-12">
    <form class="dropzone" action="{{ route('photos.store', [$user, $lesson]) }}" method="POST" id="addLessonPhotosForm" data-count="{{ $lesson->photos->count() }}">

        {{ csrf_field() }}

    </form>
</section>