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
    <td class="align-middle">{{ $user->getLastStatus()->status }}</td>
  @elseif($user->getLastStatus()->status == 'moderator')
    <td class="align-middle text-info">{{ $user->getLastStatus()->status }}</td>
  @elseif($user->getLastStatus()->status == 'recoMod')
    <td class="align-middle text-success">{{ $user->getLastStatus()->status }}</td>
  @elseif($user->getLastStatus()->status == 'banned')
    <td class="align-middle text-danger">{{ $user->getLastStatus()->status }}</td>
  @else 
    <td class="align-middle text-danger">INVALID STATUS</td>
  @endif
  <td class="d-flex justify-content-center">
    <a href="#" class="btn btn-outline-info btn-sm mr-1">Promote</a>
    <a href="#" class="btn btn-outline-danger btn-sm">Ban</a>
  </td>
</tr>