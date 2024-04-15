@extends('layouts.app')

@section('title')

    {{$user->username}}

@endsection

@section('contenido')

    <div class="flex justify-center bg-black">
        <div class="container w-5/12 bg-black text-white laterals-borders">
            <div class="mx-6">
                <h1 class="text-4xl">{{$user->name}}</h1>
                <h2 class="text-zinc-500">{{count($posts)}} @choice('Tweet|Tweets',count($posts))</h2>
            </div>
            <div class="container w-full flex justify-center bg-pink-300" style="height: 200px;">
                <div class="w-full"
                     style="background-size: 100% 125%; background-repeat: no-repeat;background-image: url('uploads/banner/{{$user->user_banner}}')">
                </div>
            </div>
            <hr>
            <div class="container flex">
                <div class="container mx-16 flex flex-col lg:flex-row items-center lg:relative">
                    <img src="{{asset('uploads/profile/' . $user->user_image)}}"
                         class="bg-black rounded-full h-44 w-44 lg:absolute lg:pin-l lg:pin-t lg:-mt-24 border border-black"
                         alt=""/>
                </div>
                <div class="container w-4/6 flex justify-end items-center py-8">
                    @if($user->id === Auth::user()->id)
                        <button id="dropdownMenuIconHorizontalButton2"
                                data-dropdown-toggle="dropdownDotsHorizontal2"
                                class="p-2 rounded-full border border-white hover:bg-zinc-500 hover:bg-opacity-20 mr-16"
                                type="button">
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                        </button>
                    @else
                        @if(Auth::user()->is_following($user))
                            <form action="{{route('users.follow.destroy',['user' => $user])}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                        class="boton-unfollow"
                                        id="unfollow">Siguiendo
                                </button>
                            </form>
                        @else
                            <form action="{{route('users.follow.store',['user' => $user])}}" method="post">
                                @csrf
                                <button type="submit"
                                        class="boton-follow"
                                >Seguir
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
            <div class="container w-full mt-8">
                <div class="mx-4">
                    <p class="text-3xl font-bold">{{$user->name}}</p>
                    <p class="text-xl text-zinc-500">{{'@'.$user->username}}</p>
                </div>
            </div>
            <div class="container w-full mb-4">
                <textarea name="biografiaArea" disabled id="biografiaArea"
                          class="w-2/3 mx-2 my-5 text-white text-area resize-none overflow-hidden bg-transparent"
                          maxlength="160">{{$user->bio}}</textarea>
                <div class="flex mx-2 text-zinc-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/>
                    </svg>
                    <p class="text-xl mx-1">Se unió en {{$user->created_at->format('F')}}
                        de {{$user->created_at->format('Y')}}</p>
                </div>
                <div class="flex mx-2 ">
                    <p class="text-xl mx-1 text-white font-semibold">{{$user->followeds->count()}} <span
                            class="text-zinc-500 font-light text-base">Siguiendo</span></p>
                    <p class="text-xl mx-1 text-white font-semibold">{{$user->followers->count()}} <span
                            class="text-zinc-500 font-light text-base">Seguidores</span></p>
                </div>
            </div>
            <hr>
            <div class="container w-full">
                <div class="container w-3/5 mx-auto laterals-borders">
                    @if($user->id === Auth::user()->id)
                        <div class="container py-2.5 border-bottom">
                            <div class="flex justify-center">
                                <button class="rounded-full hover:text-sky-500" type="button"
                                        data-modal-toggle="authentication-modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </button>
                            </div>
                            <h1 class="flex justify-center">Add new Post</h1>
                        </div>
                    @endif
                    <!-- TWEET -->
                    @foreach($posts as $post)
                        <a href="{{route('posts.show',['user' => $user,'post' => $post])}}">
                            <div class="hover:bg-zinc-900 hover:bg-opacity-60 border-bottom">
                                <div class="container flex py-2.5 mx-2">
                                    <input id="rutaProfileUser" hidden
                                           value="{{route('posts.index',$post->user)}}">
                                    <div class="rounded-full hover:bg-zinc-500 hover:bg-opacity-10 min-w-0">
                                        <img src="{{asset('uploads/profile/' . $user->user_image)}}"
                                             id="goProfile"
                                             width="50px" alt="" class="rounded-full"/>
                                    </div>
                                    <span>
                                    <div class="w-full mx-2">
                                            <div class="w-full">
                                                <b class="hover:underline" id="nameUser">
                                                    {{$user->name}}
                                                </b>
                                                <span
                                                    class="text-gray-500">{{'@'.$user->username}}
                                                </span>
                                            </div>
                                            <div class="w-full">
                                                {{$post->post_content}}
                                            </div>
                                        </div>
                                    </span>
                                </div>
                                @if($post->post_image)
                                    <div class="w-full mb-4">
                                        <div class="flex justify-center imagenPost">
                                            <img src="{{asset('uploads/posts/'.$post->post_image)}}"
                                                 class="w-1/2 rounded-xl border-2 border-zinc-600 cursor-pointer imagen"
                                                 width="40%" data-modal-toggle="defaultModal">
                                        </div>
                                    </div>
                                @endif
                        </a>
                        <div class="w-full flex justify-around items-center py-1">
                            <a href="{{route('posts.show',['user' => $user,'post' => $post])}}"
                               class="p-1.5 text-zinc-500 rounded-full hover:bg-sky-600 hover:bg-opacity-10 hover:text-sky-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                                </svg>
                            </a>
                            <div class="flex items-center">
                                <form action="{{route('posts.like.switch',['post' => $post])}}" method="post">
                                    @csrf
                                    <button type="submit"
                                            class="p-1.5 text-zinc-500 rounded-full hover:bg-red-700 hover:bg-opacity-10 hover:text-red-600 {{ $post->checkLike(Auth::user()) ? 'text-red-600' : ''}}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             fill="{{ $post->checkLike(Auth::user()) ? 'red' : 'none'}}"
                                             viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                                        </svg>
                                    </button>
                                </form>
                                <span
                                    class="text-{{ $post->checkLike(Auth::user()) ? 'red-600' : 'zinc-500'}}">{{$post->numLikes()}}</span>
                            </div>
                            @if($user->id === Auth::user()->id)
                                <form method="post" action="{{route('posts.destroy')}}">
                                    @csrf
                                    @method('delete')
                                    <input hidden name="post_id" value="{{$post->id}}">
                                    <button
                                        class="botonDestroy p-1.5 text-zinc-500 rounded-full hover:bg-red-700 hover:bg-opacity-10 hover:text-red-500"
                                        type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Dropdown menu Profile -->
    <div id="dropdownDotsHorizontal2"
         class="hidden border border-zinc-500 rounded hover:border hover:border-zinc-700">
        <ul class="py-1 text-sm text-white text-center" aria-labelledby="dropdownMenuIconHorizontalButton">
            <li class="border-bottom">
                <a href="{{route('profile',['id' => Auth::user()->id])}}"
                   class="block py-2 px-4 hover:text-sky-500 hover:bg-sky-500 hover:bg-opacity-[15%]">Edit Profile</a>
            </li>
            <li>
                <button class="p-1.5 w-full rounded-lg hover:text-sky-500 hover:bg-sky-500 hover:bg-opacity-[15%]"
                        id="editButton">Edit Bio
                </button>
            </li>
            <form method="post" action="{{route('updateBio',['id' => $user->id])}}">
                @method('put')
                @csrf
                <input hidden name="biografia" id="biografiaInput">
                <button type="submit"
                        class="rounded-lg hover:text-green-500 p-1.5 hidden hover:bg-green-500 hover:bg-opacity-[15%]"
                        id="applyButton">Confirmar
                </button>
            </form>
        </ul>
    </div>
    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
        <div class="relative w-2/4 h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-gray-900 rounded-lg shadow py-4 px-4 lg:px-6">
                <button type="button"
                        class="top-1 text-white bg-transparent hover:bg-gray-400 hover:text-gray-900 rounded-full text-sm p-2 ml-auto inline-flex items-center"
                        data-modal-toggle="authentication-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="container flex w-full my-4">
                    <img src="{{asset('uploads/profile/defaultImage.png')}}" class="w-12 h-12 mr-2">
                    <div class="w-8/12">
                        <form action="{{route('post.store')}}" method="post" id="formPost" class="mx-2">
                            @csrf
                            <textarea
                                class="w-full bg-transparent text-white border-none overflow-hidden resize-none outline-none"
                                autofocus maxlength="280" name="post_content" id="textArea" required
                                placeholder="¿Que esta pasando?"></textarea>
                            <input type="hidden" name="post_image" id="post_image">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        </form>
                    </div>
                    <div class="w-4/12 bg-transparent">
                        <form action="{{route('images.store.post')}}" name="imageUpload" method="post" class="dropzone"
                              id="dropzone" enctype="multipart/form-data" style="
                                background-color: transparent;
                                border: 1px solid white;
                                color: white;
                              ">
                            @csrf
                        </form>
                    </div>
                </div>
                <hr>
                <div class="flex justify-center">
                    <input form="formPost" type="submit" id="subPost" class="submit-post mt-3" value="FakeTwitter"/>
                </div>
            </div>
        </div>
    </div>
    <!-- Imagen modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
        <div class="relative max-w-2xl h-full md:h-auto">
            <div class="relative bg-transparent rounded-lg shadow">
                <div class="flex justify-center">
                    <img
                        class="w-full rounded-xl"
                        id="imagenModal" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    @vite('resources/js/dashboard.js')
    @vite('resources/js/dz.js')
@endpush
