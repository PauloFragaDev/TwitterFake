@extends('layouts.app')

@section('title')

    Post

@endsection

@section('contenido')
    <div class="flex justify-center bg-black">
        <div class="container w-5/12 bg-black text-white laterals-borders">
            <div class="flex items-center m-2">
                <a href="{{route('posts.index',$post->user)}}">
                    <div class="rounded-full p-2 hover:bg-zinc-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                        </svg>
                    </div>
                </a>
                <span class="mx-6 font-bold text-xl">
                    Tweet
                </span>
            </div>
            <div class="container flex m-5 w-full">
                <div>
                    <a href="{{route('posts.index',$post->user)}}">
                        <img src="{{asset('uploads/profile/' . $post->user->user_image)}}"
                             id="goProfile"
                             width="50px" alt="" class="rounded-full"/>
                    </a>
                </div>
                <div class="mx-2">
                    <a href="{{route('posts.index',$post->user)}}">
                        <p class="font-bold hover:underline">{{$post->user->name}}</p>
                        <p class="text-zinc-400">{{'@'.$post->user->username}}</p>
                    </a>
                </div>
            </div>
            <div class="container w-full mx-5">
                <p class="{{empty($post->post_image) ? 'text-2xl' : 'text-xl'}}">{{$post->post_content}}</p>
            </div>
            @if(!empty($post->post_image))
                <div class="container w-full m-2 my-4 flex justify-center">
                    <img src="{{asset('uploads/posts/'.$post->post_image)}}"
                         class="w-1/2 rounded-xl border-2 border-zinc-600 cursor-pointer"
                         alt="" data-modal-toggle="defaultModal"/>
                </div>
            @endif
            <div class="container w-full my-4 mx-5 flex">
                <span
                    class="text-zinc-500 hover:underline">{{$post->created_at->format('g:i a.' . ' • ' . 'j M. Y' )}}</span>
            </div>
            <div class="container w-full flex justify-center">
                <div class="w-full mx-5 border-bottom"></div>
            </div>
            <div class="container w-full my-4 mx-5 flex">
                <p class="font-bold mx-1">{{$post->comments()->count() . ' '}}<span class="text-zinc-500">@choice('Comentario|Comentarios',$post->comments()->count())</span></p>
                <p class="font-bold mx-1">{{$post->numLikes() . ' ' }}<span class="text-zinc-500">@choice('Like|Likes',$post->numLikes())</span></p>
            </div>
            <div class="container w-full flex justify-center">
                <div class="w-full mx-5 border-bottom"></div>
            </div>
            <div class="container w-full my-4 mx-5 flex justify-around">
                <button type="button" id="iconComment" class="p-1.5 rounded-full hover:bg-green-500 hover:bg-opacity-10 hover:text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 hover:text-gree-800">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z"/>
                    </svg>
                </button>
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
            </div>
            <div class="container w-full flex justify-center">
                <div class="w-full mx-5 border-bottom"></div>
            </div>
            <div class="container my-2">
                <div class="container w-full mx-16">
                    <span class="w-full mx-10"> Respondiendo a
                        <a class="text-sky-500 hover:underline" href="{{route('posts.index',$post->user)}}">
                            {{$post->user->name}}
                        </a>
                    </span>
                </div>
                <div class="container w-full my-4">
                    <form method="post" action="{{route('comments.store')}}">
                        @csrf
                        <input hidden name="post_id" value="{{$post->id}}"/>
                        <input hidden name="user_id" value="{{$post->user_id}}"/>
                        <div class="container flex w-auto mx-5">
                            <div>
                                <img src="{{asset('uploads/profile/' . Auth::user()->user_image)}}"
                                     id="goProfile"
                                     width="65px" alt="" class="rounded-full"/>
                            </div>
                            <div class="w-full mx-2">
                            <textarea
                                class="w-5/6 mx-1 bg-transparent text-white rounded-xl border-none overflow-hidden resize-none"
                                autofocus maxlength="280" name="comment" required id="textComment"
                                placeholder="FakeTwittea tu respuesta"></textarea>
                            </div>
                        </div>
                        <div class="container w-full">
                            <div class="container flex justify-end">
                                <button type="submit"
                                        class="bg-sky-500 rounded-full font-bold hover:bg-sky-600 py-2 px-4 mr-4">
                                    Responder
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container w-full flex justify-center border-bottom mt-4"></div>

            @foreach($listComments as $comment)
                <div class="container w-full my-4 mx-5">
                    <div class="container w-full flex">
                        <div class="container w-auto">
                            <a href="{{route('posts.index',$comment->user)}}">
                                <img src="{{asset('uploads/profile/' . $comment->user->user_image)}}"
                                     id="goProfile"
                                     width="50px" alt="" class="rounded-full"/>
                            </a>
                        </div>
                        <div class="containerw-5/6 mx-8">
                            <div class="container w-full flex">
                                <p>
                                    <a href="{{route('posts.index',$comment->user)}}">
                                        <span class="font-bold hover:underline">{{$comment->user->name}}</span>
                                    </a>
                                    <span
                                        class="text-zinc-500">{{'@'.$comment->user->username . ' • ' . $comment->created_at->format('j M.')}}</span>
                                </p>
                            </div>
                            <div class="container w-full">
                            <span class="w-full"> En respuesta a
                                <a class="text-sky-500 hover:underline" href="{{route('posts.index',$post->user)}}">
                                    {{$post->user->name}}
                                </a>
                            </span>
                            </div>
                            <div class="container w-full">
                            <span>
                                {{$comment->comment}}
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container w-full flex justify-center border-bottom mt-4"></div>
            @endforeach
        </div>
    </div>
    <!-- Imagen modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
        <div class="relative max-w-2xl h-full md:h-auto">
            <div class="relative bg-transparent rounded-lg shadow">
                <div class="flex justify-center">
                    <img src="{{asset('uploads/posts/'.$post->post_image)}}"
                        class="w-full rounded-xl"
                        id="imagenModal" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/post.js')
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
@endpush
