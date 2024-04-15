@extends('layouts.app')

@section('title')

    Register Page

@endsection

@section('contenido')

    <h1 class="pt-32 text-center text-5xl text-white">Sign Up</h1>
    <div class="w-auto flex justify-center mt-5">
        <form class="w-1/4 shadow-xl shadow-zinc-500 rounded px-16 pt-6 pb-8 mb-4 bg-transparent border-2 border-zinc-500" action="{{route('register')}}" method="post">
            @csrf
            <label class="label-forms" for="name">Name :</label>
            <input class="input-forms" id="name" type="text" placeholder="Name" name="name">
            @error('name')
            <p class="text-red-500 ">{{$message}}</p>
            @enderror
            <label class="label-forms" for="username">Username :</label>
            <input class="input-forms" id="username" type="text" placeholder="Username" name="username">
            @error('username')
            <p class="text-red-500 ">{{$message}}</p>
            @enderror
            <label class="label-forms" for="email">Email :</label>
            <input class="input-forms" id="email" type="email" placeholder="Email" name="email">
            @error('email')
            <p class="text-red-500 ">{{$message}}</p>
            @enderror
            <label class="label-forms" for="password">Password :</label>
            <input class="input-forms" id="password" type="password" placeholder="******************" name="password">
            @error('password')
            <p class="text-red-500">{{$message}}</p>
            @enderror
            <label class="label-forms" for="password_confirmation">Password Confirmation:</label>
            <input class="input-forms" id="password_confirmation" type="password" placeholder="******************" name="password_confirmation">
            <div class="w-full flex justify-between">
                <button class="button-submit-forms" type="submit">Sign Up</button>
                <button class="button-reset-forms" type="reset">Reset</button>
            </div>
            <p class="mt-5 text-center text-gray-600 text-s italic">Ya tiene cuenta? <a class="hover:text-white" href="{{route('login')}}">Login</a></p>
        </form>
    </div>

@endsection
