@include('start_model')
@isset($index)
    @include('form_id')
@endisset
<div class="form-group">
    <label for="lang_name" class="form-label">{{$lang->LabelNameLanguage}}</label>
    <input 
    minlength="3" 
    required
    oninvalid="showMessageCustom(this ,'{{$lang->error1}}', '{{$lang->error2}}')"
    oninput="showMessageCustom(this ,'{{$lang->error1}}', '{{$lang->error2}}')"
    type="text" name="lang_name" id="lang_name" value="{{$myLang?->getName()??''}}" placeholder='{{$lang->hint1}}' class="form-control">
</div>
@include('end_model')
