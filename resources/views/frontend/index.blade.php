@extends('frontend.layouts.app')

@section('title') {{app_name()}} @endsection

@section('content')

<section class="bg-gray-100 mb-20">
    <div class="container mx-auto flex px-1 sm:px-20 py-20 md:flex-row flex-col items-center">
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            <img class="object-cover object-center rounded" alt="hero" src="{{ asset('img/vandna-steel-logo-square.png') }}">
        </div>
        <div class="lg:flex-grow md:w-1/2 px-4 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
            <h1 class="title-font sm:text-8xl text-5xl mb-4 font-medium text-white-800">
               {{ app_name() }}
            </h1>
            <p class="mb-8 sm:text-3xl text-2xl">
                Simply set reminders for important tasks, appointments, or events, and we'll make sure you receive a timely text message to keep you informed.
            </p>

            @include('frontend.includes.messages')

            @auth
                <div class="flex justify-center"> 
                    @can('view_backend')
                    <a href='{{ route("backend.dashboard") }}' class="block text-white bg-gray-700 border-0 py-2 px-6 focus:outline-none hover:bg-orange-600 rounded text-lg"style="background: #7a69d8;">
                        <i class="fas fa-tachometer-alt fa-fw"></i>&nbsp;{{__('Go To Dashbord')}}
                    </a>
                    @endif  
                </div>
            @endauth

        </div>
    </div>
</section>

@endsection