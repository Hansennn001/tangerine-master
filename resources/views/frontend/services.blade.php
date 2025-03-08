@extends('layouts.user')

@section('content')
    {{-- Hero --}}
    <div class="h-[550px] relative">
        <img src="/imgs/jumbotron.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/50 bg-opacity-60"></div>
        <div class="absolute ps-5 top-0 left-0 text-white flex flex-col justify-center lg:items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold">Embrace Your Radiance</h2>
            <p class="text-lg text-white w-[90%] lg:w-auto">Enhancing your natural beauty in a way that aligns with your values.</p>
        </div>
    </div>
    {{-- EndHero --}}

    {{-- Services --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
        {{-- Treatment --}}
        <div class=" w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Treatment
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-4 gap-12">
                @foreach ($services as $service)
                    <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <img src="/uploads/services/{{ $service->image }}"
                            class="w-full h-[270px] object-cover rounded-md shadow-md">
                        <div class="mt-5 text-center">
                            <h1 class="text-xl text-stone-700 poppins-medium">{{ $service->name }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Waxing --}}
        <div class="my-28 w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Waxing
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-4 gap-12">
                @foreach ($services as $service)
                    <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <img src="/uploads/services/{{ $service->image }}"
                            class="w-full h-[270px] object-cover rounded-md shadow-md">
                        <div class="mt-5 text-center">
                            <h1 class="text-xl text-stone-700 poppins-medium">{{ $service->name }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Nails --}}
        <div class="my-28 w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Nails
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-4 gap-12">
                @foreach ($services as $service)
                    <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <img src="/uploads/services/{{ $service->image }}"
                            class="w-full h-[270px] object-cover rounded-md shadow-md">
                        <div class="mt-5 text-center">
                            <h1 class="text-xl text-stone-700 poppins-medium">{{ $service->name }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Hair --}}
        <div class="my-28 w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Hairstyle
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-4 gap-12">
                @foreach ($services as $service)
                    <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <img src="/uploads/services/{{ $service->image }}"
                            class="w-full h-[270px] object-cover rounded-md shadow-md">
                        <div class="mt-5 text-center">
                            <h1 class="text-xl text-stone-700 poppins-medium">{{ $service->name }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <a href="{{ route('service.detail', $service->slug) }}"
            class="block w-fit mt-2 mx-auto text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fa-solid fa-arrow-up-right-from-square mr-1.5"></i>
            Booking
        </a>
    </div>
    {{-- End Services --}}
@endsection
