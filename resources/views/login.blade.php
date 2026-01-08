@include('start_layout')
<link rel="stylesheet" href="{{asset('css/login_register.css')}}">
</head>
<body>
    @if($errors->any())
    @section('toast')
    @foreach($errors->all() as $key=>$message)
    @include('toast_message', ['type'=>'danger'])
    @endforeach
    @endsection
    @include('toastContainer')
    @elseif(session('success'))
    @section('toast')
    @include('toast_message', ['type'=>'success','key'=>'toastId', 'message'=>session('success')])
    @endsection
    @include('toastContainer')
    @endif
    <div class="container">
        <div class="login">
            <form id="login" action="{{$action}}" method="post">
                @csrf
                @include('database_id')
                <h4>{{$lang->TitleForm}}</h4>
                <div class="form-group">
                    <label for="email">{{$lang->LabelEmail}}</label>
                    <input type="email" class="form-control"
                    name="email"
                    title = "{{$lang->HintEmail}}"
                    required
                    value="{{old('email')}}"
                    id="email"
                    placeholder="{{$lang->HintEmail}}">
                </div>
                <div class="form-group">
                    <label for="password">{{$lang->LabelPassword}}</label>
                    <input type="password" class="form-control"
                    name="password"
                    title = "{{$lang->HintPassword}}"
                    minlength="8"
                    required
                    id="password"
                    @if(Route::currentRouteName() === 'mylogin')
                    oninvalid="showMessageCustom(this, '{{$lang->RequiredPassword}}', '{{$lang->InvalidPassword}}')"
                    oninput="showMessageCustom(this, '{{$lang->RequiredPassword}}', '{{$lang->InvalidPassword}}')"
                    @else
                    oninvalid="showMessageCustom2(this, '{{$lang->RequiredPassword}}', '{{$lang->InvalidPassword}}', 'password_confirmation')"
                    oninput="showMessageCustom2(this, '{{$lang->RequiredPassword}}', '{{$lang->InvalidPassword}}', 'password_confirmation')"
                    @endif
                    placeholder="{{$lang->HintPassword}}">
                </div>
                @yield('containt_register')
            </form>
            <button form="login" type="submit" class="mybtn btn btn-primary" onclick="validForm('#login')">{{$lang->ButtonRegisterLogin}}</button>
            <button type="button" onclick="openModal('#mymodalid')" class="mybtn btn btn-success">{{$lang->ButtonChangeLang}}</button>
            @include('start_model', [
                'idModal'=>'mymodalid',
                'idForm'=>'myformid',
                'title'=>$lang->TitleChangeLang, 
                'action'=>route('makeChangeLanguage')])
                @csrf
                @include('database_id')
                @foreach ($lang->myRadios as $key =>$radios)
                    <div class="form-check">
                    <input name="id" class="form-check-input {{$key === $lang->language ? 'flexCheck' : ''}}" value="{{$key}}" required {{$key === $lang->language ? 'checked' : ''}} type="radio">
                    <label  class="form-check-label">
                    {{$radios->getName()}}
                    </label>
                    </div>
                @endforeach
                @include('end_model', ['button'=>$lang->SaveChangeLang, 'idForm'=>'myformid'])


        </div>
    </div>
    <script type="text/javascript">
        $('#email').on('input invalid', function (){
            if(this.validity.valueMissing)
                this.setCustomValidity(@json($lang->RequiredEmail));
            else if(this.validity.typeMismatch)
                this.setCustomValidity(@json($lang->InvalidEmail));
            else
                this.setCustomValidity('');
        });
        $('#close_button').on('click', function(){
            removeClass('#mymodalid');
            if($('input[name="id"]:checked').val() !== @json($lang->language))
                $('.flexCheck').prop('checked', true);
        });
       $('input[name="id"]').on('change', function(){
            validForm('#myformid');
            if(this.value !== @json($lang->language))
                $('.flexCheck')[0].setCustomValidity('');
            else
                this.setCustomValidity(@json($lang->ChangeLagUsed));
        });
        $('#button_modal').on('click', function(){
           if($('input[name="id"]:checked').val() === @json($lang->language))
                $('input[name="id"]:checked')[0].setCustomValidity(@json($lang->ChangeLagUsed));
        });
    </script>
</body>
</html>