<tr>
    <th scope="row" class="align-middle">{{$report->id}}</th>
    <td class="align-middle"><a href="{{route('auction',['id' => $report->auction->id])}}">{{ $report->auction->title }}</a></td>
    <td class="align-middle"><a href="{{route('profile',['id' => $report->auction->user->id])}}">{{ $report->auction->user->username }}</a></td>
    
    @if($report->auction->getLastStatus() == null)
        <td class="align-middle text-danger">NO STATUS</td>
    @elseif($report->auction->getLastStatus()->status == 'ongoing')
        <td class="align-middle text-success">{{ $report->auction->getLastStatus()->status }}</td>
    @elseif($report->auction->getLastStatus()->status == 'removed')
        <td class="align-middle text-danger">{{ $report->auction->getLastStatus()->status }}</td>
    @elseif($report->auction->getLastStatus()->status == 'closed')
        <td class="align-middle text-danger">{{ $report->auction->getLastStatus()->status }}</td>
    @else 
        <td class="align-middle text-danger">INVALID STATUS</td>
    @endif
    </td>

    <td class="align-middle">
        <a href="{{route('profile',['id' => $report->user->id])}}">{{$report->user->username}}</a>
    </td>

    @if($report->getLastStatus() == null)
        <td class="align-middle text-danger">NO STATUS</td>
    @else
        <td class="align-middle">{{$report->getLastStatus()->datechanged}}</td>
    @endif

    @if($report->getLastStatus() == null)
        <td class="align-middle">-</td>
    @elseif($report->getLastStatus()->type == 'notSeen')
        <td class="align-middle text-info">Not Seen</td>
    @elseif($report->getLastStatus()->type == 'seen')
        <td class="align-middle text-success">Seen</td>
    @elseif($report->getLastStatus()->type == 'closed')
    <td class="align-middle text-danger">Closed</td>
    @endif


    @if($report->getLastStatus() != null && $report->getLastStatus()->moderator != null) 
        <td class="align-middle">
        <a href="{{route('profile',['id' => $report->getLastStatus()->moderator->id])}}">{{$report->getLastStatus()->moderator->username}}</td>
    @elseif($report->getLastStatus() != null && $report->getLastStatus()->admin != null) 
        <td class="align-middle">{{$report->getLastStatus()->admin->username}}</td>
    @else 
        <td class="align-middle">-</td>
    @endif

    <td class="align-middle">
    <a class="btn btn-outline-info btn-sm w-100 mb-1" href="{{route('reportPage',['id' => $report->id])}}" role="button">View Report</a>
    </td>
  </tr>