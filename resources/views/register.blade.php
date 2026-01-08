@extends('login')
@section('containt_register')
<div class="form-group">
    <label for="password_confirmation">{{$lang->LabelPasswordConfirem}}</label>
    <input type="password" class="form-control"
    name="password_confirmation"
    title = "{{$lang->HintPasswordConfirem}}"
    minlength="8"
    required
    id="password_confirmation"
    placeholder="{{$lang->HintPasswordConfirem}}"
    oninvalid="showMessageCustom2(this, '{{$lang->RequiredConforemPassword}}', '{{$lang->InvalidConforemPassword}}', 'password')"
    oninput="showMessageCustom2(this, '{{$lang->RequiredConforemPassword}}', '{{$lang->InvalidConforemPassword}}', 'password')"
    >
</div>
<script type="text/javascript">
    function showMessageCustom2(event, req, inv, id){
        if(event.validity.valueMissing)
            event.setCustomValidity(req);
        else if(event.validity.tooShort)
            event.setCustomValidity(inv);
        else if(event.value === $('#'+id).val()){
            event.setCustomValidity('');
            $('#'+id)[0].setCustomValidity('');
        }
        else if($(event).attr('id') === 'password' && event.value !== $('#'+id).val() && $('#'+id).val().length >=8){
            event.setCustomValidity('');
            $('#'+id)[0].setCustomValidity(@json($lang->Password_ConfiremInvalid));
        }
        else if(event.value !== $('#'+id).val() && $('#'+id).val().length >=8)
            event.setCustomValidity(@json($lang->Password_ConfiremInvalid));
        else if($(event).attr('id') === 'password')
            event.setCustomValidity('');
    };
</script>
@endsection
