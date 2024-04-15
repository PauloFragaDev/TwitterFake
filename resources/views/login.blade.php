@extends('layouts.app')

@section('title')

    Login Page

@endsection

@section('contenido')

    <h1 class="pt-64 text-center text-5xl text-white">Sign In</h1>
    <div class="w-auto flex justify-center mt-5">
        <form class="shadow-xl shadow-zinc-500 rounded px-8 pt-6 pb-8 mb-4 bg-transparent border-2 border-zinc-500" action="{{route('login')}}" method="post">
            @csrf
            <label class="label-forms" for="username">Username</label>
            <input class="input-forms" id="username" type="text" placeholder="Username" name="username">
            @error('username')
            <p class="text-red-500 ">{{$message}}</p>
            @enderror
            <label class="label-forms" for="password">Password</label>
            <input class="input-forms" id="password" type="password" placeholder="******************" name="password">
            @error('password')
            <p class="text-red-500">{{$message}}</p>
            @enderror
            <div class="w-full flex justify-between">
                <button class="button-submit-forms" type="submit">Sign In</button>
                <button class="button-reset-forms" type="reset">Reset</button>
            </div>
            <p class="mt-5 text-center text-gray-600 text-s italic">No tienes cuenta? <a class="hover:text-white" href="{{route('register')}}">Registrarse</a></p>
        </form>
    </div>

@endsection

