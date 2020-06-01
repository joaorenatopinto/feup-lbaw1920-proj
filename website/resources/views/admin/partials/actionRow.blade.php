<tr>
    @if($action->auction_id != null) 
        <th scope="row" class="align-middle">
            <a href="{{route('auction', [$id = $action->auction->id])}}">{{ $action->auction->title }}</a>
        </th>
        <td class="align-middle">Auction</td>
    @elseif($action->user_id != null)
        <th scope="row" class="align-middle">
            <a href="{{route('auction', [$id = $action->user->id])}}">{{ $action->user->username }}</a>
        </th>
        <td class="align-middle">User</td>
    @endif

    <td class="align-middle">{{ $action->datechanged }}</td>

    @if($action->admin_id != null)
        <td class="align-middle">{{ $action->admin->username }}</td>
        <td class="align-middle">Administrator</td>
    @elseif($action->moderator_id != null)
        <td class="align-middle">
            <a href="{{route('profile',[$id => $action->moderator->id])}}">{{ $action->moderator->username }}
        </td>
        <td class="align-middle">Moderator</td>
    @endif

    @if($action->status == 'ongoing')
        <td class="align-middle text-success">{{ $action->status }}</td>
        <td class="align-middle">
            <a href="#" class="btn btn-outline-primary btn-sm w-100">Undo</a>
        </td>
    @elseif($action->status == 'active')
        <td class="align-middle text-success">{{ $action->status }}</td>
        <td class="align-middle">
            <a href="#" class="btn btn-outline-primary btn-sm w-100">Undo</a>
        </td>
    @elseif($action->status == 'banned')
        <td class="align-middle text-danger">{{ $action->status }}</td>
        <td class="align-middle">
            <a href="#" class="btn btn-outline-primary btn-sm w-100">Undo</a>
        </td>
    @elseif($action->status == 'removed')
        <td class="align-middle text-danger">{{ $action->status }}</td>
        <td class="align-middle">
            <a href="#" class="btn btn-outline-primary btn-sm w-100">Undo</a>
        </td>
    @elseif($action->status == 'closed')
        <td class="align-middle text-danger">{{ $action->status }}</td>
        <td class="align-middle">
            <a href="#" class="btn btn-outline-primary btn-sm w-100">Undo</a>
        </td>
    @elseif($action->status == 'recoMod')
        <td class="align-middle text-info">{{ $action->status }}</td>
        <td class="align-middle">
            <a href="#" class="btn btn-outline-info btn-sm w-100">Promote</a>
        </td>
    @elseif($action->status == 'moderator')
        <td class="align-middle text-info">{{ $action->status }}</td>
        <td class="align-middle">
            <a href="#" class="btn btn-outline-info btn-sm w-100">Demote</a>
        </td>
    @else
        <td class="align-middle">{{ $action->status }}</td>
        <td class="align-middle">-</td>
    @endif
</tr>