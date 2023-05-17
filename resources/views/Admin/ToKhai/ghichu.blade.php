<ul class="list-group">
    @foreach($MucDos as $dll)
        <li class="">
            {{$dll->tenMucDo}}
            <span class="badge bg-danger badge-lg" style="font-size: 100%!important">{{$dll->moTa}}</span>
        </li>
    @endforeach
</ul>
