<div id="{{$key}}" class="toast text-bg-{{$type}} mt-2">
    <script>
        (new bootstrap.Toast($('#'+@json($key)).on('hidden.bs.toast', function(){
            $(this).remove();
        }), {delay:5000})).show();
    </script>
    <div class="d-flex">
        <div class="toast-body">{{$message}}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
</div>