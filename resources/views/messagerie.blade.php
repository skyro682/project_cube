@extends('layouts.app')

@section('content')

<div class="container col-10 mt-5 mb-5">

    <h1 class="text-center text-uppercase mb-5">Messagerie</h1>

    <div class="col-lg-8-center">
        <h3 class="text-center" id="wipM">En cours de développement</h3>
    </div>
    <br>

    <!--
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Chats</div>

                    <div class="panel-body">
                        <chat-messages :messages="messages"></chat-messages>
                    </div>
                    <div class="panel-footer">
                        <chat-form
                            v-on:messagesent="addMessage"
                            :user="{{ Auth::user() }}"
                        ></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->

</div>
@endsection
