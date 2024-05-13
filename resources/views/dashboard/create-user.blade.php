<!-- resources/views/create-user.blade.php -->

@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Create New User</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('store-user') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <!-- Add fingerprint capture functionality here -->
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Enroll New User</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('store-user') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fingerprint_data">Fingerprint Data</label>
                            <input type="text" name="fingerprint_data" id="fingerprint_data" class="form-control" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Enroll User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add an event listener to the fingerprint area (replace 'fingerprintArea' with the appropriate ID)
        var fingerprintArea = document.getElementById('fingerprint_area');
        fingerprintArea.addEventListener('click', function() {
            // Simulate getting the UID or fingerprint data from the device
            var uidOrFingerprintData = '123456'; // Replace with actual data from device
            
            // Update the input field with the received data
            var fingerprintInput = document.getElementById('fingerprint_data');
            fingerprintInput.value = uidOrFingerprintData;
        });
    });
</script>