<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->
@include('dashboard.common.includes._mail_header')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application  fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    @include('dashboard.common.includes._header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('dashboard.common.includes._sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content email-app-sidebar d-flex">
                    <!-- sidebar close icon -->
                    <span class="sidebar-close-icon">
                        <i class="ft-x"></i>
                    </span>
                    <!-- sidebar close icon -->
                    <div class="email-app-menu">
                        <div class="form-group form-group-compose">
                            <!-- compose button  -->
                            <button type="button" class="btn btn-danger btn-glow btn-block my-2 compose-btn">
                                <i class="ft-plus"></i>
                                Compose
                            </button>
                        </div>
                        
                    </div>
                </div>
                <!-- User new mail right area -->
                <div class="compose-new-mail-sidebar">
                    <div class="card mb-0 shadow-none quill-wrapper p-0">
                        <div class="card-header">
                            <h3 class="card-title" id="emailCompose">New Message</h3>
                            <button type="button" class="close close-icon">
                                <i class="ft-x"></i>
                            </button>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('mail.send') }}" method="post" autocomplete="off" id="compose-form">
                         @csrf
                            <div class="card-content">
                                <div class="card-body pt-0">
                                    <div class="form-group pb-50">
                                        <label for="emailfrom">from</label>
                                        <input type="text" id="emailfrom" class="form-control" placeholder="{{env('MAIL_FROM_ADDRESS')}}" disabled>
                                    </div>
                                    <div class="form-label-group mb-1">
                                        <input type="email" id="emailTo" class="form-control" placeholder="To" name="emailTo" required>
                                    </div>
                                    <div class="form-label-group mb-1">
                                        <input type="text" id="emailSubject" class="form-control" placeholder="Subject" name="emailSubject" required>
                                    </div>
                            
                                    <!-- Compose mail Quill editor -->
                                    <div class="snow-container border rounded p-50 ">
                                    <textarea class="form-control" placeholder="type something ...." name="emailComment" required></textarea>

                                        <!-- <div class="compose-editor mx-75"></div> -->
                                        <!-- <div class="d-flex justify-content-end">
                                            <div class="compose-quill-toolbar pb-0">
                                                <span class="ql-formats mr-0">
                                                    <button class="ql-bold"></button>
                                                    <button class="ql-italic"></button>
                                                    <button class="ql-underline"></button>
                                                    <button class="ql-link"></button>
                                                    <button class="ql-image"></button>
                                                </span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-0 d-flex justify-content-end pt-0">
                                <button type="reset" class="btn btn-secondary cancel-btn mr-1">
                                    <i class='ft-x mr-25'></i>
                                    <span class="d-sm-inline d-none">Cancel</span>
                                </button>
                                <button type="submit" class="btn-send btn btn-danger btn-glow">
                                    <i class='ft-play mr-25'></i> <span class="d-sm-inline d-none">Send</span>
                                </button>
                            </div>
                        </form>
                        <!-- form start end-->
                    </div>
                </div>
                <!--/ User Chat profile right area -->

            </div>
        </div>
        
        <div class="content-right">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <!-- email app overlay -->
                    <div class="app-content-overlay"></div>
                    <div class="email-app-area">
                        <!-- Email list Area -->
                        <div class="email-app-list-wrapper">
                            <div class="email-app-list">

                                 <!-- / action right -->
                                <div class="email-action">
                                    <!-- action left start here -->
                                    <div class="action-left d-flex align-items-center">
                                        <!-- select All checkbox -->
                                        <div class="custom-control custom-checkbox selectAll mr-50">
                                            <input type="checkbox" class="custom-control-input" id="checkboxsmall">
                                            <label class="custom-control-label" for="checkboxsmall"></label>
                                        </div>
                                        <!-- delete unread dropdown -->
                                        <ul class="list-inline m-0 d-flex">
                                            <li class="list-inline-item mail-delete">
                                                <button type="button" class="btn btn-icon action-icon" data-toggle="modal"
                                                    data-target="#bulkdelete" id="btn_delete_all">
                                                    <i class="ft-trash-2"></i>
                                                </button>

                                            </li>
                                            <!-- <li class="list-inline-item mail-unread">
                                                <button type="button" class="btn btn-icon action-icon">
                                                    <i class="ft-mail"></i>
                                                </button>
                                            </li> -->
                                            <!-- <li class="list-inline-item">
                                                <div class="dropdown">
                                                    <button type="button" class="dropdown-toggle btn btn-icon action-icon" id="folder" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ft-folder mr-0"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="folder">
                                                        <a class="dropdown-item" href="#"><i class="ft-edit"></i> Draft</a>
                                                        <a class="dropdown-item" href="#"><i class="ft-info"></i>Spam</a>
                                                        <a class="dropdown-item" href="#"><i class="ft-trash-2"></i>Trash</a>
                                                    </div>
                                                </div>
                                            </li> -->
                                            <!-- <li class="list-inline-item">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-icon dropdown-toggle action-icon" id="tag" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ft-tag mr-0"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="tag">
                                                        <a href="#" class="dropdown-item align-items-center">
                                                            <span class="bullet bullet-success bullet-sm"></span>
                                                            <span>Product</span>
                                                        </a>
                                                        <a href="#" class="dropdown-item align-items-center">
                                                            <span class="bullet bullet-primary bullet-sm"></span>
                                                            <span>Work</span>
                                                        </a>
                                                        <a href="#" class="dropdown-item align-items-center">
                                                            <span class="bullet bullet-warning bullet-sm"></span>
                                                            <span>Misc</span>
                                                        </a>
                                                        <a href="#" class="dropdown-item align-items-center">
                                                            <span class="bullet bullet-danger bullet-sm"></span>
                                                            <span>Family</span>
                                                        </a>
                                                        <a href="#" class="dropdown-item align-items-center">
                                                            <span class="bullet bullet-info bullet-sm"></span>
                                                            <span> Design</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <!-- action left end here -->

                                    <!-- action right start here -->
                                    <div class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                                        <!-- search bar  -->
                                        <div class="email-fixed-search flex-grow-1">
                                            <div class="sidebar-toggle d-block d-lg-none">
                                                <i class="ft-align-justify"></i>
                                            </div>
                                            <fieldset class="form-group position-relative has-icon-left m-0">
                                                <input type="text" class="form-control" id="email-search" placeholder="Search email">
                                                <div class="form-control-position">
                                                    <i class="ft-search"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <!-- pagination and page count -->
                                        <span class="d-none d-sm-block">{{$mails}}</span>
                                       
                                    </div>
                                </div>
                                <!-- / action right -->

                                <!-- email user list start -->
                                <div class="email-user-list list-group">
                               
                                    <ul class="users-list-wrapper media-list" id="list_id">
                                        @foreach($mails as $msgs)
                                        <li class="media mail-read" id="{{$msgs->id}}">
                                            <div class="user-action">
                                                <div class="checkbox-con mr-25">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkboxsmall{{$msgs->id}}"  onclick="javascript:check('{{$msgs->id}}');" value="{{ $msgs->id }}">
                                                        <label class="custom-control-label" for="checkboxsmall{{$msgs->id}}"></label>
                                                    </div>
                                                </div>
                                                <!-- <span class="favorite warning">
                                                    <i class="ft-star"></i>
                                                </span> -->
                                            </div>
                                            <i class="material-icons" style="padding-left: inherit;"> mail_outline </i> 
                                            
                                            <!-- ###################################################################### -->
                                            <div class="media-body">
                                                <div class="user-details">
                                                    <div class="mail-items">
                                                        <span class="list-group-item-text text-truncate">Contact From {{$msgs->firstname.' '.$msgs->lastname}}</span>
                                                    </div>
                                                    <div class="mail-meta-item">
                                                        <span class="float-right">
                                                            <span class="mail-date">{{$msgs->created_at}}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="mail-message">
                                                    <p class="list-group-item-text truncate mb-0">
                                                        <?php
                                                       echo substr($msgs->comment, 0, 20).'...';
                                                        ?>
                                                    </p>
                                                    <div class="mail-meta-item">
                                                        <span class="float-right">
                                                            <span class="bullet bullet-success bullet-sm"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ###################################################################### -->
                                        </li>
                                        @endforeach
                                    </ul>
                                    <!-- email user list end -->
                                    @if(count($mails)==0)
                                    <!-- no result when nothing to show on list -->
                                    <div class="no-results">
                                        <i class="ft-info font-large-2"></i>
                                        <h5>No Items Found</h5>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--/ Email list Area -->
                        @foreach($mails as $m)
                        <!-- Detailed Email View -->
                        <div class="email-app-details" id="detail_{{$m->id}}" style="display:none;">
                            <!-- email detail view header -->
                            <div class="email-detail-header">
                                <div class="email-header-left d-flex align-items-center mb-1">
                                    <span class="go-back mr-50">
                                        <i class="ft-chevron-left font-medium-4 align-middle"></i>
                                    </span>
                                    <h5 class="email-detail-title font-weight-normal mb-0">
                                    Contact From {{$m->firstname.' '.$m->lastname}}
                                    </h5>
                                </div>
                                <div class="email-header-right mb-1 ml-2 pl-1">
                                    <ul class="list-inline m-0">
                                       
                                    </ul>
                                </div>
                            </div>
                            <!-- email detail view header end-->
                            <div class="email-scroll-area">
                                <!-- email details  -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="collapsible email-detail-head">
                                            <div class="card collapse-header open" role="tablist">

                                                <div id="headingCollapse5" class="card-header d-flex justify-content-between align-items-center" data-toggle="collapse" role="tab" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                                    <div class="collapse-title media">
                                                        <div class="pr-1">
                                                        <i class="material-icons" style="padding-left: inherit;"> mail_outline </i> 

                                                        </div>
                                                        <div class="media-body mt-25">
                                                            <span class="text-primary">{{$m->firstname.' '.$m->lastname}}</span>
                                                            <span class="d-sm-inline d-none"> &lt;{{$m->email}}&gt;</span>
                                                            <small class="text-muted d-block">to {{env('MAIL_FROM_ADDRESS')}}</small>
                                                            <small class="text-muted d-block">phone: {{$m->phone}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="information d-sm-flex d-none align-items-center">
                                                        <small class="text-muted mr-50">{{$m->created_at}}</small>
                                                        <span class="favorite">
                                                            <i class="ft-star mr-25"></i>
                                                        </span>
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle" id="fisrt-open-submenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class='ft-more-vertical mr-0'></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="fisrt-open-submenu">
                                                                <a href="#" class="dropdown-item mail-reply">
                                                                    <i class='ft-share-2'></i>
                                                                    Reply
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="collapse5" role="tabpanel" aria-labelledby="headingCollapse5" class="collapse show">
                                                    <div class="card-content">
                                                        <div class="card-body py-1">
                                                            <br>
                                                            <p>
                                                                {{$m->comment}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- email details  end-->
                                <div class="row px-2 mb-4">
                                    <!-- quill editor for reply message -->
                                    <div class="col-12 px-0">
                                        <div class="card shadow-none border rounded">
                                            <div class="card-body quill-wrapper">
                                                <span>Reply to {{$m->email}}</span>
                                                <form action="{{ route('mail.replay',$m->id) }}" method="post" autocomplete="off">
                                                @csrf
                                                <!-- this will used to send mail back (replay) to sender -->
                                                    <input type="hidden" name="sender_mail_{{$m->id}}" value="{{$m->email}}">
                                                    <div class="snow-container" id="detail-view-quill">
                                                        <br>
                                                         <textarea id="eventRegInput4" class="form-control" placeholder="type something ...." name="comment_{{$m->id}}" required></textarea>
                                                        <!-- <div class="detail-view-editor"></div> -->
                                                        <div class="d-flex justify-content-end">
                                                            <!-- <div class="detail-quill-toolbar">
                                                                <span class="ql-formats mr-50">
                                                                    <button class="ql-bold"></button>
                                                                    <button class="ql-italic"></button>
                                                                    <button class="ql-underline"></button>
                                                                    <button class="ql-link"></button>
                                                                    <button class="ql-image"></button>
                                                                </span>
                                                            </div> -->
                                                            <button type="submit" class="btn btn-primary send-btn">
                                                                <i class='ft-play mr-25'></i>
                                                                <span class="d-none d-sm-inline"> Send</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Detailed Email View -->
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <form action="{{ route('mail.delete') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
    @csrf
    @method('POST')
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="modal animated flipInY text-left" id="bulkdelete" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel62">  حذف الرسائل المُحدده</h4>
                            <input type="hidden" id="delete_select_id" name="delete_select_id" value="">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>هل تريد بالفعل حذف هذه الرسائل المُحدده ؟</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/site.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/site.delete') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


    <!-- BEGIN: Footer-->
    @include('dashboard.common.includes._footer')
   @include('dashboard.common.includes._mail_footer')
<script>
    $("#list_id li").click(function(){
       // alert(this.id);
        const boxes = document.getElementsByClassName('email-app-details');

        for (const box of boxes) {
        // 👇️ Remove element from DOM
        box.style.display = 'none';
        // 👇️ hide element (still takes up space on page)
        // box.style.visibility = 'hidden';
        }

        document.getElementById('detail_'+this.id).style.display='block';
    });

    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#list_id input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
           // alert(selected);
            if (selected.length > 0) {
                // $('#delete_all').modal('show')
                $('input[id="delete_select_id"]').val(selected);
            }
        });
    });


    function check(id){
       // alert(id);
        var selected = new Array();
            $("#list_id input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
           // alert(selected);
            if (selected.length > 0) {
                // $('#delete_all').modal('show')
                $('input[id="delete_select_id"]').val(selected);
            }
    }
</script>
    <!-- END: Footer-->

</body>
<!-- END: Body-->

</html>