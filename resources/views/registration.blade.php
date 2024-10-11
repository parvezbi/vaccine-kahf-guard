<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="registration-container">
    <h1>Registration Form For Vaccine</h1>
    <form class="registration-form" action="{{ route('vaccine.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter your full name">
        </div>
        <div class="form-group">
            <label for="nid">NID:</label>
            <input type="text" id="nid" name="nid" value="{{ old('nid') }}" required placeholder="Enter your National ID number">
            @error('nid')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email address">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required placeholder="Enter your phone number">
            @error('phone_number')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="vaccine_center_id">Center:</label>
            <select id="vaccine_center_id" name="vaccine_center_id" required>
                <option value="">Select a center</option>
                @foreach($vaccineCenters as $center)
                    <option value="{{ $center->id }}" {{ old('vaccine_center_id') == $center->id ? 'selected' : '' }}>{{ $center->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="submit-button">Register</button>
    </form>
</div>

</body>
</html>
