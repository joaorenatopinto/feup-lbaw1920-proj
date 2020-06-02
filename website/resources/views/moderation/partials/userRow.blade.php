<tr>
    <th class="align-middle">{{ $user->username }}</th>
    <td class="align-middle"><a href="{{route('profile',['id' => $user->id])}}">{{ $user->name }}</a></td>
    <td class="align-middle">{{ $user->email }}</td>
  
    @if($user->getLastStatus() == null)
      <td class="align-middle text-danger">NO STATUS</td>
      <td class=align-middle>-</td>
    @elseif($user->getLastStatus()->status == 'active')
      <td class="align-middle text-success">Active</td>
      <td class="align-middle">
        <form action="{{route('recommend', ['id' => $user->id])}}" method="post">
            {{ csrf_field() }}
            <button class="btn btn-outline-info btn-sm w-100 mb-1" name="recommend" value="1">Recomend Moderator</button>
        </form>
        <form action="{{route('banUser', ['id' => $user->id])}}" method="post">
            {{ csrf_field() }}
            <button class="btn btn-outline-danger btn-sm w-100" name="ban" value="1">Ban</button>
        </form>
      </td>
    @elseif($user->getLastStatus()->status == 'moderator')
      <td class="align-middle text-info">Moderator</td>
      <td class=align-middle>-</td>
    @elseif($user->getLastStatus()->status == 'recoMod')
      <td class="align-middle text-info">Recomended Moderator</td>
      <td class="align-middle">
        @if($user->getLastStatus()->moderator_id == Auth::id())
        <form action="{{route('recommend', ['id' => $user->id])}}" method="post">
            {{ csrf_field() }}
            <button class="btn btn-outline-info btn-sm w-100 mb-1" name="recommend" value="0">Cancel Recomendation</button>
        </form>
        @endif
        <form action="{{ route('banUser', ['id' => $user->id]) }}" method="post">
            {{ csrf_field() }}
            <button class="btn btn-outline-danger btn-sm w-100" name="ban" value="1">Ban</button>
        </form>
      </td>
    @elseif($user->getLastStatus()->status == 'banned')
      <td class="align-middle text-danger">Banned</td>
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