<tr>
  <th scope="row" class="align-middle">{{$transaction->id}}</th>
  <td class="align-middle">{{ $transaction->date }}</td>
    @if($transaction->receiver_id == Auth::user()->id)
        <td class="align-middle text-success">+ {{ $transaction->value }}</td>
    @else
        <td class="align-middle text-danger">- {{ $transaction->value }}</td>
    @endif
  <td class="align-middle">{{ $transaction->description }}</td>
</tr>
