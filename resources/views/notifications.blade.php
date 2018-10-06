
<li class="dropdown" id='notifications'>
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="ti-bell"></i>
             <p style="display:none"class="notification">{{count($user->unreadNotifications)}}</p>
             <p>Notifications</p>
             <b class="caret"></b>
      </a>

       <ul class="dropdown-menu" id='notificationmenu'>
           <li class="dropdown-header">Mes notifications</li>
         @if(count($user->unreadNotifications)!=0)
         @foreach($user->unreadNotifications as $notification)
           <li ><a href="#" class="notificationlink">{{$notification->data['message']}}</a></li>
         @endforeach
         @else
           <li><a href="#">Aucune notification pour l'instant</a></li>
         @endif
      </ul>

</li>
