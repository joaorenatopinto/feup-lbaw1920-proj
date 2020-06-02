<tr>
    <th scope="row" class="align-middle">{{$report->id}}</th>
    <td class="align-middle"><a href="{{route('auction',['id' => $report->auction->id])}}">{{ $report->auction->title }}</a></td>
    <td class="align-middle"><a href="{{route('profile',['id' => $report->auction->user->id])}}">{{ $report->auction->user->username }}</a></td>
    <td class="align-middle">{{$report->description}}</td>
    @if($report->auction->getLastStatus() == null)
        <td class="align-middle text-danger">NO STATUS</td>
    @elseif($report->auction->getLastStatus()->status == 'ongoing')
        <td class="align-middle text-success">{{ $report->auction->getLastStatus()->status }}</td>
        <td class="align-middle ">
            <form action="{{ route('cancelAuction', ['id' => $report->auction->id]) }}" method="post">
            {{ csrf_field() }}
            <button class="btn btn-outline-danger btn-sm w-100" name="cancel" value="1">Remove</button>
            </form>
        </td>
    @elseif($report->auction->getLastStatus()->status == 'removed')
        <td class="align-middle text-danger">{{ $report->auction->getLastStatus()->status }}</td>
        {{-- Can only undo the remove if you are the mod who canceled the auction --}}
        @if($report->auction->getLastStatus()->moderator_id == Auth::id())
            <td class="align-middle ">
                <form action="{{ route('cancelAuction', ['id' => $report->auction->id]) }}" method="post">
                {{ csrf_field() }}
                <button class="btn btn-outline-danger btn-sm w-100" name="cancel" value="0">Undo</button>
                </form>
            </td>
        @else 
            <td class="align-middle">-</td>
        @endif
    @elseif($report->auction->getLastStatus()->status == 'closed')
        <td class="align-middle text-danger">{{ $report->auction->getLastStatus()->status }}</td>
        <td class="align-middle"> - </td>
    @else 
        <td class="align-middle text-danger">INVALID STATUS</td>
        <td class="align-middle"> - </td>
    @endif
    </td>
    @if($report->getLastStatus() == null)
        <td class="align-middle text-danger">NO STATUS</td>
    @else
    <td class="align-middle">{{$report->getLastStatus()->status}}</td>
    @endif
  </tr>