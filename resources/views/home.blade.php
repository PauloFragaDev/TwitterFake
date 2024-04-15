@extends('layouts.app')

@section('title')

    Home

@endsection

@section('contenido')

    @if(Auth::check())
        <div class="flex justify-center bg-black">
            <div class="container w-4/12 bg-black text-white laterals-borders">
                @foreach($posts as $post)
                    <a href="{{route('posts.show',['user' => $post->user,'post' => $post])}}">
                        <div class="hover:bg-zinc-900 hover:bg-opacity-60 border-bottom">
                            <div class="container flex py-2.5 mx-2">
                                <input id="rutaProfileUser" hidden
                                       value="{{route('posts.index',$post->user)}}">
                                <div class="rounded-full hover:bg-zinc-500 hover:bg-opacity-10 min-w-0">
                                    <img src="{{asset('uploads/profile/' . $post->user->user_image)}}"
                                         id="goProfile"
                                         width="50px" alt="" class="rounded-full"/>
                                </div>
                                <span>
                                    <div class="w-full mx-2">
                                            <div class="w-full">
                                                <b class="hover:underline" id="nameUser">
                                                    {{$post->user->name}}
                                                </b>
                                                <span
                                                    class="text-gray-500">{{'@'.$post->user->username}}
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
                            <div class="flex justify-center">
                                <img src="{{asset('uploads/posts/'.$post->post_image)}}"
                                     class="w-1/2 rounded-xl border-2 border-zinc-600 cursor-pointer imagenPost imagen"
                                     width="40%" data-modal-toggle="defaultModal">
                            </div>
                        </div>
                    @endif
                    </a>
                    <div class="w-full flex justify-around items-center py-1">
                        <a href="{{route('posts.show',['user' => $post->user,'post' => $post])}}"
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
                    </div>
            </div>
            @endforeach
        </div>
        </div>
    @else
        <div class="flex justify-center bg-black">
            <div class="container w-4/12 bg-black text-white laterals-borders">
                @foreach($posts as $post)
                    <div class="hover:bg-zinc-900 hover:bg-opacity-60 border-bottom">
                        <div class="container flex py-2.5 mx-2">
                            <input hidden
                                   value="{{route('posts.index',$post->user)}}">
                            <div class="rounded-full hover:bg-zinc-500 hover:bg-opacity-10 min-w-0">
                                <img src="{{asset('uploads/profile/' . $post->user->user_image)}}"
                                     width="50px" alt="" class="rounded-full"/>
                            </div>
                            <span>
                                    <div class="w-full mx-2">
                                            <div class="w-full">
                                                <b class="hover:underline">
                                                    {{$post->user->name}}
                                                </b>
                                                <span
                                                    class="text-gray-500">{{'@'.$post->user->username}}
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
                    </div>
                @endforeach
            </div>
            @endif
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
                @vite('resources/js/home.js')
                <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
        @endpush

