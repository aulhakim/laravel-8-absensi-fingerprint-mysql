@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    {{-- {{ __('You are logged in!') }} --}}
                        user
                    <table>
                        <tr>
                            <th>UID</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Password</th>
                        </tr>

                        {{-- {{  dd($users); }} --}}
                        @foreach ($users as $val)

                       
                        <tr>
                            <td>{{ $val['uid'] }}</td>
                            <td>{{ $val['userid'] }}</td>
                            <td>{{ $val['name'] }}</td>
                            <td>{{ $val['role'] }}&nbsp;</td>
                            <td>{{ $val['password'] }} </td>

                        </tr>
                        @endforeach 
                    </table>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
