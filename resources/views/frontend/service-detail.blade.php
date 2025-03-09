@extends('layouts.user')

@section('content')
    {{-- Hero --}}
    <div class="h-[550px] relative">
        <img src="/uploads/services/{{ $service->image }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/60 bg-opacity-60"></div>
        <div
            class="absolute lg:ps-5 top-0 left-0 right-0 text-white flex flex-col justify-center items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold text-center">{{ $service->name }}</h2>
        </div>
    </div>
    {{-- End Hero --}}

    <div class="px-5 lg:px-20 py-5 lg:py-10 min-h-screen">
        <div class="">
            <h1 class="text-3xl text-center text-stone-700 poppins-bold">Pricelist</h1>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 mt-10">
                @foreach ($service->serviceDetails as $detail)
                    <div class="bg-stone-50 rounded-md shadow-md p-5">
                        <h1 class="text-center poppins-medium text-base text-stone-700">{{ $detail->name }}</h1>
                        <div class="mt-5">
                            <div class="flex justify-between text-sm text-stone-600">
                                <span>Price</span>
                                <span>{{ format_rupiah($detail->price) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-16 lg:mt-20">
            <h1 class="text-3xl text-center text-stone-700 poppins-bold">Booking</h1>
            <form method="POST" id="form-membership" action="" class="mt-10 w-full lg:w-1/2 mx-auto space-y-5 pb-20">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <div class="">
                    <select id="plan" name="plan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                        <option value="" selected>-- Choose --</option>
                        @foreach ($service->serviceDetails as $detail)
                            @if ($detail->price)
                                <option value="{{ $detail->id }}">
                                    {{ $detail->name }} • {{ format_rupiah($detail->price) }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="">
                    <button type="submit"
                        class="w-full text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Continue
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("#form-membership").submit(submitMembership);

        function submitMembership(e) {
            e.preventDefault();

            const data = $(this).serialize();
            const isLogin = @json(Auth::check());

            if (!isLogin) {
                Swal.fire({
                    icon: "warning",
                    title: 'Login Required',
                    text: 'You must login first before becoming a membership',
                    confirmButtonText: 'Login',
                    showCancelButton: true,
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/login";
                    }
                });
                return;
            }

            const plan = $("select[name=plan]").val();
            if (!plan) {
                Swal.fire({
                    icon: "error",
                    title: 'Plan Required',
                    text: 'You must select a plan first'
                });
                return;
            }

            $.ajax({
                type: "POST",
                url: "/membership",
                data: data,
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading',
                        text: 'Please wait...',
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                success: function(response) {
                    location.href = response.redirect_url;
                }
            });
        }
    </script>
@endsection
