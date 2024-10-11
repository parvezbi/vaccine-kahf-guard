<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="search-container">
        <h1>Enter your NID</h1>
        <p>See the status of your vaccine registration</p>
        <form class="search-form" action="{{ url('/search') }}" method="GET">
            <input type="search" name="nid" placeholder="Enter your NID..." required>
            <button type="submit" class="search-button">Search</button>
        </form>

        @if (session('status'))
            <div class="status-container">
                <div class="status">Status: {{ session('status') }}</div>
            </div>
        @endif

        @if (session('user') && session('schedule'))
            <table class="vaccine-info">
                <tr>
                    <th>Name</th>
                    <td>{{ session('user')->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ session('user')->email }}</td>
                </tr>
                <tr>
                    <th>Registration Date</th>
                    <td>{{ Carbon\Carbon::parse(session('user')->created_at)->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <th>Center</th>
                    <td>{{ session('schedule')->vaccineCenter->name }}</td>
                </tr>
                <tr>
                    <th>Vaccine Date</th>
                    <td>{{ Carbon\Carbon::parse(session('schedule')->vaccine_date)->format('l, F j, Y') }}</td>
                </tr>
            </table>
        @endif
    </div>
</body>
</html>
