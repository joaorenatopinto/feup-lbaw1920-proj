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
    @if($report->getLastStatus() == null)
        <td class="align-middle text-danger">NO STATUS</td>
    @else
    <td class="align-middle">{{$report->getLastStatus()->datechanged}}</td>
    @endif
    <td class="align-middle">{{$report->description}}</td>
    <td class="align-middle"><a class="btn btn-primary" href="#" role="button">Commit Sudoku</a>
  </tr>