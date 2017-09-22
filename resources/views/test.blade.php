@extends('layouts.app')



@section('content')


@endsection


@section('scripts')
    <script>
        Dropzone.options.addLessonPhotosForm = {
            paramName: 'photo', // change default input name
            maxFiles: maxFilesRemained,
            accept: function(file, done) {
                console.log("uploaded");
                done();
            },
            init: function() {
                this.on("maxfilesexceeded", function(file){
                if(lessonFilesCount == 0)
                {
                    alert('Only three files per lesson are allowed.');
                }
                else{
                    alert("The remaining number of the allowed files for this lesson is " + maxFilesRemained + ".");
                }
            },
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp, .gif',
            success: function(file, response) {
                if (file.status == 'success') {
                    fileUpload.handleSuccess(response);
                }
                else{
                    fileUpload.handleError(response);
                }
            }
         }//Dropzone

        var fileUpload = {
            handleSuccess: function(response){
                console.log(response);

                var gallery = $('.lesson__photos');
                var baseUrl = 'http://localhost/school_5.5/public/';
                var photoPath = response.thumbnail_path;
                $(gallery).append('<img src="' + baseUrl + photoPath + '" class="image">');
            },
            handleError: function(response){

            }
        }
    </script>
@endsection


