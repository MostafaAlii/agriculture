
                        <!-- msg_history -->
                            <div  class="msg_history" wire:poll>
                            Current time: {{ now() }}
                            @forelse ($messages as $message)
                                <!-- ------------------ login as farmer ----------------- -->
                                @if(Auth::guard('web')->user())
                                    @if (($message->email == Auth::guard('web')->user()->email))
                                      <?php $own=0;?>
                                        <!-- Reciever Message-->
                                        <div class="outgoing_msg" >
                                            <div class="sent_msg">
                                                <p>{{ $message->message_text }}</p>
                                                <span class="time_date">
                                                    {{ $message->created_at->diffForHumans(null, false, false) }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <?php $own=1;?>
                                    @endif
                                    
                                @elseif(Auth::guard('vendor')->user())

                                     @if (($message->email == Auth::guard('vendor')->user()->email))
                                        <?php $own=0;?>
                                        <!-- Reciever Message-->
                                        <div class="outgoing_msg">
                                            <div class="sent_msg">
                                                <p>{{ $message->message_text }}</p>
                                                <span class="time_date">
                                                    {{ $message->created_at->diffForHumans(null, false, false) }}</span>
                                            </div>
                                        </div>
                                    @else
                                      <?php $own=1;?>
                                    @endif
                                @endif

                                @if($own==1)
                                <div class="incoming_msg">
                                    <div class="incoming_msg_img"> <img
                                            src="https://ptetutorials.com/images/user-profile.png" style="width:60px;height:60px;" alt="sunil"> </div>
                                            {{ $message->name }}
                                      <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p>{{ $message->message_text }}</p>
                                            <span
                                                class="time_date">{{ $message->created_at->diffForHumans(null, false, false) }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                            @empty
                                <h5 style="text-align: center;color:red"> لاتوجد رسائل سابقة</h5>
                            @endforelse

                            </div>