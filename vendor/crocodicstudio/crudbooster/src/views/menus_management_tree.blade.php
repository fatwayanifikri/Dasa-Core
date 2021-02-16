@if(count($menus) > 0)
@foreach($menus as $menu)
    @php
        $privileges = DB::table('cms_menus_privileges')
        ->join('cms_privileges','cms_privileges.id','=','cms_menus_privileges.id_cms_privileges')
        ->where('id_cms_menus',$menu->id)->pluck('cms_privileges.name')->toArray();
    @endphp
    <li data-id='{{$menu->id}}' data-name='{{$menu->name}}'>
        <div class='{{$menu->is_dashboard?"is-dashboard":""}}' title="{{$menu->is_dashboard?'This is setted as Dashboard':''}}">
            <i class='{{($menu->is_dashboard)?"icon-is-dashboard fa fa-dashboard":$menu->icon}}'></i> {{$menu->name}} <span
                    class='pull-right'><a class='fa fa-pencil' title='Edit'
                                          href='{{route("MenusControllerGetEdit",["id"=>$menu->id])}}?return_url={{urlencode(Request::fullUrl())}}'></a>&nbsp;&nbsp;<a
                        title='Delete' class='fa fa-trash'
                        onclick='{{CRUDBooster::deleteConfirm(route("MenusControllerGetDelete",["id"=>$menu->id]))}}'
                        href='javascript:void(0)'></a></span>
            <br/><em class="text-muted">
                <small><i class="fa fa-users"></i> &nbsp; {{implode(', ',$privileges)}}</small>
            </em>
        </div>
        <ul>
            @if(count($menu->children) > 0)
                @include('crudbooster::menus_management_tree',['menus'=>$menu->children])
            @endif
        </ul>
    </li>
@endforeach
@endif