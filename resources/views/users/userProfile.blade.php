@extends('layouts.app')

@section('content')
<style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .user-details {
            flex: 1;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            margin-right: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-details h2 {
            margin-bottom: 10px;
        }

        .user-details p {
            margin: 5px 0;
        }

        .profile-photo {
            flex: 0 0 200px;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-photo img {
            max-width: 100%;
            height: auto;
        }

        .dashboard-heading {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <h1 class="dashboard-heading">Welcome to the User Profile</h1>
    <div class="container">
        <div class="user-details">
            <h2>User Details</h2>
            <p><strong>Full Name:</strong> {{ $user['name'] }}</p>
            <p><strong>Email:</strong> {{ $user['email'] }}</p>
            <p><strong>Phone Number:</strong> {{ $user['phone'] }}</p>
            <p><strong>Address:</strong> {{ $user['address'] }}</p>
        </div>
        <div class="profile-photo">
            <h2>Profile Photo</h2>
            <img style="height:50px;width:80px;" src="{{ asset('storage/uploads/' . $user['photo']) }}" alt="Profile Photo">
        </div>
    </div>
@endsection
