<tr>
  <th scope="row" class="align-middle">{{$auction->id}}</th>
  <td class="align-middle"><a href="{{route('auction',['id' => $auction->id])}}">{{ $auction->title }}</a></td>
  <td class="align-middle"><a href="{{route('profile',['id' => $auction->user->id])}}">{{ $auction->user->username }}</a></td>
  <td class="align-middle">{{ $auction->startdate }}</td>
  <td class="align-middle">{{ $auction->closedate }}</td>
  <td class="align-middle">{{ $auction->getHighestBid() }}</td>
  <td class="align-middle"><a href="{{route('category',['id' => $auction->category->id])}}">{{ $auction->category->name}}</a></td>

  @if($auction->getLastStatus() == null)
    <td class="align-middle text-danger">NO STATUS</td>
  @elseif($auction->getLastStatus()->status == 'ongoing')
    <td class="align-middle text-success">{{ $auction->getLastStatus()->status }}</td>
  @elseif($auction->getLastStatus()->status == 'removed' || $auction->getLastStatus()->status == 'closed')
    <td class="align-middle text-danger">{{ $auction->getLastStatus()->status }}</td>
  @else 
    <td class="align-middle text-danger">INVALID STATUS</td>
  @endif
  
  <td class="align-middle ">
    <a href="#" class="btn btn-outline-danger btn-sm w-100">Remove</a>
  </td>
</tr>