<div class="card-body">
    <div class="col-md-12">
        <h4>{{ __('common.' . $header) }}</h4>
        <hr />
    </div>
    <div class="col-md-12">
        <div class="row">
            @csrf
            <div class="col-lg-12">
                @include('components.inputs.text',
                ['label'=>'First Name','name'=>'first_name','placeholder'=>'Enter first name'])
            </div>
            <div class="col-lg-12">
                @include('components.inputs.text',
                ['label'=>'Last Name','name'=>'last_name','placeholder'=>'Enter last name'])
            </div>
            <div class="col-lg-12">
                @include('components.inputs.email',['label'=>'Email','name'=>'email','placeholder'=>'Enter email'])
            </div>

            <div class="col-lg-12">
                @include('components.inputs.password',['label'=>'Password','name'=>'password'])
            </div>

            <div class="col-lg-12">
                @include('components.inputs.password',
                ['label'=>'Re-Enter Password','name'=>'password_confirmation'])
            </div>

            <div class="col-lg-12">
                @include('components.buttons.submit',['classes'=>'btnTopMargin'])
            </div>
        </div>
    </div>
</div>
