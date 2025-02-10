@extends('layouts.app')

@section('title', 'Profile Setup')

@section('content')<html lang="en">
    <head>
     <meta charset="utf-8"/>
     <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
     <title>
      Profile Setup
     </title>
     <script src="https://cdn.tailwindcss.com">
     </script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
     <style>
      body {
               font-family: 'Roboto', sans-serif;
           }
     </style>
    </head>
    <body class="bg-gradient-to-r from-purple-900 to-purple-700 min-h-screen flex items-center justify-center">
     <div class="container mx-auto p-4">
      <div class="flex flex-col lg:flex-row items-center justify-center bg-purple-800 rounded-lg shadow-lg overflow-hidden">
       <div class="w-full lg:w-1/2 p-8">
        <h1 class="text-4xl font-bold text-white mb-8">
         SET UP YOUR PROFILE
        </h1>
        <img alt="A woman in workout attire holding a water bottle and smiling" class="rounded-lg" height="400" src="https://storage.googleapis.com/a1aa/image/IQcSAgci8-yIz1gMWNr3RIjTlWxIJ1qiKrkNCqg0AVo.jpg" width="600"/>
       </div>
       <div class="w-full lg:w-1/2 p-8 bg-purple-900">
        <div class="flex items-center justify-between mb-8">
         <div class="flex items-center space-x-2">
          <div class="w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center">
           1
          </div>
          <span class="text-white">
           PROFILE
          </span>
         </div>
         <div class="flex items-center space-x-2">
          <div class="w-2 h-2 bg-white rounded-full">
          </div>
          <span class="text-white">
           MEMBERSHIP
          </span>
         </div>
         <div class="flex items-center space-x-2">
          <div class="w-2 h-2 bg-white rounded-full">
          </div>
          <span class="text-white">
           PAYMENT
          </span>
         </div>
        </div>
        <form>
         <div class="mb-4">
          <label class="block text-white mb-2">
           FIRST NAME
          </label>
          <input class="w-full p-3 bg-purple-800 text-white rounded-lg border border-purple-600 focus:outline-none focus:border-purple-500" placeholder="First Name" type="text"/>
         </div>
         <div class="mb-4">
          <label class="block text-white mb-2">
           LAST NAME
          </label>
          <input class="w-full p-3 bg-purple-800 text-white rounded-lg border border-purple-600 focus:outline-none focus:border-purple-500" placeholder="Last Name" type="text"/>
         </div>
         <div class="mb-4 relative">
          <label class="block text-white mb-2">
           DATE OF BIRTH
          </label>
          <input class="w-full p-3 bg-purple-800 text-white rounded-lg border border-purple-600 focus:outline-none focus:border-purple-500" placeholder="Date of Birth" type="text"/>
          <i class="fas fa-calendar-alt absolute right-3 top-3 text-purple-500">
          </i>
         </div>
         <div class="mb-4">
          <label class="block text-white mb-2">
           EMAIL
          </label>
          <input class="w-full p-3 bg-purple-800 text-white rounded-lg border border-purple-600 focus:outline-none focus:border-purple-500" placeholder="Email" type="email"/>
         </div>
         <div class="mb-4">
          <label class="block text-white mb-2">
           MOBILE NUMBER (EG: 08XXXXXXXXXX)
          </label>
          <div class="flex">
           <span class="inline-flex items-center px-3 bg-purple-800 text-white border border-r-0 border-purple-600 rounded-l-lg">
            +62
           </span>
           <input class="w-full p-3 bg-purple-800 text-white rounded-r-lg border border-purple-600 focus:outline-none focus:border-purple-500" placeholder="Mobile Number (eg: 08xxxxxxxxxx)" type="text"/>
          </div>
         </div>
         <div class="mb-4">
          <label class="block text-white mb-2">
           PREFERRED CLUB
          </label>
          <select class="w-full p-3 bg-purple-800 text-white rounded-lg border border-purple-600 focus:outline-none focus:border-purple-500">
           <option>
            Preferred Club
           </option>
          </select>
         </div>
         <div class="mb-4">
          <label class="inline-flex items-center text-white">
           <input class="form-checkbox text-purple-500" type="checkbox"/>
           <span class="ml-2">
            I've read and agreed to the
            <a class="underline" href="#">
             terms and conditions
            </a>
           </span>
          </label>
         </div>
         <div class="mb-4">
          <label class="inline-flex items-center text-white">
           <input class="form-checkbox text-purple-500" type="checkbox"/>
           <span class="ml-2">
            I've read and agree to the
            <a class="underline" href="#">
             declaration of health
            </a>
           </span>
          </label>
         </div>
         <div class="mb-4">
          <label class="inline-flex items-center text-white">
           <input class="form-checkbox text-purple-500" type="checkbox"/>
           <span class="ml-2">
            I'm happy to sign up for my personalised content and offers
           </span>
          </label>
         </div>
         <button class="w-full p-3 bg-teal-400 text-purple-900 font-bold rounded-lg hover:bg-teal-300 focus:outline-none" type="submit">
          CONTINUE
          <i class="fas fa-arrow-right ml-2">
          </i>
         </button>
        </form>
       </div>
      </div>
     </div>
     <div class="fixed bottom-4 right-4">
      <button class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center shadow-lg">
       <i class="fas fa-comment-dots">
       </i>
      </button>
     </div>
    </body>
   </html>   
@endsection
