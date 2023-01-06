@extends('layouts.app')


@section('titulo')
    Perfil de: {{ $user->username }}
@endsection



@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->imagen ?  asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}" alt="imagen Usuario" >
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">

                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                    @auth
                        @if($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                                  </svg>
                                   
                            </a>
                        @endif    
                    @endauth
                </div>


                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{ $user->followers->count() }}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count() )</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followers->count() }}
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">Post</span>
                </p>

            @auth 
                 @if($user->id !== auth()->user()->id)
                <!-- $user es la persona que visitando  y  siguiendo( auth()->user ) es la persona que lo esta visitando  -->
                    @if( !$user->siguiendo( auth()->user() ))
                        <form action="{{ route('users.follow',$user) }}" method="POST">
                            @csrf
                            <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xd font-bold cursor-pointer" 
                            value="Seguir"/>
                        </form>
                    @else
                        <form action="{{ route('users.unfollow',$user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xd font-bold cursor-pointer" 
                            value="Dejar de Seguir"/>
                        </form>
                     @endif
                 @endif
            @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        <x-listar-post :posts="$posts" />
        
    </section>

@endsection