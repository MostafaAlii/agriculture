<br>
@if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<hr>

@if (Auth::guard('vendor')->user() || Auth::guard('web')->user() || Auth::guard('admin')->user())

       <center> <h3> {{ __('website\comments.leave_comment') }}</h3></center>

        <form class="auth-form" name="form-login" method="POST" action="/{{$type}}/{{ $type_id }}/comments">
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="input-wrp">
                        <textarea name="comment" class="textfield" cols="30" rows="5"
                            placeholder="{{ __('website\comments.write_comment') }}"
                            required>{{ old('comment') }}</textarea>
                    </div>
                    @error('comment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="hidden" name="from" value="add">
                </div>
                <div class="col-3">
                    <div class="d-table mt-8">
                        <div class="d-table-cell align-middle">
                            <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                role="button">{{ __('website\comments.publish') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    <hr>
@else
    <div class="alert alert-danger">
        <center>{{ __('website\comments.not_auth') }}</center>
    </div>
@endif

@if (sizeof($comments) == 0)
@else
    <h2> {{ __('website\comments.comments') }}</h2>

    <table>
        @foreach ($comments as $comment)
            <tr>

                <td width="100%">

                <?php
               // if(Auth::guard('web')->user()->email == $comment->email){
                if(Auth::guard('web')->user()){
                     $src=asset('Dashboard/img/farmers/' . $comment->image);
                }elseif(Auth::guard('vendor')->user()){
                     $src=asset('Dashboard/img/users/' . $comment->image);
                }elseif(Auth::guard('admin')->user()){
                     $src=asset('Dashboard/img/admins/' . $comment->image);
                }
                ?>

                <img class="user-img img-fluid rounded-circle" style="width:50px; height:50px;border-radius: 15%;" src="{{$src}}" />

                    <br>
                    <time class="comment__date-post">{{ $comment->created_at->format('Y-m-d') }}</time>
                    <br>
                    <span class="comment__author-name">{{ $comment->name }}</span>
                    <span class="comment__author-name">{{ $comment->email }}</span>
                    <p>{{ $comment->comment }}</p>
                </td>
                <td>
                    <br>
                    <br>
                    @if (Auth::guard('vendor')->user())
                        <div class="text-right">
                            <!-- || (Auth::guard('vendor')->user()->email != $comment->email ) -->
                            @if (Auth::guard('vendor')->user()->email != $comment->email)
                                <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" onclick="
                                document.getElementById('replay_'+ <?php echo $comment->id; ?>).style.display='block';
                            ">{{ __('website\comments.replay') }}</a>
                            @endif
                            <form action="/comments/{{ $comment->id }}" method="POST" class="mb-0 mt-3">
                                @csrf
                                @method('DELETE')
                                <div class="text-right">
                                    <!-- || (Auth::guard('vendor')->user()->email == $comment->email ) -->
                                    @if (Auth::guard('vendor')->user()->email == $comment->email)
                                        <button type="submit"
                                            class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1"
                                            style="margin-top: -90px;margin-right: 98px;">{{ __('website\comments.delete') }}</button>
                                    @endif
                                </div>
                            </form>

                            <!-- $ -->
                            <!-- <button type="button" class="btn btn-btn btn-danger btn-sm " style="margin-top: -132px;margin-right: 162px;" data-toggle="modal" data-target="#delete{{ $comment->id }}">
                                {{ __('Admin/site.delete') }}
                            </button> -->

                            <form action="/comments/{{ $comment->id }}" class="my-1 my-xl-0" method="post"
                                style="display: inline-block;">
                                @csrf
                                @method('delete')

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <!-- Modal -->
                                        <div class="modal animated flipInY text-left" id="delete{{ $comment->id }}"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel62">
                                                            {{ __('Admin/site.delete') }}</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <input type="hidden" value="{{ $comment->id }}">
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>{{ __('Admin/site.warning') }}</h5>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn grey btn-outline-secondary"
                                                            data-dismiss="modal">
                                                            {{ __('Admin/site.close') }}</button>
                                                        <button type="submit" class="btn btn-outline-primary">
                                                            {{ __('Admin/site.delete') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- $ -->

                        </div>
                    @elseif (Auth::guard('web')->user())
                        <div class="text-right">
                                    <!-- || (Auth::guard('vendor')->user()->email != $comment->email ) -->
                                    @if (Auth::guard('web')->user()->email != $comment->email)
                                        <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" onclick="
                                document.getElementById('replay_'+ <?php echo $comment->id; ?>).style.display='block';
                            ">{{ __('website\comments.replay') }}</a>
                                    @endif
                                    <form action="/comments/{{ $comment->id }}" method="POST" class="mb-0 mt-3">
                                        @csrf
                                        @method('DELETE')
                                        <div class="text-right">
                                            <!-- || (Auth::guard('vendor')->user()->email == $comment->email ) -->
                                            @if (Auth::guard('web')->user()->email == $comment->email)
                                                <button type="submit"
                                                    class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1"
                                                    style="margin-top: -90px;margin-right: 98px;">{{ __('website\comments.delete') }}</button>
                                            @endif
                                        </div>
                                    </form>

                                    <!-- $ -->
                                    <!-- <button type="button" class="btn btn-btn btn-danger btn-sm " style="margin-top: -132px;margin-right: 162px;" data-toggle="modal" data-target="#delete{{ $comment->id }}">
                                {{ __('Admin/site.delete') }}
                            </button> -->

                                    <form action="/comments/{{ $comment->id }}" class="my-1 my-xl-0" method="post"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('delete')

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <!-- Modal -->
                                                <div class="modal animated flipInY text-left" id="delete{{ $comment->id }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel62">
                                                                    {{ __('Admin/site.delete') }}</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <input type="hidden" value="{{ $comment->id }}">
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5>{{ __('Admin/site.warning') }}</h5>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn grey btn-outline-secondary"
                                                                    data-dismiss="modal">
                                                                    {{ __('Admin/site.close') }}</button>
                                                                <button type="submit" class="btn btn-outline-primary">
                                                                    {{ __('Admin/site.delete') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- $ -->

                        </div>
                    @elseif (Auth::guard('admin')->user())
                        <div class="text-right">
                                    <!-- || (Auth::guard('vendor')->user()->email != $comment->email ) -->
                                    @if (Auth::guard('admin')->user()->email != $comment->email)
                                        <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" onclick="
                                document.getElementById('replay_'+ <?php echo $comment->id; ?>).style.display='block';
                            ">{{ __('website\comments.replay') }}</a>
                                    @endif
                                    <form action="/comments/{{ $comment->id }}" method="POST" class="mb-0 mt-3">
                                        @csrf
                                        @method('DELETE')
                                        <div class="text-right">
                                            <!-- || (Auth::guard('vendor')->user()->email == $comment->email ) -->
                                            @if (Auth::guard('admin')->user()->email)
                                                <button type="submit"
                                                    class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1"
                                                    style="margin-top: -90px;margin-right: 175px;">{{ __('website\comments.delete') }}</button>
                                            @endif
                                        </div>
                                    </form>

                                    <!-- $ -->
                                    <!-- <button type="button" class="btn btn-btn btn-danger btn-sm " style="margin-top: -132px;margin-right: 162px;" data-toggle="modal" data-target="#delete{{ $comment->id }}">
                                {{ __('Admin/site.delete') }}
                            </button> -->

                                    <form action="/comments/{{ $comment->id }}" class="my-1 my-xl-0" method="post"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('delete')

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <!-- Modal -->
                                                <div class="modal animated flipInY text-left" id="delete{{ $comment->id }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel62">
                                                                    {{ __('Admin/site.delete') }}</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <input type="hidden" value="{{ $comment->id }}">
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5>{{ __('Admin/site.warning') }}</h5>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn grey btn-outline-secondary"
                                                                    data-dismiss="modal">
                                                                    {{ __('Admin/site.close') }}</button>
                                                                <button type="submit" class="btn btn-outline-primary">
                                                                    {{ __('Admin/site.delete') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- $ -->

                        </div>
                    @endif
                </td>
            </tr>


            <!-- start replay form -->

            <tr>
                <td width="100%">
                    <center>
                        <div id="replay_{{ $comment->id }}" style="display:none">
                            <form class="auth-form" name="form-login" method="POST"
                                action="/{{$type}}/{{ $type_id }}/comments">
                                @csrf

                                <div class="row">
                                    <div class="col-9">
                                        <div class="input-wrp">
                                            <textarea name="comment" class="textfield" cols="30" rows="5"
                                                placeholder="{{ __('website\comments.write_comment') }}"
                                                required>{{ old('comment') }}</textarea>

                                        </div>
                                        @error('comment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <input type="hidden" name="from" value="replay">
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    </div>
                                    <div class="col-3">
                                        <div class="d-table mt-8">
                                            <div class="d-table-cell align-middle">
                                                <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                                    role="button">{{ __('website\comments.publish') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </center>
                </td>
            </tr>
            <!-- end replay form -->


            <!-- if there are replies for this comment ,show them -->
            @if (count($comment->childs))
                <?php
                $new = [
                    'childs' => $comment->childs,
                    'padding' => 50,
                    'type_id' => $type_id,
                ];
                ?>
                @include('livewire.front.mangeCommentReplay', $new)
            @endif
            <!-- end of replays for this comment -->
        @endforeach
    </table>
@endif
<!-- ............................................................ -->
<br>
<hr>
<center> {{ $comments}}</center>

<hr>
<!-- ............................................................ -->
