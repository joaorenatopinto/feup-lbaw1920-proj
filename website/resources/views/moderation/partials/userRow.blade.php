<tr>
    <th class="align-middle">{{ $user->username }}</th>
    <td class="align-middle"><a href="{{route('profile',['id' => $user->id])}}">{{ $user->name }}</a></td>
    <td class="align-middle">{{ $user->email }}</td>
  
    @if($user->getLastStatus() == null)
      <td class="align-middle text-danger">NO STATUS</td>
    @elseif($user->getLastStatus()->status == 'active')
      <td class="align-middle text-success">{{ $user->getLastStatus()->status }}</td>
      <td class="align-middle">
        <form action="{{route('promote', ['id' => $user->id])}}" method="post">
          {{ csrf_field() }}
          <button class="btn btn-outline-info btn-sm w-100 mb-1" name="promote" value="1">Recomend Moderator</button>
        </form>
        <form action="{{route('banUser', ['id' => $user->id])}}" method="post">
          {{ csrf_field() }}
          <button class="btn btn-outline-danger btn-sm w-100" name="ban" value="1">Ban</button>
        </form>
      </td>
    @elseif($user->getLastStatus()->status == 'moderator')
      <td class="align-middle text-info">{{ $user->getLastStatus()->status }}</td>
      <td class=align-middle>-</td>
    @elseif($user->getLastStatus()->status == 'recoMod')
      <td class="align-middle text-info">{{ $user->getLastStatus()->status }}</td>
      <td class="align-middle">
        <form action="{{route('promote', ['id' => $user->id])}}" method="post">
          {{ csrf_field() }}
          <button class="btn btn-outline-info btn-sm w-100 mb-1" name="promote" value="1">Cancel Recomendation</button>
        </form>
        {{-- TODO verificar se este user foi recomendado por mim --}}
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