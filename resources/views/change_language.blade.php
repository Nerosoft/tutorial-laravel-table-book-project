@extends('layout_admin')
@section('containt')
@include('start_nav')
    <div class="start-page container">
        <button class="btn btn-primary" onClick="openModal('#createModel')">{{$lang->ButtonModelCreate}}</button>
        @include('model_change_language', [
        'idModal'=>'createModel',
        'idForm'=>'createForm',
        'action'=>route('lang.createLanguage'),
        'title'=>$lang->ScreenModelCreate, 
        'button'=>$lang->ButtonModelAdd])
        <div class=""> 
            <h1 id="greeting" class="text-center">{{$lang->label3}}</h1>
            <p id="description" class="text-center">{{$lang->label4}}</p>
        <div>
        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th>{{ $lang->TableId }}</th>
                    <th>{{$lang->NameLangaue}}</th>
                    <th>{{ $lang->TabelEvent }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lang->getDataTable() as $index=>$myLang)
                <tr>
                    <th>{{$loop->index+1}}</th>
                    <th>{{$myLang->getName()}}</th>
                    <th>
                        <img class="style_icon_menu pointer" src="{{asset('/lib/icons/copy.svg')}}" onclick="displayModel('#editModel{{$index}}', '{{$myLang->getName()}}')"/>
                       @include('model_change_language', ['idModal'=>'editModel'.$index,
                        'idForm'=>'editForm'.$index, 'action'=>route('language.copy'),
                        'title'=>$lang->ScreenModelEdit, 
                        'button'=>$lang->ButtonModelEdit])

                        <img class="style_icon_menu pointer" src="{{asset('/lib/icons/'.($index === $lang->language ? 'lightbulb-fill.svg' : 'lightbulb.svg'))}}" onclick="openModal('#selectLanguage{{$index}}')"></i>
                        @include('model_delete', [
                        'idModel'=>'selectLanguage'.$index,
                        'message'=>$lang->label5,
                        'title'=>$lang->TitleChangeLanguageMessage,
                        'button'=>$lang->button4,
                        'name'=>$myLang->getName(),
                        'action'=>route('language.change')])

                        @if($index !== $lang->language)
                            <img class="style_icon_menu pointer" src="{{asset('/lib/icons/trash3.svg')}}" onclick="openModal('#deleteModel{{$index}}')"/>
                            @include('model_delete', [
                            'idModel'=>'deleteModel'.$index, 
                            'message'=>$lang->messageModelDelete,
                            'title'=>$lang->titleModelDelete,
                            'button'=>$lang->buttonModelDelete,
                            'name'=>$myLang->getName(), 'action'=>route('language.delete')])
                        @endif
                    </th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>{{ $lang->TableId }}</th>
                    <th>{{$lang->NameLangaue}}</th>
                    <th>{{ $lang->TabelEvent }}</th>
                </tr>
            </tfoot>
            
        </table>
    </div>
<script type="text/javascript">
    let setting = [
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false }
];

function displayModel(id, value){
    removeClass(id);
    openModal(id);
    $(id).find('#lang_name').val(value);
}
</script>
@endsection
