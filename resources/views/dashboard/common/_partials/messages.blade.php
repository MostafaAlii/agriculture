@if (count($errors) > 0)
    <div class="col-md-12 alert alert-danger alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{-- trans('dashboard/messages.wrong') --}}</strong>
        <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('add'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ trans('dashboard/messages.add_successfully') }}",
                type: "success",
                position: "right"
            });
        }
    </script>
@endif

@if (session()->has('wrong'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ trans('dashboard/messages.wrong') }}",
                type: "worning",
                position: "right"
            });
        }
    </script>
@endif

@if (session()->has('upload'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ trans('dashboard/messages.upload') }}",
                type: "success",
                position: "right"
            });
        }
    </script>
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ trans('dashboard/messages.edit_successfully') }}",
                type: "success",
                position: "right"
            });
        }
    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ trans('dashboard/messages.delete_successfully') }}",
                type: "success",
                position: "right"
            });
        }
    </script>
@endif