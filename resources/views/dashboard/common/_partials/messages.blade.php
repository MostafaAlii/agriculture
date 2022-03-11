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

{{-- @if (session('success'))

    <script>
        new Noty({
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif

@if(session('error'))

    <script>
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: "{{ session('error') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif --}}
@if ($errors->any())
    <div class="alert alert-danger " >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong style="padding-right: 35px;">{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('Edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong style="padding-right: 35px;">{{ session()->get('Edit') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('Delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong style="padding-right: 35px;">{{ session()->get('Delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
