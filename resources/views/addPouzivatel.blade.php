@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-md-6 card mx-auto">
        <form id="pridajPouzivatelaForm" action="{{ route('addUser') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="first_name">Meno:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required pattern="[A-Za-záäčďéěíĺľňóôŕšťúůýžÁÄČĎÉĚÍĹĽŇÓÔŔŠŤÚŮÝŽ]+">
            </div>

            <div class="form-group">
                <label for="last_name">Priezvisko:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required pattern="[A-Za-záäčďéěíĺľňóôŕšťúůýžÁÄČĎÉĚÍĹĽŇÓÔŔŠŤÚŮÝŽ]+">
            </div>    

            <div class="form-group">    
                <label for="username">Používateľské meno:</label>
                <input type="text" id="username" name="username" class="form-control" required pattern="[a-zA-Z0-9]+">
            </div>

            <div class="form-group">
                <label for="password">Heslo:</label>
                <input type="password" id="password" name="password" class="form-control" required pattern="[a-zA-Z0-9.,_-]+">
            </div>

            <div class="form-group">
                <label for="user_type">Typ používateľa:</label>
                <select id="user_type" name="user_type" required class="form-control">
                    <option value="admin">Admin</option>
                    <option value="veduci">Veduci</option>
                    <option value="student">Student</option>
                </select>
            </div>

            <button type="submit" id="pridajPouzivatelaBtn" class="btn btn-secondary" style="margin-bottom: 20px; margin-top: 20px">Pridaj používateľa</button>
        </form>
    </div>
</div>


</body>
@endsection