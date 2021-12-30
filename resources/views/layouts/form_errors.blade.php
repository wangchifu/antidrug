@if($errors->any())
    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <span class="text-danger">{{ $errors->first() }}</span>
        </div>
    </div>
@endif