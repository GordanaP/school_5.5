<div class="row bg-white">
                <p class="text-secondary mb-30">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </p>
            </div>

            <div class="row  bg-white pd-30 border-light-grey">

                <!-- Lesson content-->
                <div class="col-md-8">
                    gordana
                </div>

                <!-- Readings and media -->
                <div class="col-md-4">
                    <div class="bg-secondary-light">
                        @foreach ($lesson->readings as $reading)
                            <p class="text-uppercase ls-1"><b>Readings</b></p>
                            <p class="mt-6 text-secondary">{{ $reading->title }}</p>
                        @endforeach

                        <p class="text-uppercase ls-1 mt-24"><b>Media</b></p>

                        <p class="mt-6">
                            <a href="https://www.youtube.com/watch?v=QIU_UbkPnaU">
                                How to sqaure any 2 digit number in your head
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row mt-18">
                @foreach ($lesson->photos->chunk(4) as $chunk)
                    <div class="row lesson__photos mb-6">
                        @foreach ($chunk as $photo)
                            <div class="col-md-3">

                                @include('lessons.photos._photo')

                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Dropzone -->
            {{-- @include('lessons.photos._dropzone') --}}

        </div>