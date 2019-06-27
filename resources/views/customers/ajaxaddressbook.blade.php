@if($addressbook)
    <tr>
        <td>{{$addressbook->email}}</td>
        <td><button class="btn btn-danger"><li class="fa fa-trash"></li></button></td>
    </tr>
@endif
