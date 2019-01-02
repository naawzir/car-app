@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                @include ('layouts.errors')
                @include ('layouts.message')
                <div class="card">
                    <div class="card-header">Edit an Owner</div>

                    <div id="car-form" class="card-body">
                        <form method="POST" action="/owners/{{ $owner->slug }}" enctype="multipart/form-data" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
                            @csrf
                            <h3>@{{ ownerDetails }}</h3>
                            <div class="form-group row">
                                <label for="make" class="col-md-4 col-form-label text-md-right">Title</label>
                                <div class="col-md-6">
                                    <input id="make" type="text" class="form-control" name="make" value="" v-model="form.make"{{--required--}} autofocus />
                                    <span class="text-danger font-weight-bold" v-if="form.errors.has('make')" v-text="form.errors.get('make')"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="model" class="col-md-4 col-form-label text-md-right">First Nme</label>
                                <div class="col-md-6">
                                    <input id="model" type="text" class="form-control" name="model" v-model="form.model" {{--required--}} />
                                    <span class="text-danger font-weight-bold" v-if="form.errors.has('model')" v-text="form.errors.get('model')"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="registration_number" class="col-md-4 col-form-label text-md-right">Registration Number</label>
                                <div class="col-md-6">
                                    <input id="registration_number" type="text" class="form-control" name="registration_number" v-model="form.registration_number" />
                                    <span class="text-danger font-weight-bold" v-if="form.errors.has('registration_number')" v-text="form.errors.get('registration_number')"></span>
                                </div>
                            </div>

                            {{--<div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>--}}

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" v-bind:disabled="form.errors.any()">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        @php
            $make = $car->make;
            $model = $car->model;
            $registration = $car->registration_number;
            $slug = $car->slug;
        @endphp
        const makeInput = '{{ $make }}';
        const modelInput = '{{ $model }}';
        const registrationInput = '{{ $registration }}';
        const slug = '{{ $slug }}';
    </script>
    <script src="/js/form.js"></script>
    {{--<script src="/js/car.js"></script>--}}
@endpush
