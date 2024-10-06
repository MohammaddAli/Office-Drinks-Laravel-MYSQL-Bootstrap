@include('header')
<a href="{{ route('office-boys.create') }}" class="btn btn-success p-3">Orders Requests</a>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usersOrders as $users)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $users->name }}</td>
            </tr>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Drink</th>
                    <th scope="col">Count</th>
                </tr>
            </thead>
    <tbody>
        @foreach ($users->orders as $Order)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $Order->drink->name }}
                <td>
                <td>{{ $Order->drink_count }}
                <td>
            </tr>
        @endforeach
    </tbody>
    @endforeach

    </tbody>
    <tfoot style="padding-top: 50px">
        <tr>
            <th scope="row" style="font-size: 25px">Final Count</th>
            @foreach ($counts as $count)
                <td>Name: {{ $count->user->name }}</td>
                <td>Count: {{ $count->count }}</td>
            @endforeach
        </tr>
    </tfoot>
</table>

@include('footer')
