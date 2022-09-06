

<div id="navBar" class="container" style="height:40px;margin-bottom:40px;">
    <div style="display:grid;grid-template-columns: 100%;height:60px;">
        <div style="display:grid;grid-template-columns: auto;">
            <ul class="navItems" style="display:grid;grid-template-columns:auto auto auto auto auto auto auto auto auto;height:60px;">
                <li class="nav-item{{request()->is('*/') ? ' active' : ''}}"><a class="nav-link dv" href="{{URL::to('/')}}/">ފުރަތަމަ ސަފުޚާ</a></li>
                <li class="nav-item{{Route::current()->uri == ('rules') ? ' active' : ''}}"><a class="nav-link dv" href="{{URL::to('/')}}/rules">ގަވާއިދުތައް</a></li>
                <li class="nav-item{{Route::current()->uri == ('idioms') ? ' active' : ''}}"><a class="nav-link dv" href="{{URL::to('/')}}/idioms">އަދަބީ ބަސް</a></li>
                <li class="nav-item{{Route::current()->uri == ('linguists') ? ' active' : ''}}"><a class="nav-link dv" href="{{URL::to('/')}}/linguists">އަދީބުން</a></li>
                <li class="nav-item{{Route::current()->uri == ('dhivehiNames') ? ' active' : ''}}"><a class="nav-link dv" href="{{URL::to('/')}}/dhivehiNames">ދިވެހި ނަން</a></li>
                <li class="nav-item{{Route::current()->uri == ('dhivehiDates') ? ' active' : ''}}"><a class="nav-link dv" href="{{URL::to('/')}}/dhivehiDates">ދިވެހި ތާރީޙު</a></li>
                <li class="nav-item{{Route::current()->uri == ('discussion') ? ' active' : ''}}"><a class="nav-link dv" href="{{URL::to('/')}}/discussion">މަޝްވަރާ ޖަގަހަ</a></li>
                @if(auth()->check() && auth()->user()->user_type == 'admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dv" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        އެޑްމިން
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item dv" href="{{URL::to('/')}}/admin/rules">ގަވާއިދުތައް</a>
                        <a class="dropdown-item dv" href="{{URL::to('/')}}/admin/idioms">އަދަބީ ބަސް</a>
                        <a class="dropdown-item dv" href="{{URL::to('/')}}/admin/dhivehiNames">ދިވެހި ނަން</a>
                        <a class="dropdown-item dv" href="{{URL::to('/')}}/admin/dhivehiDates">ދިވެހި ތާރީޙު</a>
                        <a class="dropdown-item dv" href="{{URL::to('/')}}/admin/users">ޔޫސާ</a>
                    </div>
                </li>
                @endif
                @if(!auth()->check())
                <li class="nav-item{{Route::current()->uri == ('login') ? ' active' : ''}}"><a class="nav-link dv" href="{{URL::to('/')}}/login">ލޮގިން</a></li>
                @else
                <li class="nav-item{{Route::current()->uri == ('login') ? ' active' : ''}}"><a class="nav-link dv" href="{{URL::to('/')}}/logout">ލޮގްއައުޓް</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>