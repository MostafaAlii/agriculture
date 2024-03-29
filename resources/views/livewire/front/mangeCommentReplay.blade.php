@foreach ($childs as $child)
    <?php
    $new = [
        'childs' => $child->childs,
        'padding' => $padding + 20,
        'type_id' => $type_id,
    ];
    ?>
    <tr>
        <td><br></td>
    </tr>
    <tr>

        <td width="100%" style="padding-left:<?php echo $padding; ?>px">
        <?php
                if(App\Models\User::where('email',$child->email)->first()){
                   $src=asset('Dashboard/img/users/' . $child->image);
                }elseif(App\Models\Farmer::where('email',$child->email)->first()){
                    $src=asset('Dashboard/img/farmers/' . $child->image);
                }elseif(App\Models\Admin::where('email',$child->email)->first()){
                     $src=asset('Dashboard/img/admins/' . $child->image);
                }
                echo'<img class="user-img img-fluid rounded-circle" style="width:50px; height:50px;border-radius: 15%;" src="'.$src.'" />';
                ?>
                
            <br>
            <time class="comment__date-post">{{ $child->created_at->format('Y-m-d') }}</time>
            <br>
            <span class="comment__author-name">{{ $child->name }}</span>
            <span class="comment__author-name">{{ $child->email }}</span>
            <p>{{ $child->comment }}</p>

            @if (Auth::guard('vendor')->user())
                <div class="text-right">
                    <!-- ||(Auth::guard('vendor')->user()->email != $child->email )  -->
                    @if (Auth::guard('vendor')->user()->email != $child->email)
                        <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" onclick="
                        document.getElementById('replay_'+ <?php echo $child->id; ?>).style.display='block';
                        ">{{ __('website\comments.replay') }}</a>
                    @endif

                    <form action="/comments/{{ $child->id }}" method="POST" class="mb-0 mt-3">
                        @csrf
                        @method('DELETE')
                        <div class="text-right">
                            <!-- || (Auth::guard('vendor')->user()->email == $child->email ) -->
                            @if (Auth::guard('vendor')->user()->email == $child->email)
                                <button type="submit"
                                    class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1"
                                    style="margin-top: -90px;margin-right: 98px;">{{ __('website\comments.delete') }}</button>
                            @endif
                        </div>
                    </form>

                </div>
            @elseif (Auth::guard('web')->user())
                <div class="text-right">
                    <!-- ||(Auth::guard('vendor')->user()->email != $child->email )  -->
                    @if (Auth::guard('web')->user()->email != $child->email)
                        <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" onclick="
                        document.getElementById('replay_'+ <?php echo $child->id; ?>).style.display='block';
                        ">{{ __('website\comments.replay') }}</a>
                    @endif

                    <form action="/comments/{{ $child->id }}" method="POST" class="mb-0 mt-3">
                        @csrf
                        @method('DELETE')
                        <div class="text-right">
                            <!-- || (Auth::guard('vendor')->user()->email == $child->email ) -->
                            @if (Auth::guard('web')->user()->email == $child->email)
                                <button type="submit"
                                    class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1"
                                    style="margin-top: -90px;margin-right: 98px;">{{ __('website\comments.delete') }}</button>
                            @endif
                        </div>
                    </form>

                </div>
            @elseif (Auth::guard('admin')->user())
                <div class="text-right">
                    <!-- ||(Auth::guard('vendor')->user()->email != $child->email )  -->
                    @if (Auth::guard('admin')->user()->email != $child->email)
                        <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" onclick="
                        document.getElementById('replay_'+ <?php echo $child->id; ?>).style.display='block';
                        ">{{ __('website\comments.replay') }}</a>
                    @endif

                    <form action="/comments/{{ $child->id }}" method="POST" class="mb-0 mt-3">
                        @csrf
                        @method('DELETE')
                        <div class="text-right">
                            <!-- || (Auth::guard('vendor')->user()->email == $child->email ) -->
                            @if (Auth::guard('admin')->user()->email)
                                <button type="submit"
                                    class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1"
                                    style="margin-top: -90px;margin-right: 175px;">{{ __('website\comments.delete') }}</button>
                            @endif
                        </div>
                    </form>

                </div>
            @endif
        </td>
    </tr>

    <!-- start replay form -->
    <tr>
        <td width="100%">
            <center>
                <div id="replay_{{ $child->id }}" style="display:none">
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
                                <input type="hidden" name="comment_id" value="{{ $child->id }}">
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

    @if (count($child->childs))
        @include('livewire.front.mangeCommentReplay', $new)
    @endif
@endforeach
