{{--Making sections for error-messages of each form field if it exists--}}
@if ($errors->all())
    @foreach($errors->keys() as $error_key)
        @section($error_key . '_error')
            <div class="error-info">
                <p>* {{$errors->first($error_key)}}</p>
            </div>
        @stop
    @endforeach
@endif