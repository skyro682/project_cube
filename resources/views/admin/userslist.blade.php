@extends('layouts.app')

@section('content')

<div class="container col-10 mt-5 mb-5">

    <h1 class="text-center text-uppercase mb-5">Gestion des utilisateurs</h1>
    
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">username</th>
                <th scope="col">first name</th>
                <th scope="col">last name</th>
                <th scope="col">email</th>
                <th scope="col">addresse</th>
                <th scope="col">city</th>
                <th scope="col">cp_code</th>
                <th scope="col">grade</th>
                <th scope="col">created at</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($users as $user)

                <tr>

                    <th>{{ $user->id }}</th>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->addresse }}</td>
                    <td>{{ $user->city }}</td>
                    <td>{{ $user->cp_code }}</td>
                    <td>
                        <div class="d-flex">
                            <select class="custom-select custom-select-sm" name="userGrade" form="changeGrade">
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ ($user->grade->id == $grade->id) ? 'selected' : '' }}>{{ $grade->name }}</option>
                                @endforeach
                            </select>
                            <button class="ml-1 btn btn-outline-dark btn-sm" type="submit" form="changeGrade"><i class="bi bi-save"></i></button>
                            <input type="text" name="userId" value="{{ $user->id }}" form="changeGrade" hidden>
                        </div>
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td><i onclick="location.href='{{ Route('users.delete', ['id' => $user->id]) }}'" class="btn btn-sm btn-outline-danger bi bi-trash"></i></td>

                </tr>

            @endforeach
            
        </tbody>
    </table>

</div>

<form action="{{ Route('users.grade') }}" method="POST" id="changeGrade" class="d-none">@csrf</form>

@endsection