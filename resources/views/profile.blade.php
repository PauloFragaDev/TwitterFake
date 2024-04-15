@extends('layouts.app')

@section('title')

    Profile

@endsection

@section('contenido')

    <h2 class="font-bold underline text-3xl">
        Profile Page
    </h2>
    <h1 class="pt-8 text-center text-5xl">Profile User</h1>
    <div class="w-full flex justify-center mt-5">
        <div class="container w-4/5">
            @if(@isset($usuarios))
                <div class="container w-1/2 mx-auto mb-6">
                    <table
                        class="table-auto text-left bg-transparent text-white rounded-lg border shadow-lg shadow-white">
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="px-16">Name</th>
                            <th scope="col" class="px-16">UserName</th>
                            <th scope="col" class="px-16">Email</th>
                            <th scope="col" class="px-16">Action</th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @foreach($usuarios as $u)
                            <tr class="border-b">
                                <td>{{$u->name}}</td>
                                <td>{{$u->username}}</td>
                                <td>{{$u->email}}</td>
                                <td class="flex justify-between my-2 ">
                                    <button class="button-submit-forms">
                                        <a href="{{route('profile',['id' => $u->id])}}">Edit</a>
                                    </button>
                                    @if(!$u->is_admin)
                                        <div class="deleteRow">
                                            <button class="button-reset-forms deleteBtn" value="{{$u->id}}"
                                                    data-modal-toggle="popup-modal">
                                                Delete
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="popup-modal" tabindex="-1"
                     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 md:inset-0 h-modal md:h-full">
                    <div class="relative w-full max-w-md h-full md:h-auto">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button"
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                    data-modal-toggle="popup-modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you
                                    want to delete this product?</h3>
                                <form action="{{route('remove')}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input hidden name="user_id" id="user_id">
                                    <button data-modal-toggle="popup-modal" type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                </form>
                                <button data-modal-toggle="popup-modal" type="button"
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="container w-1/2 flex mx-auto">
                <form
                    class="shadow-2xl shadow-white w-1/2 rounded px-16 pt-6 pb-8 bg-none border border-zinc-400 mx-auto"
                    action="{{route('update',['id' => $selected->id])}}"
                    method="post">
                    @method('put')
                    @csrf
                    <label class="label-forms" for="name">Name :</label>
                    <input class="input-forms" id="name" type="text" placeholder="Name" name="name"
                           value="{{$selected->name}}">
                    @error('name')
                    <p class="text-red-500 ">{{$message}}</p>
                    @enderror
                    <label class="label-forms" for="username">Username :</label>
                    <input class="input-forms" id="username" type="text" placeholder="Username" name="username"
                           value="{{$selected->username}}">
                    @error('username')
                    <p class="text-red-500 ">{{$message}}</p>
                    @enderror
                    <label class="label-forms" for="email">Email :</label>
                    <input class="input-forms" id="email" type="email" placeholder="Email" name="email"
                           value="{{$selected->email}}">
                    @error('email')
                    <p class="text-red-500 ">{{$message}}</p>
                    @enderror
                    <label class="label-forms" for="password">Password :</label>
                    <input class="input-forms" id="password" type="password" placeholder="******************"
                           name="password">
                    @error('password')
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                    <label class="label-forms" for="password_confirmation">Password Confirmation:</label>
                    <input class="input-forms" id="password_confirmation" type="password"
                           placeholder="******************"
                           name="password_confirmation">
                    <input type="hidden" id="user_image" name="user_image">
                    <input type="hidden" id="user_banner" name="user_banner">
                    <div class="w-full flex justify-between">
                        <button class="button-submit-forms" type="submit">Edit</button>
                        <button class="button-reset-forms" type="reset">Reset</button>
                    </div>
                </form>
                <div class="w-1/2 mx-5">
                    <div class="w-full my-16">
                        <h1 class="text-white text-xl font-bold flex justify-center">Profile Image</h1>
                        <form action="{{route('images.store.profile')}}" name="imageProfileUpload" method="post" class="dropzone"
                              id="dropzoneProfile" enctype="multipart/form-data" style="
                                background-color: transparent;
                                border: 1px solid white;
                                color: white;
                              ">
                            @csrf
                        </form>
                    </div>
                    <div class="w-full my-16">
                        <h1 class="text-white text-xl font-bold flex justify-center">Banner Image</h1>
                        <form action="{{route('images.store.banner')}}" name="imageBannerUpload" method="post" class="dropzone"
                              id="dropzoneBanner" enctype="multipart/form-data" style="
                                background-color: transparent;
                                border: 1px solid white;
                                color: white;
                              ">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    @vite('resources/js/profiles.js')
    @vite('resources/js/dzProfile.js')
    @vite('resources/js/dzBanner.js')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
@endpush
