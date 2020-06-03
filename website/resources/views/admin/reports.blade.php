@extends('admin.layout')

@section('adminContent')
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark text-center">
                        <th scope="col" class="align-middle">#</th>
                        <th scope="col" class="align-middle">Auction's Title</a></th>
                        <th scope="col" class="align-middle">Owner</a></th>
                        <th scope="col" class="align-middle">Auction's Status</a></th>
                        <th scope="col" class="align-middle">Reporter</a></th>
                        <th scope="col" class="align-middle">Report Date</th>
                        <th scope="col" class="align-middle">Report Status</th>
                        <th scope="col" class="align-middle">Changed By</th>
                        <th scope="col" class="align-middle">Actions</th>
                    </thead>
                    
                    <tbody class="text-center">
                        @each('admin.partials.reportRow', $reports, 'report')
                    </tbody>
                </table>
                {{ $reports->links() }}
            </div>
        </div>
    </div>
</div>
@endsection