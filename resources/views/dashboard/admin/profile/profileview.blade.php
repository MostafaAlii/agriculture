@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
     @lang('Admin/site.profile')
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users view start -->
            <section class="users-view">
                <!-- users view media object start -->
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="media mb-2">
                            <a class="mr-1" href="#">
                                <img src="{{ asset('Dashboard/img/admins/'. Auth::user()->image->filename) }}"
                                alt="{{ asset('Dashboard/img/admins/'. Auth::user()->image->filename) }}"
                                class="users-avatar-shadow rounded-circle" height="64" width="64">
                            </a>
                            <div class="media-body pt-25">
                                <h4 class="media-heading">
                                    <span class="users-view-name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                                    {{-- <span class="text-muted font-medium-1"> @</span>
                                    <span class="users-view-username text-muted font-medium-1 ">candy007</span> --}}
                                </h4>
                                {{-- <span>ID:</span> --}}
                                <span class="users-view-id">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                        <a href="#" class="btn btn-sm mr-25 border"><i class="ft-message-square font-small-3"></i></a>
                        {{-- <a href="#" class="btn btn-sm mr-25 border">Profile</a> --}}
                        <a href="{{ route('profile.edit',encrypt(Auth::user()->id)) }}" class="btn btn-sm btn-primary"> @lang('Admin/site.edit')</a>
                    </div>
                </div>
                <!-- users view media object ends -->
                <!-- users view card data start -->
                {{-- <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Registered:</td>
                                                <td>01/01/2019</td>
                                            </tr>
                                            <tr>
                                                <td>Latest Activity:</td>
                                                <td class="users-view-latest-activity">30/04/2019</td>
                                            </tr>
                                            <tr>
                                                <td>Verified:</td>
                                                <td class="users-view-verified">Yes</td>
                                            </tr>
                                            <tr>
                                                <td>Role:</td>
                                                <td class="users-view-role">Staff</td>
                                            </tr>
                                            <tr>
                                                <td>Status:</td>
                                                <td><span class="badge badge-success users-view-status">Active</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Module Permission</th>
                                                    <th>Read</th>
                                                    <th>Write</th>
                                                    <th>Create</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Users</td>
                                                    <td>Yes</td>
                                                    <td>No</td>
                                                    <td>No</td>
                                                    <td>Yes</td>
                                                </tr>
                                                <tr>
                                                    <td>Articles</td>
                                                    <td>No</td>
                                                    <td>Yes</td>
                                                    <td>No</td>
                                                    <td>Yes</td>
                                                </tr>
                                                <tr>
                                                    <td>Staff</td>
                                                    <td>Yes</td>
                                                    <td>Yes</td>
                                                    <td>No</td>
                                                    <td>No</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- users view card data ends -->
                <!-- users view card details start -->
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            {{-- <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
                                <div class="col-12 col-sm-4 p-2">
                                    <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6>
                                </div>
                                <div class="col-12 col-sm-4 p-2">
                                    <h6 class="text-primary mb-0">Followers: <span class="font-large-1 align-middle">534</span></h6>
                                </div>
                                <div class="col-12 col-sm-4 p-2">
                                    <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>@lang('Admin/site.name'):</td>
                                            <td class="users-view-username">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Name:</td>
                                            <td class="users-view-name">Dean Stanley</td>
                                        </tr> --}}
                                        <tr>
                                            <td>@lang('Admin/site.email'):</td>
                                            <td class="users-view-email">{{ Auth::user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.phone'):</td>
                                            <td>{{ Auth::user()->phone }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                                {{-- <h5 class="mb-1"><i class="ft-link"></i> Social Links</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Twitter:</td>
                                            <td><a href="#">https://www.twitter.com/</a></td>
                                        </tr>
                                        <tr>
                                            <td>Facebook:</td>
                                            <td><a href="#">https://www.facebook.com/</a></td>
                                        </tr>
                                        <tr>
                                            <td>Instagram:</td>
                                            <td><a href="#">https://www.instagram.com/</a></td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                                <h5 class="mb-1"><i class="ft-info"></i> @lang('Admin/site.personalinfo')</h5>
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td>@lang('Admin/site.birthday'):</td>
                                            <td>{{ Auth::user()->birthdate }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.country'):</td>
                                            <td>{{ Auth::user()->country->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.province'):</td>
                                            <td>{{ Auth::user()->province->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.area'):</td>
                                            <td>{{ Auth::user()->area->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.state'):</td>
                                            <td>{{ Auth::user()->state->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.village'):</td>
                                            <td>{{ Auth::user()->village->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.department'):</td>
                                            <td>{{ Auth::user()->department->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.address1'):</td>
                                            <td>{{ Auth::user()->address1 }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.address2'):</td>
                                            <td>{{ Auth::user()->address2 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- users view card details ends -->

            </section>
            <!-- users view ends -->
        </div>
    </div>
    <!-- End Content Wrapper -->
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@endsection
