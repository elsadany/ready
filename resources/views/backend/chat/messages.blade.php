<div class="content-right">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body"><div class="content-overlay"></div>
<section class="chat-app-window" id="messages-area" style="height: 431px;" ref="messages">
<div class="sidebar-toggle d-block d-lg-none"><i class="ft-menu font-large-1"></i></div>
<div class="badge badge-secondary mb-1">Chat History</div>
<div class="chats">
    <div class="chats">
      <div v-for="(message,i) in messages" :key="i" :class="['chat',{'chat-left':message.from_admin}]">
        <div class="chat-avatar">
          <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
              <img src="./assets/backend/images/portrait/small/avatar-s-1.png" alt="avatar">
          </a>
        </div>
        <div class="chat-body">
          <div class="chat-content">
            <p>@{{message.message}}</p>
          </div>
        </div>
      </div>
      {{-- <p class="time">1 hours ago</p> --}}
      
    </div>
</div>
</section>
<section class="chat-app-form">
<form class="chat-app-input d-flex" onsubmit="enter_chat();" action="javascript:void(0);">
<fieldset class="form-group position-relative has-icon-left col-10 m-0">
  <div class="form-control-position">
    <i class="icon-emoticon-smile"></i>
  </div>
  <input type="text" class="form-control message" id="iconLeft4-1" placeholder="أكتب رسالتك" v-model="new_message" @keyup.enter="newMessage()"  >
  <div class="form-control-position control-position-right">
    <i class="ft-image"></i>
  </div>
</fieldset>
<fieldset class="form-group position-relative has-icon-left col-2 m-0">
  <button type="button" class="btn btn-primary send" @click="newMessage()" ><i class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">Send</span></button>
</fieldset>
</form>
</section>
      </div>
    </div>
  </div>