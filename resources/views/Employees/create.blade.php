@include('header')
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>


</x-app-layout> --}}



@include('layouts.navigation')


<div class="container">
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
    @if (Session::has('exceed'))
        <div class="alert alert-secondary text-center" role="alert">
            <h2>{{ Session::get('exceed') }}</h2>
    @endif
    <form action="{{ route('employees.store') }}" method="post">
        @csrf
        <select name="drink" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option selected>Open this select menu</option>
            @foreach ($drinks as $drink)
                <option value="{{ $drink->id }}">{{ $drink->name }}</option>
                {{-- <input type="hidden" name="drinkId" value="{{ $drink->id }}"> --}}
            @endforeach
        </select>
        <input type="submit" value="Order" class="btn btn-primary">
    </form>
</div>
@include('footer')
