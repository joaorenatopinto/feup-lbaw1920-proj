<tr>
    <th scope="row" class="align-middle">{{$notification->id}}</th>
    <td class="align-middle">{{ $notification->title }}</td>
    <td class="align-middle">{{ $notification->date}}</td>
    <td class="align-middle">
    @if($notification->title == 'New Bid' or $notification->title == 'Outdated Bid' )
        New bid of value {{App\Bid::find($notification->bid_id)->value}}€ on <a href="{{route('auction',['id' => $notification->auction_id])}}">{{App\Auction::find($notification->auction_id)->title}}</a>
    </td>
    @elseif($notification->title == 'New Review')
        Your <a href="{{route('auction',['id' => $notification->auction_id])}}">{{App\Auction::find($notification->auction_id)->title}}</a> was reviewd!
    </td>
    @endif
</tr>
