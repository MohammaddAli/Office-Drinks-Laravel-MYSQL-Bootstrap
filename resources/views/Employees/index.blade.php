@include('header')
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Drink</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($drinks as $drink)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $drink->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('footer')
