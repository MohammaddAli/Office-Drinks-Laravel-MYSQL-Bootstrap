@include('header')
<div class="container">
    <a href="{{ route('office-boys.index') }}" class="btn btn-success p-3">Orders List</a>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">The Order</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderArr as $order)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>Drink: {{ $order[0]['name'] }}</td>
                    <td>Stock: {{ $order[0]['stock'] }}</td>
                    <td>Employee: {{ $order[1]['name'] }}</td>
                </tr>
                <tr>
                    <td>
                        <form action="{{ route('office-boys.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="drinkId" value="{{ $order[0]['id'] }}">
                            <input type="hidden" name="employeeId" value="{{ $order[1]['id'] }}">
                            <input type="submit" value="Confirm" class="btn btn-primary">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('done'))
        <div class="alert alert-secondary text-center" role="alert">
            <h2>{{ Session::get('done') }}</h2>
    @endif

</div>
@include('footer')
