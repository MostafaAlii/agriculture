@section('css')
<style>
    .container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%;
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 100%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 10%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 6px;
  width: 100px;
  display:false;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  width: 100%;
  overflow-y: auto;
}
</style>
@endsection

<div id="main_dev" >
    <div class="container">
        <h3 class=" text-center">
        
           
        </h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="mesgs">
                    <div class="row">
                        <div class="col-12 col-md-8 " id="chat">
                            <div  class="msg_history" wire:poll>
                              Current time: {{ now() }}
                            

                            </div>
                        </div>
                        <div class="col-12 col-md-4 ">
                            @if(Auth::guard('vendor')->user())
                            <div>
                                <label>{{$title}}</label>
                                <select class="custom-select select2 form-control" onchange="javascript:start_converstion(this.value,'<?php echo $type;?>')">
                                    <option value="0" selected disabled>اختر الفلاح وابدا المحادثه</option>
                                @forelse ($all as $aa)
                                   <option value="{{$aa->id}}">{{$aa->firstname}}</option>
                                @empty
                                <option> <span style="text-align: center;color:red"> لا يوجد اشخاص لاجراء محادثه معاهم</span></option>
                                @endforelse
                                </select>
                            </div>
                            <hr>
                            @endif
                            <div>
                                @forelse ($live_chat as $ll)
                                <div onclick="javascript:start_converstion({{$ll->id}},'<?php echo $type;?>')">
                                  <img src="https://ptetutorials.com/images/user-profile.png" style="width:80px;height:60px;" alt="sunil">
                                     <span> {{$ll->firstname}}</span>
                                </div>
                                <br>
                                @empty
                                <option> <span style="text-align: center;color:red"> لا يوجد محادثات سابقه</span></option>
                                @endforelse
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                        
                                    
                            <form wire:submit.prevent="sendMessage">
                            @csrf
                            <!-- when change on its value or if i click only it .... call to render fun !!! -->
                                <input type="number" id="guard_id" wire:model="guard_id" />

                                <!-- onkeydown='scrollDown()'  -->
                                <input wire:model.defer="messageText" type="text"
                                    class="write_msg" placeholder="اكتب رسالتك" required />
                                    
                                <button class="msg_send_btn" type="submit" id="disabled">ارسال</button>
                                
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<script>
// $(document).ready(function () {
//         alert('rrrr');
    
//         //////////////////////////////////////////////////////////////////////////
//         var value=1;
//         var type='User';
//         alert(value+' , '+type);
//         var xhhttp;
//         xhhttp= createRequest();
//         xhhttp.onreadystatechange =  function chatAction(){
//             if (this.readyState == 4 && this.status == 200) {				
//                 document.getElementById("chat").innerHTML = this.responseText;		
//             }
//         };
//         alert("../single_chat/"+value+"/"+type );
//         xhhttp.open("GET","../single_chat/"+value+"/"+type , true); 
//         xhhttp.send();
        
//     });
</script>