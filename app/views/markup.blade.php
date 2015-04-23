<br/>
<br/>
<ul class="dropdown-menu" style="display: inline;">
    @foreach ($users as $u)
        <li><a href="{{route('show_user',$u->id)}}"><img
                        src="{{asset('uploads/'.$u->file)}}" width=30>{{$u->name}}</a></li>
    @endforeach
    <li class="divider"></li>
    @foreach ($groups as $g)
        <li><a href="{{route('group',$g->id)}}">{{$g->name}}</a></li>
    @endforeach
</ul>
<li id="search_result">

</li>