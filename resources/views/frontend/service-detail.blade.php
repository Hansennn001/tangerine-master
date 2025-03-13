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

    <div class="mt-16 lg:mt-20">
        <h1 class="text-3xl text-center text-stone-700 poppins-bold">Booking</h1>
        <form method="POST" id="form-membership" action="" class="mt-10 w-full lg:w-1/2 mx-auto space-y-5 pb-20" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <div class="">
                <select id="plan" name="plan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                    <option value="" selected>-- Choose --</option>
                    <option value="{{ $service->id }}">
                        {{ $service->name }} • {{ format_rupiah($service->price) }}
                    </option>
                </select>
            </div>

            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                    Name
                </label>
                <input type="text" id="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    placeholder="Enter your name" required>
            </div>

            <div>
                <label for="whatsapp" class="block mb-2 text-sm font-medium text-gray-900">
                    WhatsApp Number
                </label>
                <input type="text" id="whatsapp" name="whatsapp"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    placeholder="Enter your WhatsApp number" required>
            </div>


            <div class="mt-16 lg:mt-20">
                <div class="mt-10">
                    <div class="grid grid-cols-2 gap-5 mt-10">
                        <div class="">
                            <label for="date"
                                class="text-center block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Select Date
                            </label>
                            <input type="date" id="date" name="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                        </div>

                        <div class="">
                            <label for="time"
                                class="text-center block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Time
                            </label>
                            <select id="time" name="time"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                                <option value="">-- Select --</option>
                                <option value="06.00">06.00 </option>
                                <option value="07.00">07.00 </option>
                                <option value="08.00">08.00 </option>
                                <option value="09.00">09.00 </option>
                                <option value="10.00">10.00 </option>
                                <option value="11.00">11.00 </option>
                                <option value="12.00">12.00 </option>
                                <option value="13.00">13.00 </option>
                                <option value="14.00">14.00 </option>
                                <option value="15.00">15.00 </option>
                                <option value="16.00">16.00 </option>
                                <option value="17.00">17.00 </option>
                                <option value="18.00">18.00 </option>
                                <option value="19.00">19.00 </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <h1 class="text-center text-xl text-stone-500 poppins-semibold">Choose your payment method</h1>
                    <div class="grid grid-cols-2 gap-10 mt-5">
                        <!-- Bank BCA -->
                        <div>
                            <input type="radio" id="payment-method-1" name="payment_method" value="bank_transfer"
                                class="hidden peer" />
                            <label for="payment-method-1"
                                class="flex items-center w-full text-gray-500 bg-white border border-gray-200 rounded-lg overflow-hidden cursor-pointer peer-checked:border-2 peer-checked:border-stone-600 peer-checked:text-stone-600 hover:text-gray-600 hover:bg-gray-100 p-3">
                                <img src="/imgs/BCA.png" alt="BCA Logo" class="w-16 h-5 mr-5">
                                <div class="flex-grow">
                                    <h1 class="text-stone-700 poppins-medium">Bank BCA</h1>
                                    <p class="text-sm">a.n PT Advipa Grha Dwidaya</p>
                                    <div class="flex items-center mt-1">
                                        <span id="bca-account" class="text-sm">537 530 6040</span>
                                        <button type="button" onclick="copyToClipboard('bca-account')" 
                                            class="ml-2 text-stone-600 hover:text-stone-800">
                                            <i class="fa-regular fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- Bank Woori Saudara (BWS) -->
                        <div>
                            <input type="radio" id="payment-method-2" name="payment_method" value="credit_card"
                                class="hidden peer" />
                            <label for="payment-method-2"
                                class="flex items-center w-full text-gray-500 bg-white border border-gray-200 rounded-lg overflow-hidden cursor-pointer peer-checked:border-2 peer-checked:border-stone-600 peer-checked:text-stone-600 hover:text-gray-600 hover:bg-gray-100 p-3">
                                <img src="/imgs/bwslogo.png" alt="BWS Logo" class="w-16 h-7 mr-5">
                                <div class="flex-grow">
                                    <h1 class="text-stone-700 poppins-medium">Bank Woori Saudara (BWS)</h1>
                                    <p class="text-sm">a.n PT Advipa Grha Dwidaya</p>
                                    <div class="flex items-center mt-1">
                                        <span id="bws-account" class="text-sm">200 101 3184</span>
                                        <button type="button" onclick="copyToClipboard('bws-account')"
                                            class="ml-2 text-stone-600 hover:text-stone-800">
                                            <i class="fa-regular fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Payment Proof Upload -->
                <div class="mt-8">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="payment_proof">
                        Upload Payment Proof
                    </label>
                    <input type="file" id="payment_proof" name="payment_proof" accept="image/*"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        required>
                    <p class="mt-1 text-sm text-gray-500">
                        Pembayaran hanya di konfirmasi di jam kerja (Senin-Jumat, 08.00-17.00 WIB)
                    </p>
                </div>

                <div class="mt-10">
                    <button type="submit"
                        class="w-full text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-3">
                        <i class="fa-solid fa-credit-card mr-1.5"></i>
                        Submit Booking
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        function copyToClipboard(elementId) {
            const text = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(text.replace(/\s/g, '')).then(() => {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'Account number has been copied to clipboard',
                    timer: 1500,
                    showConfirmButton: false
                });
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

        $(document).ready(function() {
            $("#form-membership").submit(function(e) {
                e.preventDefault();

                const name = $("input[name='name']").val().trim();
                const whatsapp = $("input[name='whatsapp']").val().trim();
                const plan = $("select[name='plan']").val();
                const date = $("input[name='date']").val();
                const time = $("select[name='time']").val();
                const paymentMethod = $("input[name='payment_method']:checked").val();
                const paymentProof = $("#payment_proof")[0].files[0];

                if (!name) {
                    Swal.fire({
                        icon: "error",
                        title: 'Name Required',
                        text: 'Please enter your name'
                    });
                    return;
                }

                if (!whatsapp) {
                    Swal.fire({
                        icon: "error",
                        title: 'WhatsApp Number Required',
                        text: 'Please enter your WhatsApp number'
                    });
                    return;
                }

                if (!/^\d{10,15}$/.test(whatsapp)) {
                    Swal.fire({
                        icon: "error",
                        title: 'Invalid WhatsApp Number',
                        text: 'Please enter a valid WhatsApp number (10-15 digits)'
                    });
                    return;
                }

                if (!plan) {
                    Swal.fire({
                        icon: "error",
                        title: 'Plan Required',
                        text: 'You must select a plan first'
                    });
                    return;
                }

                if (!date) {
                    Swal.fire({
                        icon: "error",
                        title: 'Date Required',
                        text: 'You must select a date first'
                    });
                    return;
                }

                if (!time) {
                    Swal.fire({
                        icon: "error",
                        title: 'Time Required',
                        text: 'You must select a time first'
                    });
                    return;
                }

                if (!paymentMethod) {
                    Swal.fire({
                        icon: "error",
                        title: 'Payment Method Required',
                        text: 'You must choose a payment method first'
                    });
                    return;
                }

                if (!paymentProof) {
                    Swal.fire({
                        icon: "error",
                        title: 'Payment Proof Required',
                        text: 'Please upload your payment proof'
                    });
                    return;
                }

                const formData = new FormData(this);
                const isLogin = @json(Auth::check());

                if (!isLogin) {
                    Swal.fire({
                        icon: "warning",
                        title: 'Login Required',
                        text: 'You must login first before proceeding',
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

                $.ajax({
                    type: "POST",
                    url: "/membership",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Loading',
                            text: 'Please wait...',
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        location.href = response.redirect_url;
                    }
                });
            });
        });
    </script>
@endsection