@foreach($childs as $child)
        <?php
        $new=[
            'childs' => $child->childs,
            'padding'=>$padding +20,
            'blod_id'=>$blog->id,
        ];
        ?>
        <tr><td><br></td></tr>
        <tr>
             
            <td width="100%" style="padding-left:<?php echo $padding;?>px">
                <time class="comment__date-post">{{$child->created_at->format('Y-m-d')}}</time>
                <br>
                <span class="comment__author-name">{{ $child->author }}</span>
                <p>{{ $child->text }}</p>

                @if(isset(auth()->user()->id))
                <div class="text-right">
                    <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1"
                    onclick="
                    document.getElementById('replay_'+ <?php echo $child->id;?>).style.display='block';
                    "
                    >REPLY</a>

                    <form action="/comments/{{ $child->id }}" method="POST" class="mb-0 mt-3">
                        @csrf
                        @method('DELETE')
                        <div class="text-right">
                        <button type="submit" class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" style="margin-top: -90px;margin-right: 98px;">حذف</button>

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
                    <div id="replay_{{$child->id}}" style="display:none">
                        <form class="auth-form" name="form-login" method="POST" action="/blogs/{{ $blog_id }}/comments">
                            @csrf
                            <div class="input-wrp">
                                <input class="textfield"  name="author" value="{{ old('author')}}" required
                                    autofocus placeholder=" author name" />
                            </div>
                            @error('author')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="input-wrp">
                            <textarea name="text" class="textfield" cols="30" rows="5" placeholder="comments" required>{{ old('text')}}</textarea> 
                                
                            </div>
                            @error('text')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                                <input type="hidden" name="from" value="replay">
                                <input type="hidden" name="comment_id" value="{{$child->id}}">
                            <div class="d-table mt-8">
                                <div class="d-table-cell align-middle">
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                        role="button">نشر</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </center>
            </td>
        </tr>
        <!-- end replay form -->
        
        @if(count($child->childs))
            @include('livewire.front.mangeCommentReplay',$new)
        @endif

@endforeach