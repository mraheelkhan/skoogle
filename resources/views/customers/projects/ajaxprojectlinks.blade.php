@if($projectlink)
    <tr>
        <td>{{$projectlink->title}}</td>
        <td><a href="{{$projectlink->linkurl}}" target="_blank">{{$projectlink->linkurl}}</a></td>
        <td><button class="btn btn-danger"><li class="fa fa-trash"></li></button></td>
    </tr>
@endif
