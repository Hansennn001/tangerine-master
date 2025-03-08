@extends('layouts.user')

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

@section('content')
    {{-- Hero --}}
    <div class="h-[550px] relative">
        <img src="/imgs/jumbotron.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/50 bg-opacity-60"></div>
        <div class="absolute ps-5 top-0 left-0 text-white flex flex-col justify-center lg:items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold">Embrace Your Radiance</h2>
            <p class="text-lg text-white w-[90%] lg:w-auto">Enhancing your natural beauty in a way that aligns with your
                values.</p>
        </div>
    </div>
    {{-- EndHero --}}

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    {{-- Services --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
        {{-- Treatment --}}
        <div class="w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Treatment
            </h1>

            <!-- Swiper Container -->
            <div class="mt-10 swiper treatment-swiper">
                <div class="swiper-wrapper">
                    @foreach ($services->where('category.name', 'Treatment') as $service)
                        <div class="swiper-slide">
                            <img src="/uploads/services/{{ $service->image }}"
                                class="w-full h-[270px] object-cover rounded-md shadow-md">
                            <div class="mt-5 text-center">
                                <h1 class="text-xl text-stone-700 poppins-medium">{{ $service->name }}</h1>
                            </div>
                            <a href="{{ route('service.detail', $service->slug) }}"
                                class="block w-fit mt-2 mx-auto text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                <i class="fa-solid fa-arrow-up-right-from-square mr-1.5"></i> Booking
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Arrows -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

        {{-- Nails --}}
        <div class="my-28 w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Nails
            </h1>
            <div class="mt-10 swiper nails-swiper">
                <div class="swiper-wrapper">
                    @foreach ($services->where('category.name', 'Nails') as $service)
                        <div class="swiper-slide">
                            <img src="/uploads/services/{{ $service->image }}"
                                class="w-full h-[270px] object-cover rounded-md shadow-md">
                            <div class="mt-5 text-center">
                                <h1 class="text-xl text-stone-700 poppins-medium">{{ $service->name }}</h1>
                            </div>
                            <a href="{{ route('service.detail', $service->slug) }}"
                                class="block w-fit mt-2 mx-auto text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                <i class="fa-solid fa-arrow-up-right-from-square mr-1.5"></i> Booking
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Arrows -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

        {{-- Haircut --}}
        <div class="my-28 w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Haircut
            </h1>
            <div class="mt-10 swiper haircut-swiper">
                <div class="swiper-wrapper">
                    @foreach ($services->where('category.name', 'Haircut') as $service)
                        <div class="swiper-slide">
                            <img src="/uploads/services/{{ $service->image }}"
                                class="w-full h-[270px] object-cover rounded-md shadow-md">
                            <div class="mt-5 text-center">
                                <h1 class="text-xl text-stone-700 poppins-medium">{{ $service->name }}</h1>
                            </div>
                            <a href="{{ route('service.detail', $service->slug) }}"
                                class="block w-fit mt-2 mx-auto text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                <i class="fa-solid fa-arrow-up-right-from-square mr-1.5"></i> Booking
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Arrows -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

        {{-- Hairstyle --}}
        <div class="my-28 w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Hairstyle
            </h1>
            <div class="mt-10 swiper hairstyle-swiper">
                <div class="swiper-wrapper">
                    @foreach ($services->where('category.name', 'Hairstyle') as $service)
                        <div class="swiper-slide">
                            <img src="/uploads/services/{{ $service->image }}"
                                class="w-full h-[270px] object-cover rounded-md shadow-md">
                            <div class="mt-5 text-center">
                                <h1 class="text-xl text-stone-700 poppins-medium">{{ $service->name }}</h1>
                            </div>
                            <a href="{{ route('service.detail', $service->slug) }}"
                                class="block w-fit mt-2 mx-auto text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                <i class="fa-solid fa-arrow-up-right-from-square mr-1.5"></i> Booking
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Arrows -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </div>
    {{-- End Services --}}
@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".treatment-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        }
    });

    new Swiper(".nails-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        }
    });

    new Swiper(".haircut-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        }
    });

    new Swiper(".hairstyle-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        }
    });
});
</script>
