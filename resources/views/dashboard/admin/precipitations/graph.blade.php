@extends('dashboard.layouts.dashboard')
@section('css')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/precipitations.precipitationsPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\precipitations.precipitationsPageTitle')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            {{--<li class="breadcrumb-item"><a href="{{ route('Areas.index') }}">{{ $area_name }}</a>--}}
                            {{--</li>--}}
                            {{--<li class="breadcrumb-item"><a href="{{ route('States.index') }}">{{ $state_name }}</a>--}}
                            {{--</li>--}}
                            <li class="breadcrumb-item"><a href="{{ route('Precipitations.index') }}">{{ __('Admin/precipitations.precipitations') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin/site.add') }}
                            </li>
                        </ol>

                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">
                    <media-left class="media-middle">
                        <div id="sp-bar-total-sales"></div>
                    </media-left>

                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/precipitations.newprecipitation') }}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">

                                        <div class="form-body">
                                            <form action="{{route('graph.query')}}" method="post">
                                                @csrf

                                                    <div class="row mt-2">
                                                        <div class="col col-md-6">
                                                            <div class="form-group">
                                                                <label for="area_id">{{ __('Admin/precipitations.area') }}</label>
                                                                <select name="area_id" id="area_id" class="form-control" required>
                                                                    <option value="">{{ __('Admin/site.select') }}</option>
                                                                    </option>
                                                                    @foreach ($areas as $area)
                                                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col col-md-6">

                                                            <div class="form-group">
                                                                <label for="state_id">{{ __('Admin/precipitations.state') }}</label>
                                                                <select class=" form-control" name="state_id" id="state_id">
                                                                    <option value="">{{ __('Admin/site.select') }}</option>

                                                                </select>

                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <h5>{{__('Admin\precipitations.from_date')}}<span class="text-danger"></span></h5>
                                                            <div class="controls">
                                                                <input type="date" name="start_date" id="start_date" class="form-control datepicker-autoclose" placeholder="Please select start date"> <div class="help-block"></div></div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <h5>{{__('Admin\precipitations.to_date')}}<span class="text-danger"></span></h5>
                                                            <div class="controls">
                                                                <input type="date" name="end_date" id="end_date" class="form-control datepicker-autoclose" placeholder="Please select end date"> <div class="help-block"></div></div>
                                                        </div>
                                                    </div>
                                                <div class="text-left" style="    margin-left: 15px;  ">
                                                    <button type="submit" id="" class="btn btn-info">submit</button>
                                                </div>

                                            </form>
                                        </div>
                                    <div class="row">
                                        <div id="container"></div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
<!-- END: Content-->

@endsection
@section('js')


    <script>
        $(document).ready(function() {
            //  ajax for get states data of area =====================================================================
            $('select[name="area_id"]').on('change', function() {
                var area_id = $(this).val();
                // console.log(province_id);
                if (area_id) {
                    $.ajax({
                        url: "{{ URL::to('dashboard_admin/admin/state') }}/" + area_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="state_id"]').empty();
                            $('select[name="state_id"]').append( '<option selected disabled>--select--</option>');

                            $.each(data, function(key, value) {

                                $('select[name="state_id"]').append(
                                    '<option value="' + key + '">' + value +'</option>'
                                );
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    {{--<script type="text/javascript" src="{% static 'js/highcharts.js' %}"></script>--}}
    {{--<script type="text/javascript"  src="{% static 'js/exporting.js' %}"></script>--}}
    {{--<script type="text/javascript" src="{% static 'js/offline-exporting.js'%}"></script>--}}
    {{--<script type="text/javascript" src="{% static 'js/jspdf.min.js'%}"></script>--}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var precipitationQueryfirst =  <?php echo json_encode($precipitationQueryfirst) ?>;

        Highcharts.chart('container', {
            title: {
                text: 'precipitations in 2020'
            },
            subtitle: {
                text: 'for Area'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Precipitation Rate'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'New Users',
                data: precipitationQueryfirst
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 600
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
    {{--<script type="text/javascript">--}}
        {{--let precipitationQuery = <?php echo json_encode($precipitationQueryfirst)--}}
        {{--?>--}}

        {{--console.log(precipitationQuery);--}}

        {{--Highcharts.chart('chart', {--}}
            {{--chart: {--}}
                {{--type: 'line'--}}
            {{--},--}}
            {{--title: {--}}
                {{--text: 'Precipitation between [ '+precipitationQuery.first.precipitation_date +--}}
                {{--']  and  [ '  +precipitationQuery.last.precipitation_date +']'--}}

            {{--},--}}
            {{--xAxis: {--}}
                {{--categories: [--}}
                    {{--{% for let entry in precipitationQuery.all %}'{{ entry.date }} '{% if not forloop.last %}, {% endif %}{% endfor %}--}}
        {{--]--}}


        {{--]--}}
        {{--},--}}
        {{--series: [{--}}
            {{--name: 'precipitation_rate',--}}
            {{--data: [--}}
                {{--{% for let entry in precipitationQuery %}{{ entry.precipitation_rate }}{% if not forloop.last %}, {% endif %}{% endfor %}--}}
        {{--],--}}
        {{--color: 'green'--}}
        {{--},--}}

       {{--],--}}
        {{--});--}}
    {{--</script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $('select').select2({
        theme: 'bootstrap4',
    });

</script>

@endsection

