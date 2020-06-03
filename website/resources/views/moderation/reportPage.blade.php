@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-header container">
            <div class="row align-items-center">
                <h3 class=col-sm-10>Report # {{$report->id}}</h3>
                <a class="btn btn-primary col-sm-2 w-100" href="{{route('modReports')}}">Back</a>
            </div>
        </div>
        <div class="card-body">
            <section>
                <h5>Report Information</h5>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Description:</strong>
                    <strong>{{$report->description}}</strong>
                </p>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Status:</strong>
                    @if($report->getLastStatus()->type == 'seen')
                        <strong class="text-success">Seen</strong>
                    @elseif($report->getLastStatus()->type == 'notSeen')
                        <strong class="text-danger">Unseen</strong>
                    @elseif($report->getLastStatus()->type == 'closed')
                        <strong class="text-danger">Closed</strong>
                    @else
                        <strong class="text-danger">INVALID STATUS</strong>
                    @endif
                </p>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Status Changer:</strong>
                    @if($report->getLastStatus() != null && $report->getLastStatus()->admin_id != null)
                        <strong>{{$report->getLastStatus()->admin->username}} (Administrator)</strong>
                    @elseif($report->getLastStatus() != null && $report->getLastStatus()->moderator_id != null)
                        <strong>
                        <a href="{{route('profile',['id' => $report->getLastStatus()->moderator_id])}}">{{$report->getLastStatus()->moderator->username}}</a> 
                            (Moderator)
                        </strong>
                    @else
                        <strong class="text-danger">INVALID STATUS</strong>
                    @endif
                </p>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Date Changed:</strong>
                    <strong>{{$report->getLastStatus()->datechanged}}</strong>
                </p>
            </section>
            
            <hr>

            <section>
                <h5>Auction Information</h5>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Title:</strong>
                    <a href="{{route('auction',['id' => $report->auction_id])}}">{{$report->auction->title}}</a>
                </p>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Owner:</strong>
                    <a href="{{route('profile',['id' => $report->auction->user_id])}}">{{$report->auction->user->username}}</a>
                </p>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Owner Status:</strong>
                    @if($report->auction->user->getLastStatus()->status == 'active')
                        <strong class="text-success">{{$report->auction->user->getLastStatus()->status}}</strong>
                    @elseif($report->auction->user->getLastStatus()->status == 'banned')
                        <strong class="text-danger">{{$report->auction->user->getLastStatus()->status}}</strong>
                    @elseif($report->auction->user->getLastStatus()->status == 'moderator' || $report->auction->user->getLastStatus()->status == 'recoMod')
                        <strong class="text-info">{{$report->auction->user->getLastStatus()->status}}</strong>
                    @endif
                </p>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Closing Date:</strong>
                    <strong>{{$report->auction->closedate}}</strong>
                </p>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Category:</strong>
                    <a href="{{route('category',['id' => $report->auction->category_id])}}">{{$report->auction->category->name}}</a>
                </p>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Highest Bid:</strong>
                    <strong>{{$report->auction->getHighestBid()}}</strong>
                </p>
            </section>

            <hr>

            <section>
                <h5>Auction Status Information</h5>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Auction Status:</strong>
                    @if($report->auction->getLastStatus()->status == 'ongoing')
                        <strong class="text-success">Ongoing</strong>
                    @elseif($report->auction->getLastStatus()->status == 'closed')
                        <strong class="text-danger">Closed</strong>
                    @elseif($report->auction->getLastStatus()->status == 'removed')
                        <strong class="text-danger">Removed</strong>
                    @endif
                </p>
                <p class="ml-2">
                    <strong class="font-weight-bold text-uppercase">Status Changer:</strong>
                    @if($report->auction->getLastStatus() != null && $report->auction->getLastStatus()->admin_id != null)
                        <strong>{{$report->auction->getLastStatus()->admin->username}} (Administrator)</strong>
                    @elseif($report->auction->getLastStatus() != null && $report->auction->getLastStatus()->moderator_id != null)
                        <strong>
                        <a href="{{route('profile',['id' => $report->auction->getLastStatus()->moderator_id])}}">{{$report->auction->getLastStatus()->moderator->username}}</a> 
                            (Moderator)
                        </strong>
                    @else
                        <strong>None</strong>
                    @endif
                    <p class="ml-2">
                        <strong class="font-weight-bold text-uppercase">Date Changed:</strong>
                        <strong>{{$report->auction->getLastStatus()->datechanged}}</strong>
                    </p>
                </p>
            </section>
        </div>

        <div class="card-footer container">
            <div class="row align-items-center">
                <h5 class="m-0 col-sm-2">Actions:</h5>
                @if($report->auction->getLastStatus()->status == 'ongoing')
                    <div class="col-sm-2 p-0 m-1">
                        <form action="{{ route('cancelAuction', ['id' => $report->auction->id]) }}" method="post">
                            {{ csrf_field() }}
                            <button class="w-100 btn btn-outline-danger" name="cancel" value="1">Remove Auction</button>
                        </form>
                    </div>
                @elseif($report->auction->getLastStatus()->status == 'removed')
                    <div class="col-sm-2 p-0 m-1">
                        <form action="{{ route('cancelAuction', ['id' => $report->auction->id]) }}" method="post">
                            {{ csrf_field() }}
                            <button class="w-100 btn btn-outline-danger" name="cancel" value="0">Reopen Auction</button>
                        </form>
                    </div>
                @endif

                @if($report->auction->user->getLastStatus()->status == 'active')
                    <div class="col-sm-2 p-0 m-1">
                        <form action="{{ route('banUser', ['id' => $report->auction->user->id]) }}" method="post">
                            {{ csrf_field() }}
                            <button class="w-100 btn btn-outline-danger" name="ban" value="1">Ban Owner</button>
                        </form>
                    </div>
                @elseif($report->auction->user->getLastStatus()->status == 'banned')
                    <div class="col-sm-2 p-0 m-1">
                        <form action="{{ route('banUser', ['id' => $report->auction->user->id]) }}" method="post">
                            {{ csrf_field() }}
                            <button class="w-100 btn btn-outline-danger" name="ban" value="0">Unban Owner</button>
                        </form>
                    </div>
                @endif

                @if($report->getLastStatus()->type != 'closed')
                    <div class="col-sm-2 p-0 m-1">
                        <form action="{{ route('closeReport', ['id' => $report->id]) }}" method="post">
                            {{ csrf_field() }}
                            <button class="w-100 btn btn-outline-info" name="close" value="1">Close Report</button>
                        </form>
                    </div>
                @elseif($report->getLastStatus()->type == 'closed')
                    <div class="col-sm-2 p-0 m-1">
                        <form action="{{ route('closeReport', ['id' => $report->id]) }}" method="post">
                            {{ csrf_field() }}
                            <button class="w-100 btn btn-outline-info" name="close" value="0">Reopen Report</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection