@extends('layouts.app')

@section('content')

<!-- Formulár na pridanie používateľa -->
<form id="pridajPouzivatelaForm" action="{{ route('pridaj.pouzivatela') }}" method="POST">
    @csrf
    <label for="first_name">Meno:</label>
    <input type="text" id="first_name" name="first_name" required>

    <label for="last_name">Priezvisko:</label>
    <input type="text" id="last_name" name="last_name" required>

    <label for="username">Používateľské meno:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Heslo:</label>
    <input type="password" id="password" name="password" required>

    <label for="user_type">Typ používateľa:</label>
    <select id="user_type" name="user_type" required>
        <option value="admin">Admin</option>
        <option value="veduci">Veduci</option>
        <option value="student">Student</option>
    </select>

    <button type="submit" id="pridajPouzivatelaBtn">Pridaj používateľa</button>
</form>

</body>
@endsection