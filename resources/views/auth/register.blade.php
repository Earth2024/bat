<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="{{route('mt_5')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="number" name="leverage" placeholder="Leverage" required><br>
        <input type="text" name="currency" placeholder="currency" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    <div>
        <livewire:deriv />
    </div>
</body>
</html>
