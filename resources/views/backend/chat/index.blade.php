@extends('backend.layout.master')
@push('css')
<link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/fonts/simple-line-icons/style.min.css">
<link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/pages/app-chat.min.css">
@endpush
@section('content')

<div id="chat-app">
    @include('backend.chat.users')
    @include('backend.chat.messages')
</div>

@endsection
@push('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js"></script>
<script src="./assets/backend/js/scripts/ui/breadcrumbs-with-stats.min.js"></script>
{{--  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>  --}}

{{--  <script src="./assets/backend/js/scripts/pages/app-chat.min.js"></script>  --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    //Pusher.logToConsole = true;

    var pusher = new Pusher('3f2ae589f5175591edf7', {
      cluster: 'ap1'
    });
        var channel = pusher.subscribe('chat');
        channel.bind('new-message', function(data) {
            if(data.chat.user_id==chat_app.current_user.user_id){
                chat_app.aapendMessage(data.chat);
                //var container = $("#messages-area");
                //container.scrollTop = container.scrollHeight;
            }else{
                $.growl.notice({ message: data.chat.message });
            }
            var users=chat_app.users;
            for(var i in users){
                if(users[i].user_id==data.chat.user_id){
                    chat_app.users[i].message=data.chat.message;
                }
            }
            
            
        });
    
    var chat_app=new Vue({
        el: '#chat-app',
        data:{
            users:[],
            messages:[],
            current_user:null,
            new_message:''
        },
        created(){
            this.getUsers();
        },
        methods:{
            getUsers(){
                axios.get('./backend/chat/get-users').then(res=>{
                    this.users=res.data;
                    @if(request()->user_id)
                        for(var i in this.users)
                            if(this.users[i].user_id == {{request()->user_id}}){
                                this.current_user=this.users[i];
                                this.current_user.is_read=1;
                                this.loadUserMessage(this.current_user);
                            }
                    @endif
                });
            },
            loadUserMessage(user){
                this.current_user=user;
                axios.get('./api/backend/chat/get-user-messages',{ params: { user_id: user.user_id } }, {withCredentials: true}).then(res=>{
                    if(res.data.status){
                        this.messages=res.data.data;
                        this.current_user.is_read=1;
                        this.$nextTick(() =>{
                            var container = this.$el.querySelector("#messages-area");
                            container.scrollTop = container.scrollHeight;
                        });
                    }else
                        alert(res.dtat.message);
                });
               
            },
            newMessage(){
                axios.post('./api/backend/chat/send',{
                    message:this.new_message,
                    user_id:this.current_user.user_id
                }).then(res=>{
                    if(res.data.status){
                        this.messages.push(res.data.data);
                        this.current_user.message= this.new_message;
                        this.$nextTick(() =>{
                            var container = this.$el.querySelector("#messages-area");
                            container.scrollTop = container.scrollHeight;
                        });
                        
                    }else
                        alert(res.data.message);
                    this.new_message='';
                });
            },
            aapendMessage(message){
                this.messages.push(message);
                this.$nextTick(() =>{
                    var container = this.$el.querySelector("#messages-area");
                    container.scrollTop = container.scrollHeight;
                });
            },
            scrollToEnd () {
                this.$el.scrollTop = this.$el.lastElementChild.offsetTop;
                //this.$el.scrollTop = 0;
            },
            formateDate(date){
                    var t1 = new Date(date).getTime();
                    var t2 = new Date().getTime();
                    var a = new Date(t1 * 1000);
                    if(parseInt((t2-t1)/(24*3600*1000))>1){
                        return a.getFullYear+'-'+a.getMonth()+'-'+a.getDay();
                    }else{
                        return a.getHours()+':'+a.getMinutes();
                    }
                    //return parseInt((t2-t1)/(24*3600*1000));
            }
        }
    });
</script>

@endpush