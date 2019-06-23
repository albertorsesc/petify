@extends('layouts.app')

@section('title', 'Bienvenidos')

@section('content')

    <h1 class="font-bold text-5xl text-center text-indigo-light hover:text-indigo-dark">
        Bienvenidos a pet<span class="text-green">ify</span>
    </h1>

    <hr>

    <div class="row">
        <div class="w-full flex sm:w-2/3 md:w-1/2 lg:w-1/3 flex flex-col px-3 mb-3">
            <a href="#">
                <div class="card flex flex-1 max-w-sm mb-2 overflow-hidden bg-green-lightest text-center align-middle">
                    <div class="px-4 py-4">
                        <div class="font-bold text-grey-darkest text-xl mb-2">
                            <i class="fas fa-hippo fa-5x float-left"></i>
                            Adopciones
                        </div>
                        <p class="text-grey-darker text-base">
                            Explora o Publica mascotas en adopcion!
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="w-full flex sm:w-2/3 md:w-1/2 lg:w-1/3 flex flex-col px-3 mb-3">
            <a href="#">
                <div class="card flex flex-1 max-w-sm mb-2 overflow-hidden bg-red-lightest text-center align-middle">
                    <div class="px-4 py-4">
                        <div class="font-bold text-grey-darkest text-xl mb-2">
                            <i class="fas fa-medkit fa-5x float-left"></i>
                            {{--<i class="fas fa-bullhorn fa-5x float-left"></i>--}}
                            Veterinarias
                        </div>
                        <p class="text-grey-darker text-base">
                            Explora o Publica Veterinarias!
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="w-full flex sm:w-2/3 md:w-1/2 lg:w-1/3 flex flex-col px-3 mb-3">
            <a href="#">
                <div class="card flex flex-1 flex-col max-w-sm mb-2 overflow-hidden bg-yellow-lightest text-center align-middle">
                    <div class="px-6 py-4">
                        <div class="font-bold text-grey-darkest text-xl mb-2">
                            <i class="far fa-life-ring fa-5x float-left"></i>
                            Solicitud de Ayuda
                        </div>
                        <p class="text-grey-darker text-base">
                            Solicita o Brinda ayuda a animalitos en mal estado.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">

        {{--<div class="w-full flex sm:w-2/3 md:w-1/2 lg:w-1/3 flex flex-col px-3 mb-3">
            <a href="#">
                <div class="card flex flex-1 max-w-sm mb-2 overflow-hidden bg-teal-lightest text-center align-middle">
                    --}}{{--<img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">--}}{{--
                    <div class="px-4 py-4">
                        <div class="font-bold text-grey-darkest text-xl mb-2">
                            <i class="fas fa-home fa-5x float-left"></i>
                            Propiedades
                        </div>
                        <p class="text-grey-darker text-base">
                            Explora las Propiedades disponibles!
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="w-full flex sm:w-2/3 md:w-1/2 lg:w-1/3 flex flex-col px-3 mb-3">
            <a href="#">
                <div class="card flex flex-1 max-w-sm mb-2 overflow-hidden bg-green-lightest text-center align-middle">
                    --}}{{--<img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">--}}{{--
                    <div class="px-4 py-4">
                        <div class="font-bold text-grey-darkest text-xl mb-2">
                            <i class="fas fa-bullhorn fa-5x float-left"></i>
                            Anuncios
                        </div>
                        <p class="text-grey-darker text-base">
                            Anunciate aqui!
                        </p>
                    </div>
                </div>
            </a>
        </div>--}}
    </div>
@endsection
