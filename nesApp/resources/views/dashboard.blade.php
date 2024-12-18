<x-app-layout>

    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Profile</title>
        <link rel="stylesheet" href="assets/css/profile.css" />
        <style>
            .list-group-item.active {
                background: #06C167 !important;
            }

            .bg-warning {
                background: #06C167 !important;
            }

            .modal-content {
                background-color: #fefefe;
                margin: 4% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 70%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                transition: transform 0.3s ease-in-out;
                /*transform: translateY(-100%);*/
            }

            .close {
                float: right;
                text-align: right;
                font-size: 30px;
            }

            .modal-content h2 {
                text-align: center;
                margin-top: -35px;
            }

            .button_div {
                justify-content: center;
                text-align: center;
            }

            .button_div button {
                margin-right: 10px;
                background: #06C167;
                border: 1px solid #06C167;
                padding: 5px 15px;
                color: #FFFFFF;
                border-radius: 2px;
            }

            #addAddressForm input {
                padding: 5px;
            }

            .nice-select {
                padding: 0px !important;
                height: 38px !important;
                line-height: 38px !important;
            }

            .add_address_button {
                background: #06C167;
                border: 1px solid #06C167;
                padding: 5px 15px;
                color: #FFFFFF;
                border-radius: 2px;
            }

            @media (max-width: 768px) {
                .main_flex_div {
                    display: flex;
                    flex-direction: column;
                }

                .inner_flex_div {
                    min-width: 100% !important;
                }

                .modal-content {
                    padding: 10px 0px !important;
                    min-width: 95% !important;
                    height: 700px;
                    overflow: scroll;
                }

                .close {
                    margin-right: 10px;
                }
            }
            
        </style>
    </head>

    <body>
        <section class="my-5">
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Admin"
                                            class="rounded-circle p-1 bg-warning" width="110">
                                        <div class="mt-3">
                                            <h4>{{ $user->name }}</h4>
                                            @isset($customer->phone)
                                                <p class="text-secondary mb-1">+84 {{ $customer->phone }}</p>
                                            @endisset
                                            {{-- <p class="text-muted font-size-sm">Delhi, NCR</p> --}}
                                        </div>
                                    </div>
                                    <div class="list-group list-group-flush text-center mt-4">
                                        <a href="#" class="list-group-item list-group-item-action border-0 "
                                            onclick="showProfileDetails()">
                                            Profile Informaton
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action border-0"
                                            onclick="showOrderDetails()">Orders</a>

                                        <a href="#" class="list-group-item list-group-item-action border-0 active"
                                            onclick="showAddressBook()">
                                            Address Book
                                        </a>
                                        <a href="{{ route('logout') }}"
                                            class="list-group-item list-group-item-action border-0">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div id="orderDetails" class="order_card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="top-status">
                                            <h5>ORDER# 00000</h5>
                                            <ul>
                                                @foreach ($bills as $bill)
                                                    <li class="active orders"  data-bill-id="{{ $bill->id }}"  id="orders-{{ $bill->id }}">
                                                        {{-- <svg height="50" viewBox="0 0 64 64" width="50" xmlns="http://www.w3.org/2000/svg"><g id="delivery-logistic-parcel_box-shipping-send" data-name="delivery-logistic-parcel box-shipping-send"><path d="m15 23h46v38h-46z" fill="#957856"/><path d="m23 61h38v-38a38 38 0 0 1 -38 38z" fill="#806749"/><path d="m12.68 33.66a7.985 7.985 0 0 1 -5.65 2.34h-4.03v5h4.026a8 8 0 0 0 5.657-2.343l2.317-2.317v-5z" fill="#ff9478"/><path d="m30.41 48.41a1.955 1.955 0 0 1 -1.41.59h-2a2.006 2.006 0 0 1 2 2 2.015 2.015 0 0 1 -2 2h-4a2.006 2.006 0 0 1 2 2 2.015 2.015 0 0 1 -2 2h-12.79a3.993 3.993 0 0 1 -2.22-.67l-.98-.66a3.993 3.993 0 0 0 -2.22-.67h-1.79v-14h4.03a7.985 7.985 0 0 0 5.65-2.34l6.15-6.15.71.71a3 3 0 0 1 0 4.24l-2.13 2.13-1.41 1.41h10.89a2.089 2.089 0 0 1 2.05 1.51 2.011 2.011 0 0 1 -1.94 2.49h1.89a2.089 2.089 0 0 1 2.05 1.51 1.962 1.962 0 0 1 -.53 1.9z" fill="#ffbcab"/><path d="m61 23h-46l6-10h34z" fill="#a78966"/><path d="m44 23h-12l2-10h8z" fill="#ffda44"/><path d="m32 23h12v12h-12z" fill="#ffcd00"/><circle cx="53" cy="11" fill="#7ed63e" r="8"/><g fill="#231f20"><path d="m58.99 17.7a8.995 8.995 0 1 0 -14.99-6.7 8.262 8.262 0 0 0 .06 1h-23.06a.99.99 0 0 0 -.86.49l-6 10a1 1 0 0 0 -.14.51v7.93l-2.03 2.02a6.936 6.936 0 0 1 -4.94 2.05h-4.03a1 1 0 0 0 -1 1v19a1 1 0 0 0 1 1h1.79a2.97 2.97 0 0 1 1.66.5l.99.66a4.959 4.959 0 0 0 2.77.84h3.79v3a1 1 0 0 0 1 1h46a1 1 0 0 0 1-1v-38a1 1 0 0 0 -.14-.51zm-5.99-13.7a7 7 0 1 1 -7 7 7.008 7.008 0 0 1 7-7zm-8.47 10a8.978 8.978 0 0 0 12.83 4.87l1.87 3.13h-14.41l-1.6-8zm-9.71 0h6.36l1.6 8h-9.56zm-1.82 10h10v10h-10zm-11.43-10h11.21l-1.6 8h-14.41zm-17.57 23h3.03a8.974 8.974 0 0 0 6.36-2.63l.61-.62v2.18l-2.02 2.02a6.977 6.977 0 0 1 -4.95 2.05h-3.03zm6.21 19a2.97 2.97 0 0 1 -1.66-.5l-.99-.66a4.959 4.959 0 0 0 -2.77-.84h-.79v-12h3.03a8.942 8.942 0 0 0 6.36-2.64l2.32-2.31 3.12-3.12a1.98 1.98 0 0 1 0 2.82l-3.54 3.54a1 1 0 0 0 -.21 1.09.987.987 0 0 0 .92.62h10.89a1.1 1.1 0 0 1 1.08.75.962.962 0 0 1 -.28.96.928.928 0 0 1 -.69.29h-8a1 1 0 0 0 0 2h9.89a1.1 1.1 0 0 1 1.08.75.962.962 0 0 1 -.28.96.928.928 0 0 1 -.69.29h-10a1 1 0 0 0 0 2h8a1 1 0 0 1 1 1 .949.949 0 0 1 -.31.71.928.928 0 0 1 -.69.29h-8a1 1 0 0 0 0 2h4a1 1 0 0 1 1 1 .949.949 0 0 1 -.31.71.928.928 0 0 1 -.69.29zm49.79 4h-44v-2h7a3 3 0 0 0 3-3 3 3 0 0 0 -.17-1h1.17a3 3 0 0 0 3-3 2.873 2.873 0 0 0 -.21-1.1 3.009 3.009 0 0 0 2.11-3.64 3.015 3.015 0 0 0 -2.12-2.14 2.876 2.876 0 0 0 .12-1.86 3.053 3.053 0 0 0 -3.01-2.26h-8.48l1.84-1.83a4.008 4.008 0 0 0 0-5.66l-.71-.71a1.014 1.014 0 0 0 -1.42 0l-2.12 2.13v-9.93h15v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-11h15z"/><path d="m52.707 42.293a1 1 0 0 0 -1.414 0l-3 3a1 1 0 0 0 1.414 1.414l1.293-1.293v9.586a1 1 0 0 0 2 0v-9.586l1.293 1.293a1 1 0 0 0 1.414-1.414z"/><path d="m51.293 13.707a1 1 0 0 0 1.414 0l4.243-4.243a1 1 0 0 0 -1.414-1.414l-3.536 3.536-1.414-1.414a1 1 0 0 0 -1.414 1.414z"/></g></g></svg>

                                                        <svg id="Layer_1" enable-background="new 0 0 512 512" height="50" viewBox="0 0 512 512" width="50" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill-rule="evenodd"><path d="m282.35 231.57h210.61c4.42 0 8.04 3.62 8.04 8.04v184.77c0 4.42-3.62 8.04-8.04 8.04h-210.61c-4.42 0-8.04-3.62-8.04-8.04v-184.77c0-4.42 3.62-8.04 8.04-8.04z" fill="#fcd770"/><path d="m423.31 230.95v77.74l-35.66-23.5-35.65 23.5v-77.74z" fill="#fc6e51"/><path d="m272.08 409.53-109.97 24.31c-3.7.82-7.24-.58-9.38-3.71l-24.2-35.42-25.23-59.61c-.43-1.02-1.61-1.49-2.63-1.06-1.01.43-1.48 1.61-1.06 2.62l24.6 58.08-89.58 45.76-20.86-114.26c-1.14-6.26-.48-12.66 2.13-18.48s6.96-10.57 12.39-13.88l58.56-35.68 30.67 42.67c.38.53.99.83 1.63.83.31 0 .61-.07.89-.21l42.09-21.06 26.91 46.85c.36.62 1.01 1 1.73 1 .09 0 .18-.01.27-.02.81-.11 1.47-.69 1.67-1.48l12.27-48.06 29.15 22.57c.35.27.78.42 1.22.42.24 0 .48-.05.71-.13.64-.24 1.12-.8 1.26-1.48l9.86-48.92 24.9 17.26z" fill="#fc6e51"/><path d="m214.71 240.74 28.49 9.97-9.16 45.45-27.96-21.65zm-94.93 56.42-29.49-41.05 31.45-19.15 37.14 40.63z" fill="#fcd770"/><g fill="#f0d0b4"><path d="m201.75 275.27-11.68 45.75-23.46-40.83c-.07-.13-.16-.25-.26-.36l-41.94-45.89 11.08-29.58 3.85 1.65c7.74 3.32 15.99 4.88 24.39 4.88.61 0 1.21-.01 1.82-.02 3.92-.1 7.76-.37 11.62-1.07 5.22-.96 10.3-2.59 15.1-4.86l4.71-2.23.94 5.12c.02.13.06.27.12.39l13.16 30.07-9.44 36.95z"/><path d="m176.44 205.87c-3.65.67-7.3.91-11.01 1.01-19.47.52-36.73-8-48.15-23.77-12.21-16.85-20.76-38.44-27.26-58.09l-1.74-5.26h74.07c12.96 0 24.41-4.98 33.25-14.46l24.97-26.78 1.6 7.5c4.98 23.31 5.28 46.39 1.3 69.89l-.02.1-.02.1c-1.01 4.5-2.28 8.97-3.9 13.3-7.1 19-23.1 32.8-43.09 36.46zm10.97-39.19c-8.39 11.17-23.53 12.02-35.35 6-.99-.5-2.19-.12-2.69.87-.5.98-.12 2.19.86 2.69 5.21 2.66 10.97 4.2 16.84 4.2 9.28 0 17.91-3.87 23.53-11.35.66-.88.49-2.13-.4-2.8-.88-.67-2.13-.49-2.79.39z"/><path d="m88 131.51c2.7 7.81 5.66 15.55 8.98 23.12l1.94 4.42-4.7 1.08c-8.26 1.9-17.08-2.18-20.05-10.31-1.54-4.23-1.22-8.81.77-12.84 1.61-3.26 4.18-5.91 7.35-7.68l4.17-2.31z"/></g><path d="m86.03 112.29c-4.84-18.01-6.46-38.19.8-55.79 6.81-16.49 20.04-27.29 36.77-33.04 16.22-5.58 35.01-5.96 51.53-1.54 13.74 3.68 29.05 11.75 34.81 25.56 2.09 5 4.01 10.06 5.75 15.19l1.79 5.29h-26.72c-14.77 0-27.68 6.5-36.49 18.36l-21.87 29.45h-46.37z" fill="#fc6e51"/><path d="m157.49 88.7c8.1-10.91 19.69-16.74 33.28-16.74h30.44l-28.53 30.61c-8.12 8.72-18.41 13.19-30.33 13.19h-24.95zm65.37-16.74h14.47c12.95 0 24.19 5.38 32.31 15.47l7.04 8.76c1.12 1.42 1.42 3.12.88 4.81-.52 1.72-1.76 2.95-3.52 3.46l-43.86 12.87-.31-5c-.75-11.96-2.7-23.77-5.71-35.37z" fill="#fcd770"/><path d="m162.98 437.75 164.83-36.44c3.32-.73 6.46-.03 9.15 2.06 2.7 2.1 4.19 4.96 4.27 8.39l.02.68c.17 4.75-2.57 9.64-7.44 10.8l-53.35 12.67c-1.01.24-1.66 1.18-1.52 2.21.14 1.01 1.03 1.77 2.05 1.73l95.5-3.33 4.63-.02.3.05c2.3.34 4.27 1.37 5.94 2.99 2.26 2.2 3.38 4.87 3.35 8.01v.22c-.06 5.71-4.35 10.47-10.08 10.88l-83.1 5.96c-21.63 1.55-42.98 5.14-64.1 10.03-19.96 4.62-39.6 10.37-59.18 16.37-5.69 1.74-10.86 1.89-16.74 2.01-.81.02-1.61.04-2.42.06-13.15.36-23.35-6.49-33.22-14.41l-59.6-47.78 63.88-32.62 23.31 34.13c3.05 4.5 8.19 6.53 13.52 5.35z" fill="#f0d0b4"/><path d="m466.84 392.66h-74.25c-3.31 0-6 2.68-6 5.99 0 3.32 2.69 6 6 6h74.25c3.31 0 6-2.68 6-6 0-3.3-2.69-5.99-6-5.99zm0-29.93h-53.19c-3.31 0-6 2.69-6 6s2.69 6 6 6h53.19c3.31 0 6-2.69 6-6s-2.69-6-6-6zm27.93 63.18c0 1.1-.95 2.04-2.07 2.04l-111.44.55c-.77-.06-1.54-.1-2.33-.07l-39.89 1.39c6.39-3.03 10.45-9.84 10.2-17.66l-.03-.7c-.19-5.76-2.8-10.88-7.35-14.41s-10.15-4.8-15.78-3.55l-46 10.17v-122.82h65.69v29.98c0 2.21 1.21 4.24 3.16 5.29 1.94 1.04 4.3.94 6.14-.27l32.36-21.33 32.35 21.33c1 .66 2.15.99 3.3.99.98 0 1.96-.23 2.85-.71 1.94-1.05 3.15-3.08 3.15-5.29v-29.98h65.69zm-113.96 14.59c1.43.21 2.64.83 3.74 1.9 1.48 1.44 2.16 3.06 2.14 5.12v.2c-.04 3.7-2.78 6.68-6.37 6.94l-83.1 5.96c-45.11 3.23-86.07 14.9-124.16 26.57-5.29 1.62-9.86 1.72-15.65 1.83-.8.02-1.61.04-2.45.06-11.08.31-19.93-4.97-30.61-13.53l-54.77-43.91 55.23-28.21 21.32 31.22c4 5.85 10.78 8.54 17.71 7.01l164.83-36.44c2.17-.48 4.08-.05 5.83 1.31 1.76 1.36 2.65 3.1 2.72 5.32l.02.7c.1 2.84-1.38 6.08-4.37 6.79l-53.35 12.67c-3.01.71-4.98 3.58-4.56 6.64.41 3.05 3.09 5.32 6.15 5.19l95.44-3.32zm-261.73-47.62-23.15-54.66c-1.29-3.05.13-6.57 3.18-7.86 3.06-1.29 6.58.13 7.87 3.18l25.09 59.25 23.97 35.09c1.21 1.78 3.11 2.53 5.21 2.06l106.83-23.62v-135.78l-18.18-12.6-8.66 42.96c-.41 2.03-1.84 3.71-3.78 4.43-.68.25-1.39.38-2.1.38-1.31 0-2.6-.43-3.67-1.26l-24.33-18.84-10.76 42.15c-.61 2.37-2.59 4.13-5.01 4.46-.27.04-.54.06-.81.06-2.13 0-4.12-1.13-5.2-3.01l-25.03-43.57-38.71 19.37c-.86.43-1.77.64-2.68.64-1.88 0-3.72-.88-4.88-2.5l-28.5-39.66-55.4 33.75c-9.89 6.02-14.74 16.84-12.67 28.23l19.89 108.97zm-23.02-135.6 24.95-15.19 31.35 34.3-31.32 15.67zm41.7-47.59c7.98 3.42 16.71 5.21 25.97 5.21.63 0 1.27-.01 1.92-.02 3.47-.09 7.64-.29 12.24-1.14 5.66-1.04 11.05-2.79 16.09-5.18.08.43.21.86.39 1.27l12.61 28.81-8.96 35.07c-.01.02-.01.04-.02.06l-9.37 36.71-18.55-32.29c-.22-.38-.48-.74-.78-1.06l-40.29-44.08zm27.57-6.81c3.01-.08 6.61-.25 10.39-.94 18.41-3.38 33.39-16.06 40.07-33.92 1.48-3.96 2.73-8.26 3.74-12.77 3.95-23.34 3.58-45.7-1.27-68.39l-19.74 21.17c-9.59 10.29-22.1 15.73-36.17 15.73h-68.53c8.24 24.9 17.02 43.63 26.7 57 10.69 14.74 26.61 22.6 44.81 22.12zm-72.02-46.64c-3.12-7.13-6.15-14.91-9.09-23.42-2.48 1.38-4.47 3.43-5.71 5.95-1.54 3.11-1.75 6.55-.6 9.69 2.21 6.05 8.88 9.28 15.4 7.78zm97.46-80.28h21.24l-22.26 23.88c-7.37 7.91-16.59 11.92-27.4 11.92h-17l15.35-20.68c7.35-9.89 17.75-15.12 30.07-15.12zm-100.75 35.77c-11.49-42.12 1.22-72.91 34.88-84.48 31.88-10.97 72.18-.18 81.35 21.78 2.09 5.02 3.98 9.99 5.66 14.93h-21.14c-16.04 0-30.14 7.09-39.7 19.97l-20.67 27.83h-40.37c0-.01-.01-.02-.01-.03zm138.01-35.77c3.14 12.11 5.07 24.09 5.83 36.13l39.05-11.46c.47-.14.69-.35.83-.82.15-.47.09-.77-.21-1.15l-7.01-8.72c-7.36-9.15-17.45-13.98-29.19-13.98zm-17.43 196.99 6.9-26.99 21.09 7.38-7.2 35.71zm69.48-31.81v27.71h65.69v-29.76h-63.65c-1.1 0-2.04.94-2.04 2.05zm77.69 58.55 26.35-17.37c2.01-1.32 4.61-1.32 6.61 0l26.35 17.37v-60.59h-59.31zm134.96-60.6h-63.65v29.76h65.69v-27.71c0-1.11-.93-2.05-2.04-2.05zm14.04 2.05v184.77c0 7.7-6.28 14-14.01 14.04l-95.39.47c.89 2.24 1.35 4.66 1.32 7.22v.2c-.1 10-7.63 18.08-17.52 18.79l-83.1 5.96c-43.85 3.14-84.06 14.6-121.49 26.07-6.89 2.11-12.74 2.23-18.92 2.36-.78.02-1.58.03-2.39.05-.38.01-.77.02-1.15.02-15.76 0-27.49-8.33-37.28-16.18l-58.98-47.28-15.05 7.68c-3.35 1.72-7.21 1.74-10.59.07-3.37-1.66-5.7-4.75-6.37-8.45l-19.94-109.25c-2.99-16.39 3.99-31.96 18.22-40.63l93.09-56.7 9.41-25.15c.17-.45.4-.87.66-1.25-6.22-4.23-11.77-9.64-16.49-16.15-4.28-5.91-8.38-12.76-12.32-20.57-2.77.93-5.58 1.39-8.34 1.39-10.3 0-19.87-6.12-23.5-16.03-2.28-6.25-1.89-13.04 1.1-19.12 2.67-5.41 7.13-9.66 12.68-12.14-.17-.53-.33-1.07-.5-1.61-.04-.12-.08-.24-.11-.36-.44-1.4-.87-2.8-1.3-4.23-.02-.05-.03-.1-.05-.15-7.12-26.04-6.11-48.28 3-66.12 7.85-15.36 21.52-26.76 39.53-32.95 17.64-6.06 38.34-6.63 56.81-1.56 19.36 5.32 33.77 16.28 39.52 30.06 2.75 6.59 5.15 13.1 7.23 19.55h12.78c15.5 0 28.82 6.38 38.54 18.46l7.01 8.72c2.82 3.5 3.66 7.97 2.31 12.26-1.34 4.29-4.58 7.47-8.9 8.74l-42.06 12.35c-.04 10.84-1 21.77-2.9 32.92-.01.1-.03.19-.05.29-1.13 5.11-2.56 9.99-4.25 14.52-4.73 12.66-12.89 23.19-23.31 30.62.69.58 1.26 1.31 1.65 2.19l12.38 28.31 34.98 12.22c.51.18 1 .43 1.44.73l13.91 9.65v-14.8c0-7.74 6.3-14.04 14.04-14.04h210.61c7.74 0 14.04 6.29 14.04 14.04zm-339.7-56.7c-6.14 0-12.53-1.51-18.66-4.63-2.95-1.51-4.12-5.12-2.61-8.07 1.5-2.95 5.11-4.13 8.07-2.62 11.37 5.8 23.84 3.81 30.34-4.83 1.99-2.65 5.75-3.18 8.4-1.19s3.18 5.75 1.19 8.4c-6.36 8.46-16.16 12.94-26.73 12.94z" fill="#222124"/></g></svg> --}}

                                                        @if ($bill->orders->every(fn($order) => $order->status === 'pending'))
                                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1"
                                                                data-name="Layer 1" viewBox="0 0 512 512" width="50"
                                                                height="50">
                                                                <title> Clock Delivery package </title>
                                                                <path
                                                                    d="M316.96,424.4A96,96,0,1,1,400,472.22,95.391,95.391,0,0,1,316.96,424.4Z"
                                                                    style="fill:#6fe3ff" />
                                                                <path
                                                                    d="M400,135.55V280.22A96.008,96.008,0,0,0,316.96,424.4L208,487.3V246.38L399.98,135.54Z"
                                                                    style="fill:#c16752" />
                                                                <polygon
                                                                    points="208 246.38 141.14 207.78 333.13 96.94 399.98 135.54 208 246.38"
                                                                    style="fill:#e48e66" />
                                                                <polygon
                                                                    points="333.13 96.94 141.14 207.78 92.21 179.53 284.19 68.69 333.13 96.94"
                                                                    style="fill:#e5d45a" />
                                                                <polygon
                                                                    points="208 24.7 284.19 68.69 92.21 179.53 92.2 179.53 16.02 135.54 208 24.7"
                                                                    style="fill:#af593c" />
                                                                <polygon
                                                                    points="208 246.38 208 487.3 16 376.45 16 135.55 16.02 135.54 92.2 179.53 92.2 339.28 115.45 329.68 140.8 358.48 140.8 207.98 141.14 207.78 208 246.38"
                                                                    style="fill:#e48e66" />
                                                                <polygon
                                                                    points="141.14 207.78 140.8 207.98 140.8 358.48 115.45 329.68 92.2 339.28 92.2 179.53 92.21 179.53 141.14 207.78"
                                                                    style="fill:#f8ec7d" />
                                                                <path
                                                                    d="M284.75,269.594l-17.9-18.959a7,7,0,0,0-11.256,1.49l-16.9,31.44a7,7,0,0,0,6.16,10.316,7.185,7.185,0,0,0,6.292-3.687L255,283.247V343.42a7,7,0,1,0,14,0V273.051l5.69,6.154a6.927,6.927,0,0,0,9.835.285A7,7,0,0,0,284.75,269.594Z"
                                                                    style="fill:#6fe3ff" />
                                                                <path
                                                                    d="M40.83,378.37a7,7,0,0,1-7-7V345.45a7,7,0,0,1,14,0v25.92A7,7,0,0,1,40.83,378.37Z"
                                                                    style="fill:#f8ec7d" />
                                                                <path
                                                                    d="M69.25,395a7,7,0,0,1-7-7V364.65a7,7,0,0,1,14,0V388A7,7,0,0,1,69.25,395Z"
                                                                    style="fill:#f8ec7d" />
                                                                <path
                                                                    d="M97.68,411.41a7,7,0,0,1-7-7V383.85a7,7,0,0,1,14,0v20.56A7,7,0,0,1,97.68,411.41Z"
                                                                    style="fill:#f8ec7d" />
                                                                <path
                                                                    d="M126.1,427.82a7,7,0,0,1-7-7V403.05a7,7,0,0,1,14,0v17.77A7,7,0,0,1,126.1,427.82Z"
                                                                    style="fill:#f8ec7d" />
                                                                <path
                                                                    d="M154.52,444.61a7,7,0,0,1-7-7V422.25a7,7,0,0,1,14,0v15.36A7,7,0,0,1,154.52,444.61Z"
                                                                    style="fill:#f8ec7d" />
                                                                <path
                                                                    d="M247.777,384.941a7,7,0,0,1-3.507-13.064l31.89-18.41a7,7,0,0,1,7,12.125L251.27,384A6.964,6.964,0,0,1,247.777,384.941Z"
                                                                    style="fill:#f8ec7d" />
                                                                <path
                                                                    d="M432.039,413.22a6.975,6.975,0,0,1-4.783-1.89l-32.04-30A7,7,0,0,1,393,376.22V313.97a7,7,0,0,1,14,0v59.215l29.824,27.925a7,7,0,0,1-4.785,12.11Z"
                                                                    style="fill:#2561a1" />
                                                            </svg>
                                                        @endif
                                                        <table class="orders" data-bill-id="{{ $bill->id }}"
                                                            id="orders-{{ $bill->id }}" style="display:none;">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Description</th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Size</th>
                                                                    <th scope="col">Quantity</th>
                                                                    <th scope="col">Amount</th>
                                                                    <th scope="col">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($bill->orders as $order)
                                                                    <tr>
                                                                        <th>
                                                                            <img src="{{ asset($order->product->image) }}"
                                                                                alt="product" class="" width="80">
                                                                        </th>
                                                                        <td>{{ $order->product->name }}</td>
                                                                        <td>{{ $order->size }}</td>
                                                                        <td style="  font-size: clamp(10px, 5vw, 14px);">${{ $order->product->price }} x
                                                                            {{ $order->quantity }}</td>
                                                                        <td>${{ number_format($order->product->price * $order->quantity, 2) }}
                                                                        </td>
                                                                        <td><span class="badge badge-warning">{{ $order->status }}</span></td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <th colspan="3">
                                                                        <span>Status:</span>
                                                                        <span class="badge badge-success">PAID</span>
                                                                    </th>
                                                                    <td>
                                                                        <span class="text-muted">Total Price</span>
                                                                        <strong>{{ $bill->total }}</strong>
                                                                    </td>
                                                                    <td>
                                                                        <span class="text-muted">Giảm</span><br>
                                                                        <strong style="color: #06C167">- ${{ $bill->discount_amount }}</strong>
                                                                    </td>
                                                                    <td>
                                                                        <span class="text-muted">Total Paid</span>
                                                                        <strong>{{ $bill->discount_total }}</strong>
                                                                    </td>
                
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <span>Đang xử lý{{ $bill->discount_total }}</span>

                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-body p-0 table-responsive">
                                        <h4 class="p-3 mb-0">Product Description</h4>
                                        <table class="table mb-0 cthd">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <tr>
                                                    <th colspan="3">
                                                        <span>Status:</span>
                                                        <span class="badge badge-success">PAID</span>
                                                    </th>
                                                    <td>
                                                        <span class="text-muted">Total Price</span>
                                                        <strong>$0</strong>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">Total Paid</span>
                                                        <strong>$0</strong>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h4>Timeline</h4>
                                        <ul class="timeline">
                                            <li class="active">
                                                <h6>PICKED</h6>
                                                <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Quisque Lorem ipsum dolor</p>
                                                <o class="text-muted">21 March, 2014</o>
                                                </p>
                                            </li>
                                            <li>
                                                <h6>PICKED</h6>
                                                <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Quisque</p>
                                                <o class="text-muted">21 March, 2014</o>
                                                </p>
                                            </li>
                                            <li>
                                                <h6>PICKED</h6>
                                                <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Quisque</p>
                                                <o class="text-muted">21 March, 2014</o>
                                                </p>
                                            </li>
                                            <li>
                                                <h6>PICKED</h6>
                                                <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Quisque</p>
                                                <o class="text-muted">21 March, 2014</o>
                                                </p>
                                            </li>
                                            <li>
                                                <h6>PICKED</h6>
                                                <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Quisque</p>
                                                <o class="text-muted">21 March, 2014</o>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div id="profileDetails" class="card" style="display: none;">
                                <div class="card-body">
                                    <div class="profile-info">
                                        <h5>Profile Information</h5>
                                        @isset($customer->fullname)
                                            <p class=""><strong>Họ và tên:</strong> {{ $customer->fullname }}</p>
                                        @endisset
                                        <p><strong>Địa chỉ Email:</strong> {{ $user->email }}</p>
                                        @isset($customer->phone)
                                            <p class=""><strong>Số điện thoại:</strong> {{ $customer->phone }}</p>
                                        @endisset
                                        @isset($customer->birth)
                                            <p><strong>Sinh nhật:</strong>
                                                {{ \Carbon\Carbon::parse($customer->birth)->format('d/m/Y') }}</p>
                                        @endisset
                                        @isset($customer->address)
                                            <p class=""><strong>Địa chỉ:</strong> {{ $customer->address }}</p>
                                        @endisset
                                        <form action="{{ route('customer.store') }}" method="POST">
                                            @csrf
                                            <div>
                                                <label for="fullname">Fullname: </label>
                                                <input type="text" id="fullname" class="nes-input"
                                                    name="fullname"
                                                    value="{{ old('fullname', $customer ? $customer->fullname : '') }}"
                                                    required>
                                            </div>
                                            <div>
                                                <label for="birth">Date of birth: </label>
                                                <input type="date" id="birth" class="nes-input"
                                                    name="birth"
                                                    value="{{ old('birth', $customer ? $customer->birth : '') }}"
                                                    placeholder="mm-dd-yyyy" min="1997-01-01" max="2030-12-31">
                                            </div>
                                            <div>
                                                <label for="phone">Phone number:</label>
                                                <input type="text" id="phone" class="nes-input"
                                                    name="phone"
                                                    value="{{ old('phone', $customer ? $customer->phone : '') }}">
                                            </div>
                                            <div>
                                                <label for="address">Addrress:</label>
                                                <input type="text" id="address" class="nes-input"
                                                    name="address"
                                                    value="{{ old('address', $customer ? $customer->address : '') }}">
                                            </div>
                                            <br>
                                            <div style="display: flex; justify-content: center; gap: 10px;">
                                                <button type="submit" class="nes-btn is-primary">Save</button>
                                        </form>
                                    </div>
                                    <div>
                                        <h1>Thay đổi mật khẩu</h1>
                                        @include('profile.partials.update-password-form')
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div id="addressBook" class="card" style="display: none;">
                                <div class="card-body">
                                    <h5>Address Book</h5>
                                    @foreach ($receivers as $receiver)
                                        <input style="width:10px;" type="radio" name="receiver" class="rec-radio" data-name="{{ $receiver->fullname }}" data-phone="{{ $receiver->phone }}" data-address="{{ $receiver->address }}">{{ $receiver->fullname }} - {{ $receiver->address }} - {{ $receiver->phone }}
                                    @endforeach
                                    <button class="add_address_button" onclick="showAddAddressModal()">Add
                                        Address</button>

                                    <div id="addressList">

                                    </div>
                                </div>
                            </div>
                        </div>
                

                            <div id="addAddressModal" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeAddAddressModal()">&times;</span>
                                    <h2>Add Address</h2>
                                    <form id="addAddressForm" onsubmit="saveAddress(event)">

                                        <div class="col-12 d-flex main_flex_div">
                                            <div class="col-4 d-flex flex-column inner_flex_div">
                                                <label for="name">Name:</label>
                                                <input type="text" id="name" required><br>
                                            </div>
                                            <div class="col-4 d-flex flex-column inner_flex_div">
                                                <label for="mobile">Mobile No.:</label>
                                                <input type="tel" id="mobile" required pattern="[0-9]{10}">
                                            </div>
                                            <div class="col-4 d-flex flex-column inner_flex_div">
                                                <label for="pincode">Pin code:</label>
                                                <input type="text" id="pincode" required><br>

                                            </div>
                                        </div>


                                        <div class="col-12 d-flex main_flex_div">

                                            <div class="col-4 d-flex flex-column inner_flex_div">
                                                <label for="locality">Locality:</label>
                                                <input type="text" id="locality" required><br>
                                            </div>

                                            <div class="col-4 d-flex flex-column inner_flex_div">
                                                <label for="city">City/District/Town:</label>
                                                <input type="text" id="city" required><br>

                                            </div>

                                            <div class="col-4 d-flex flex-column inner_flex_div">
                                                <label for="state">State:</label>
                                                <select id="state" required>
                                                    <option value="">Select a state</option>
                                                    <option value="State 1">State 1</option>
                                                    <option value="State 2">State 2</option>
                                                    <option value="State 3">State 3</option>
                                                </select><br>
                                            </div>

                                        </div>

                                        <div class="col-12 d-flex main_flex_div">
                                            <div class="col-12 d-flex flex-column inner_flex_div">
                                                <label for="address">Address:</label>
                                                <textarea id="address" required></textarea><br>
                                            </div>

                                        </div>


                                        <div class="col-12 d-flex main_flex_div">
                                            <div class="col-6 d-flex flex-column inner_flex_div">
                                                <label for="landmark">Landmark (Optional):</label>
                                                <input type="text" id="landmark"><br>

                                            </div>
                                            <div class="col-6 d-flex flex-column inner_flex_div">
                                                <label for="alternatePhone">Alternate Phone (Optional):</label>
                                                <input type="tel" id="alternatePhone" pattern="[0-9]{10}"><br>
                                            </div>


                                        </div>

                                        <div class="col-12 d-flex button_div">
                                            <button type="submit">Save</button>
                                            <button type="button" onclick="closeAddAddressModal()">Cancel</button>
                                        </div>


                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

        <script>
            $(document).ready(function() {
                $('.orders').click(function() {
                    let billId = $(this).data('bill-id');
                    let ordersTable = $(`#orders-${billId}`);
                    $('.cthd tbody').html(ordersTable.find('tbody').html());
                    $('html, body').animate({
                        scrollTop: $("#displayTable").offset().top
                    }, 500);

                    // alert(billId);
                });
            });

            function showAddAddressModal() {
                const modal = document.getElementById('addAddressModal');
                modal.style.display = 'block';
                isFormVisible = true;
            }

            function closeAddAddressModal() {
                const modal = document.getElementById('addAddressModal');
                modal.style.display = 'none';
                isFormVisible = false;
            }

            function showProfileDetails() {
                hideAllSections();
                document.getElementById('profileDetails').style.display = 'block';
                setActiveLink(0);
            }

            function showOrderDetails() {
                hideAllSections();
                document.getElementById('orderDetails').style.display = 'block';
                setActiveLink(1);
            }

            function showAddressBook() {
                hideAllSections();
                document.getElementById('addressBook').style.display = 'block';
                setActiveLink(2);
            }

            function hideAllSections() {
                document.getElementById('orderDetails').style.display = 'none';
                document.getElementById('profileDetails').style.display = 'none';
                document.getElementById('addressBook').style.display = 'none';
            }

            function setActiveLink(index) {
                document.querySelector('.list-group-item.active').classList.remove('active');
                document.querySelectorAll('.list-group-item')[index].classList.add('active');
            }

            showProfileDetails();
        </script>

    </body>

    </html>

</x-app-layout>
