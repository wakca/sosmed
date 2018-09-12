<div class='panel panel-default profile-card margin-bottom'>
    <div class='panel-heading'>
        <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" width='70' src="/photos/{{ isset($profile->photo) ? $profile->photo : 'av-default.jpg' }}" alt="{{ $profile->name }}">
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading"  title='{{ $profile->name }} &#64;{{ $profile->username }}'><a href='/{{ $profile->username }}'>{{ $profile->name }}</a></h4>
              &#64;{{ $profile->username }} {!! Getter::getVerified($profile->verified) !!}
            </div>
        </div>
    </div>
    <div class='panel-body'>
        <ul class='nav nav-justified'>
          <li><a href='/{{ $profile->username }}/posts'><span class='smallest-text'>POSTS</span><span class='card-num center-text'>{{ Getter::getNumPosts($profile->id) }}</span></a></li>
          <li><a href='/{{ $profile->username }}/followers'><span class='smallest-text'>FOLLOWERS</span><span class='card-num center-text'>{{ Getter::getNumFollowers($profile->id) }}</span></a></li>
          <li><a href='/{{ $profile->username }}/following'><span class='smallest-text'>FOLLOWING</span><span class='card-num center-text'>{{ Getter::getNumFollowing($profile->id) }}</span></a></li>
        </ul>
    </div>
</div>