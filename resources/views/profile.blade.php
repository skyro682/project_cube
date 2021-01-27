@extends('layouts.app')

@section('content')
    
    <div class="container">

        <h1>Mon Profile</h1>

        <form action="{{ Route('editProfile', ['section' => 'email']) }}" method="POST" class="mt-5">
            @csrf

            <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                    <input type="text" value="{{ $user->username }}" id="username" class="form-control" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-9">
                    <input type="text" value="{{ $user->first_name }}" class="form-control" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-9">
                    <input type="text" value="{{ $user->last_name }}" class="form-control" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Confirmer email</label>
                <div class="col-sm-9">
                    <input type="email" name="confEmail" value="" class="form-control" required>
                </div>
            </div>

            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-sm btn-outline-success">Sauvegarder</button>
            </div>

        </form>

        <div class="dropdown-divider my-5 "></div>

        <form action="{{ Route('editProfile', ['section' => 'address']) }}" method="POST">
            @csrf

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Adresse</label>
                <div class="col-sm-9">
                    <input type="text" name="address" value="{{ $user->address }}" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Ville</label>
                <div class="col-sm-9">
                    <input type="text" name="city" value="{{ $user->city }}" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Code Postal</label>
                <div class="col-sm-9">
                    <input type="text" name="cpCode" value="{{ $user->cp_code }}" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Grade</label>
                <div class="col-sm-9">
                    <input type="text" value="{{ $user->grade->name }}" class="form-control" readonly>
                </div>
            </div>

            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-sm btn-outline-success">Sauvegarder</button>
            </div>

        </form>

        <div class="dropdown-divider my-5"></div>

        <form action="{{ Route('editProfile', ['section' => 'password']) }}" method="POST">
            @csrf

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Mot de passe</label>
                <div class="col-sm-9">
                    <input type="password" name="password" value="{{ $user->address }}" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nouveau mot de passe</label>
                <div class="col-sm-9">
                    <input type="password" name="newPassword" value="{{ $user->city }}" class="form-control" minlength="8" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Confirmer mot de passe</label>
                <div class="col-sm-9">
                    <input type="password" name="confPassword" value="{{ $user->cp_code }}" class="form-control" minlength="8" required>
                </div>
            </div>

            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-sm btn-outline-success">Sauvegarder</button>
            </div>

        </form>

        <div class="dropdown-divider my-5"></div>

        <form action="{{ Route('deleteProfile') }}" method="GET" class="mb-5" id="deleteProfileForm">
            @csrf
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-danger">Supprimer mon compte</label>
                <div class="col-sm-9 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteProfileModal">Supprimer</button>
                </div>
            </div>
        </form>

    </div>

    <div class="modal fade" id="deleteProfileModal" tabindex="-1"aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body d-flex">
                    <p class="mb-0">Etes vous sûr de vouloir supprimer votre compte ?</p>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
                    <button type="submit" form="deleteProfileForm" class="btn btn-danger btn-sm ml-1">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

@endsection