@extends('layout_admin')
@section('containt')
@include('start_nav')
<div class="start-page container">
    <table id="example" class="table table-striped" >
        <thead>
            <tr>
                <th>{{ $lang->TableId }}</th>
                @if(!request()->route('lang') && !request()->route('id'))
                <th>{{$lang->table10}}</th>
                @endif
                <th>{{$lang->LanguageValue}}</th>
                <th>{{ $lang->TabelEvent }}</th>
            </tr>
        </thead>
        @php
            $index = 1
        @endphp
        <tbody id="table-data">
            @if(!request()->route('lang') && !request()->route('id'))
                @foreach($lang->getDataTable() as $myNameLang=>$data)
                    @foreach($data as $key=>$myData)
                        @foreach($myData as $key2=>$items)
                            @if(is_array($items))
                                @foreach($items as $key3=>$items)
                                    <tr>
                                        <th>{{$index++}}</th>
                                        <th>{{$lang->getDataTable()[$lang->language]['AllNamesLanguage'][$myNameLang]}}</th>
                                        <th>{{$items}}</th>
                                        @include('table_array', ['idModal'=>'editModel'.$index, 'title'=>$lang->ScreenModelEdit, 'idForm'=>'editForm'.$index, 'button'=>$lang->ButtonModelEdit, 'action'=>route('edit.editAllLanguage', ['lang'=>$myNameLang, 'id'=>$key, 'name'=>$key2, 'item'=>$key3])])
                                    </tr>
                                @endforeach
                            @elseif($key === 'Html')
                                <tr>
                                    <th>{{$index++}}</th>
                                    <th>{{$lang->getDataTable()[$lang->language]['AllNamesLanguage'][$myNameLang]}}</th>
                                    <th>{{$items}}</th>
                                    @include('direction', ['idForm'=>'editForm'.$index, 'idModal'=>'editModel'.$index, 'title'=>$lang->model2, 'button'=>$lang->button2, 'action'=>route('edit.editAllLanguage', ['lang'=>$myNameLang, 'id'=>$key, 'name'=>$key2])])
                                </tr>
                            @else
                                <tr>
                                    <th>{{$index++}}</th>
                                    <th>{{$lang->getDataTable()[$lang->language]['AllNamesLanguage'][$myNameLang]}}</th>
                                    <th>{{$items}}</th>
                                    @include('table_array', ['idModal'=>'editModel'.$index, 'title'=>$lang->ScreenModelEdit, 'idForm'=>'editForm'.$index, 'button'=>$lang->ButtonModelEdit, 'action'=>route('edit.editAllLanguage', ['lang'=>$myNameLang, 'id'=>$key, 'name'=>$key2])])
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            
            @else
                @foreach($lang->getDataTable() as $key=>$items)
                    @if(is_array($items))
                        @foreach($items as $key3=>$items)
                            <tr>
                                <th>{{$index++}}</th>
                                <th>{{$items}}</th>
                                @include('table_array', ['idModal'=>'editModel'.$index, 'title'=>$lang->ScreenModelEdit, 'idForm'=>'editForm'.$index, 'button'=>$lang->ButtonModelEdit, 'action'=>route('edit.editAllLanguage', ['lang'=>request()->route('lang'), 'id'=>request()->route('id'), 'name'=>$key, 'item'=>$key3])])
                            </tr>
                        @endforeach
                    @elseif(request()->route('id') === 'Html')
                        <tr>
                            <th>{{$index++}}</th>
                            <th>{{$items}}</th>
                            @include('direction', ['idForm'=>'editForm'.$index, 'idModal'=>'editModel'.$index, 'title'=>$lang->model2, 'button'=>$lang->button2, 'action'=>route('edit.editAllLanguage', ['lang'=>request()->route('lang'), 'id'=>request()->route('id'), 'name'=>$key])])
                            
                        </tr>
                    @else
                        <tr>
                            <th>{{$index++}}</th>
                            <th>{{$items}}</th>
                            @include('table_array', ['idModal'=>'editModel'.$index, 'title'=>$lang->ScreenModelEdit, 'idForm'=>'editForm'.$index, 'button'=>$lang->ButtonModelEdit, 'action'=>route('edit.editAllLanguage', ['lang'=>request()->route('lang'), 'id'=>request()->route('id'), 'name'=>$key])])                            
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>       
        <tfoot>
            <tr>
                <th>{{ $lang->TableId }}</th>
                @if(!request()->route('lang') && !request()->route('id'))
                <th>{{$lang->table10}}</th>
                @endif
                <th>{{$lang->LanguageValue}}</th>
                <th>{{ $lang->TabelEvent }}</th>
            </tr>
        </tfoot>
        </table>
</div>
<script type="text/javascript">
    let setting = @json(!request()->route('lang') && !request()->route('id')) ? [
                { 'searchable': true },
                { 'searchable': false },
                { 'searchable': true },
                { 'searchable': false }
            ]:
            [
                { 'searchable': true },
                { 'searchable': true },
                { 'searchable': false }
            ]
    function displayEditForm(id, inputValue, value){
        removeClass(id);
        openModal(id);
        inputValue.val(value);
    }
    function displayEditForm2(id, selectBox, value){
        openModal(id);
        selectBox.each(function(){
            if($(this).val() == value)
                $(this).prop('selected', true);
        });
}
</script>
@endsection