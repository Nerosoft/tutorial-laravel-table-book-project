<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{$lang->AdminDashboard}}</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('logout')}}">{{$lang->Logout}}</a>
      </li>
    </ul>
    <div class="dropdown">
      <a class="btn btn-danger dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{$lang->BranchesCompany}}
      </a>
      <ul class="dropdown-menu">        
      @foreach($lang->MyBranch as $index=>$branch)
      <form class="form_branch" method="POST" action="{{ route('branchMain') }}">
        @csrf
         @include('form_id')
        <li class="dropdown-item">
            <button type="submit" class="{{request()->session()->get('userId') === $index? 'btn btn-danger' : 'btn btn-primary'}}">{{$branch->getName()}}</button>
        </li>
      </form>
      @endforeach
      </ul>
  </div>
  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">{{$lang->Offcanvas}}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            @foreach ($lang->myMenuApp as $key=>$item)
              @if(is_array($item))
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle {{$key === request()->route('lang') || Route::currentRouteName() === $key ? 'my_active' : ''}}"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img class="style_icon_menu" src="{{asset('/lib/icons/'.$lang->getIconByKey($key))}}"/>
                  {{array_shift($item)}}
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark">
                  @foreach ($item as $keyItem=>$myItem)
                  <li>
                    <a class="dropdown-item {{$key === request()->route('lang') && $keyItem === request()->route('id') || $keyItem === request()->route('id') && Route::currentRouteName() !== 'SystemLang'?'my_active':''}}" href="{{Route::currentRouteName() === 'SystemLang'?route('SystemLang', ['id'=>$keyItem, 'lang'=>$key]):route($key, $keyItem)}}">
                      <img class="style_icon_menu" src="{{asset('/lib/icons/'.$lang->getIconByKey($keyItem))}}"/>
                      {{$myItem}}
                    </a>
                  </li>
                  @endforeach
                  </ul>
                </li>
              @else
                <li class="nav-item">
                  <a class="nav-link {{$key === Route::currentRouteName() && !request()->route('lang') && !request()->route('id')?'my_active':''}}" aria-current="page" href="{{route($key)}}">
                  <img class="style_icon_menu" src="{{asset('/lib/icons/'.$lang->getIconByKey($key))}}"/>
                  {{$item}}
                  </a>
                </li>
              @endif
            @endforeach  
        </ul>
      </div>
    </div>
  </div>
</nav>