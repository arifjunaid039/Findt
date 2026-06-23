<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT | Report Item</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/reportitem.css') }}">
</head>
<body>

    @include('nav')

<form action="/items/store" method="POST" enctype="multipart/form-data" class="report-form">
    @csrf

@if ($errors->any())

<div class="alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h2>Report Lost / Found Item</h2>
<p>Help reunite owners with their belongings by providing accurate information.</p>

<div class="form-row">


<div class="form-group">
    <label>Report Type *</label>
    <select name="item_type" required>        <option value="">Select Type</option>
        <option value="lost">Lost Item</option>
        <option value="found">Found Item</option>
    </select>
</div>

<div class="form-group">
    <label>Category *</label>
    <select name="category_id" required>
        <option value="">Select Category</option>
        <option value="1">Mobile Phone</option>
        <option value="2">Wallet</option>
        <option value="3">ID Card</option>
        <option value="4">Keys</option>
        <option value="5">Laptop</option>
        <option value="6">Documents</option>
        <option value="7">Jewelry</option>
        <option value="8">Other</option>
    </select>
</div>

</div>

<div class="form-row">

<div class="form-group">
    <label>Item Name *</label>
    <input type="text" name="item_name" value="{{ old('item_name') }}" required>
</div>

<div class="form-group">
    <label>Brand / Model</label>
    <input type="text" name="brand" value="{{ old('brand') }}">
</div>

</div>

<div class="form-row">

<div class="form-group">
    <label>Color</label>
    <input type="text" name="color" value="{{ old('color') }}">
</div>

<div class="form-group">
    <label>Date Lost/Found *</label>
    <input type="date" name="item_date" required>
</div>

</div>

<div class="form-group">
    <label>Location *</label>
    <input type="text" name="location" value="{{ old('location') }}" required>
</div>

<div class="form-group">
    <label>Description *</label>
    <textarea name="description" rows="5" required>{{ old('description') }}</textarea>
</div>

<div class="form-group">
    <label>Upload Item Photo *</label>
    <input type="file" name="photo" required>
</div>

<div class="form-group">
    <label>Contact Number *</label>
    <input type="text" name="contact_number" value="{{ old('contact_number') }}" required>
</div>

<div class="form-group">
    <label>Additional Identifying Details(Optional)</label>
    <textarea name="verification_notes" rows="3">{{ old('verification_notes') }}</textarea>
</div>

<button type="submit">Submit Report</button>

</form>


@include('footer')

<script>
    const toggle=document.getElementById('themeToggle');

    toggle.addEventListener('click',()=>{

        document.body.classList.toggle('dark');

        toggle.textContent=
        document.body.classList.contains('dark')
        ? '☀️'
        : '🌙';
    });
    </script>
    
</body>
</html>