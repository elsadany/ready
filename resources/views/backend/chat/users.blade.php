<div class="sidebar-left sidebar-fixed ps ps--active-y">
    <div class="sidebar">
        <div class="sidebar-content card">
            <div class="card-body chat-fixed-search">
                <fieldset class="form-group position-relative has-icon-left m-0">
                    <input type="text" class="form-control" id="iconLeft4" placeholder="Search user">
                    <div class="form-control-position">
                        <i class="ft-search"></i>
                    </div>
                </fieldset>     
            </div>
            <div id="users-list" class="list-group position-relative">
                <div class="users-list-padding media-list">
                    <a v-for="(user,i) in users" :key="i"  @click="loadUserMessage(user)" class="media border-0">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="./assets/backend/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image">
                            <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <h6 class="list-group-item-heading">@{{user.user.full_name}} <span class="font-small-3 float-right primary">@{{formateDate(user.created_at)}}</span></h6>
                            <p class="list-group-item-text text-muted mb-0"><i v-if="user.is_read" class="ft-check primary font-small-2"></i> @{{user.message}} <span class="float-right primary"><i class="font-medium-1 icon-pin blue-grey lighten-3"></i></span></p>
                        </div>
                    </a>
                    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
      <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; height: 541px; right: 300px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 316px;">
        </div>
    </div>
</div>