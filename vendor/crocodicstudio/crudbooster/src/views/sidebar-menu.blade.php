@foreach($menus as $menu)
    <li data-id='{{$menu->id}}' class='{{(count($menu->children) > 0)?"treeview":""}} {{ (Request::is($menu->url_path."*"))?"active":""}}'>
        <a href='{{ ($menu->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$menu->url }}'
           class='{{($menu->color)?"text-".$menu->color:""}}'>
            <i class='{{$menu->icon}} {{($menu->color)?"text-".$menu->color:""}}'></i> <span>{{$menu->name}}</span>
            @if(count($menu->children) > 0)<i class="fa fa-angle-{{ trans("crudbooster.left") }} pull-{{ trans("crudbooster.right") }}"></i>@endif
        </a>

        @if(count($menu->children) > 0)
            <ul class="treeview-menu">
                @include('crudbooster::sidebar-menu', ['menus'=>$menu->children])
            </ul>
        @endif
    </li>
@endforeach
