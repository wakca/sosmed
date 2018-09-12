@foreach($groupchats as $groupchat)
    @if($groupchat->group->admin_id == Auth::Id())
        <div class="panel message panel-default">
            <div class="btn-group pull-right">
                <a href='javascript:void(0);' onclick='editConversation({{ $groupchat->group_id }})' title='Edit Pesan Grup' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a href='javascript:void(0);' onclick='deleteConversation({{ $groupchat->group_id }})' title='Hapus Pesan Grup' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
            </div>
            <div class="panel-body">
                <div class="media message-link" onclick="window.location='/messages/group/{{ $groupchat->group_id }}'">
                  <div class="avatar">
                    <a href="#">
                        <img class="media-object" width='100%' src="/photos/group_chat.png" alt="{{ $groupchat->group->name }}">
                    </a>
                  </div>
                  <div class="content">
                    <h4 class="media-heading"><a href='/messages/group/{{ $groupchat->group_id }}'>{{ $groupchat->group->name }}</a> <span class='small-text'> &bull; <span class='ajax-time time-post-' data-time-post-id = '' data-time=''>{{ Date::parse($groupchat->created_at)->ago() }}</span></span></h4>
                    @if(Getter::getReadStatus($groupchat->group_id,Auth::Id()) == 'N')
                        <span class='post-content'><strong>{{ strlen(Getter::getLastMessage($groupchat->group_id)) > 50?str_limit(Getter::getLastMessage($groupchat->group_id),50)."...":Getter::getLastMessage($groupchat->group_id) }}</strong></span>
                    @else
                        <span class='post-content'>{{ strlen(Getter::getLastMessage($groupchat->group_id)) > 50?str_limit(Getter::getLastMessage($groupchat->group_id),50)."...":Getter::getLastMessage($groupchat->group_id) }}</span>
                    @endif
                  </div>
                </div>
            </div>
        </div>
    @else
        <div class="panel message panel-default">
            <div class="btn-group pull-right">
                <a href='javascript:void(0);' onclick='leaveConversation({{ $groupchat->group_id }})' title='Tinggalkan Obrolan Grup' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-remove"></span>
                </a>
            </div>
            <div class="panel-body">
                <div class="media message-link" onclick="window.location='/messages/group/{{ $groupchat->group_id }}'">
                  <div class="avatar">
                    <a href="#">
                        <img class="media-object" width='100%' src="/photos/group_chat.png" alt="{{ $groupchat->group->name }}">
                    </a>
                  </div>
                  <div class="content">
                    <h4 class="media-heading"><a href='/messages/group/{{ $groupchat->group_id }}'>{{ $groupchat->group->name }}</a> <span class='small-text'> &bull; <span class='ajax-time time-post-' data-time-post-id = '' data-time=''>{{ Date::parse($groupchat->created_at)->ago() }}</span></span></h4>
                    @if(Getter::getReadStatus($groupchat->group_id,Auth::Id()) == 'N')
                        <span class='post-content'><strong>{{ strlen(Getter::getLastMessage($groupchat->group_id)) > 50?str_limit(Getter::getLastMessage($groupchat->group_id),50)."...":Getter::getLastMessage($groupchat->group_id) }}</strong></span>
                    @else
                        <span class='post-content'>{{ strlen(Getter::getLastMessage($groupchat->group_id)) > 50?str_limit(Getter::getLastMessage($groupchat->group_id),50)."...":Getter::getLastMessage($groupchat->group_id) }}</span>
                    @endif                  </div>
                </div>
            </div>
        </div>
    @endif
@endforeach