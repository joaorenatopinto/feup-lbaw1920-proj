<tr>
  <th scope="row" class="align-middle">{{$user->id}}</th>
  <td class="align-middle"><a href="{{route('profile',['id' => $user->id])}}">{{ $user->name }}</a></td>
  <td class="align-middle">{{ $user->username }}</td>
  <td class="align-middle">{{ $user->email }}</td>
  <td class="align-middle">{{ $user->nif }}</td>
  <td class="align-middle">{{ $user->balance }}</td>

  @if($user->getLastStatus() == null)
    <td class="align-middle text-danger">NO STATUS</td>
  @elseif($user->getLastStatus()->status == 'active')
    <td class="align-middle text-success">{{ $user->getLastStatus()->status }}</td>
    <td class="align-middle">
      <a href="#" class="btn btn-outline-info btn-sm mb-1 w-100">Promote</a>
      <form action="{{route('banUser', ['id' => $user->id])}}" method="post">
        {{ csrf_field() }}
        <button class="btn btn-outline-danger btn-sm w-100" name="ban" value="1">Ban</button>
      </form>
    </td>
  @elseif($user->getLastStatus()->status == 'moderator')
    <td class="align-middle text-info">{{ $user->getLastStatus()->status }}</td>
    <td class="align-middle">
      <a href="#" class="btn btn-outline-info btn-sm mb-1 w-100">Demote</a>
      <form action="{{ route('banUser', ['id' => $user->id]) }}" method="post">
        {{ csrf_field() }}
        <button class="btn btn-outline-danger btn-sm w-100" name="ban" value="1">Ban</button>
      </form>
    </td>
  @elseif($user->getLastStatus()->status == 'recoMod')
    <td class="align-middle text-success">{{ $user->getLastStatus()->status }}</td>
    <td class="align-middle">
      <a href="#" class="btn btn-outline-info btn-sm mb-1 w-100">Accept Promotion</a>
      <form action="{{ route('banUser', ['id' => $user->id]) }}" method="post">
        {{ csrf_field() }}
        <button class="btn btn-outline-danger btn-sm w-100" name="ban" value="1">Ban</button>
      </form>
    </td>
  @elseif($user->getLastStatus()->status == 'banned')
    <td class="align-middle text-danger">{{ $user->getLastStatus()->status }}</td>
    <td class="align-middle">
      <form action="{{ route('banUser', ['id' => $user->id]) }}" method="post">
        {{ csrf_field() }}
        <button class="btn btn-outline-danger btn-sm w-100" name="ban" value="0">Unban</button>
      </form>
    </td>
  @else 
    <td class="align-middle text-danger">INVALID STATUS</td>
  @endif
</tr>