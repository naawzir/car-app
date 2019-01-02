<template>
    <div class="section">
        <div>
            <h3>Hover over a car to view more information on that car...</h3>
        </div>

        <!-- left -->
        <!--<div class="row text-center text-lg-left">-->
        <div>
            <div class="row">

                <div class="col-sm-18">
                    <div class="d-block mb-4 h-100">
                        <a style="display:inline-block;" :id="`car-${++index}`"
                           target="_blank"
                           v-for="car, index in cars"
                           @mouseover="updateFeaturedCar(car)"
                           @mouseout="clearTimer"
                        >
                            <p v-text="car.make + ' ' + car.model"></p>
                            <img
                                    :src="`/img/cars/${car.image_url}`"
                                    :alt="car.make"
                                    :class="featuredCar.id === car.id ? 'not-selected' : 'selected'"
                            />
                        </a>
                    </div>
                </div>

                <!-- right -->
                <div class="col-sm-6">
                    <div>
                        <img
                                :src="`/img/cars/${featuredCar.image_url}`"
                                class=""
                                :alt="featuredCar.name"
                        />

                        <p v-text="featuredCar.make + ' ' + featuredCar.model"></p>
                        <p v-text="featuredCar.description"></p>

                        <a
                                href="/cars"
                                class="">
                            More cars
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    //const axios = require('axios');
    //import _ from 'lodash';

    export default {
        name: "Cars",
        data() {
            return {
                cars: [],
                featuredCar: {}
            };
        },
        created() {
            $.getJSON(
                '/cars/get-cars',
                cars => {
                    this.cars = cars;
                    this.featuredCar = cars[0];
                }
            );
        },
        methods: {
            updateFeaturedCar(car) {
                this.timer = setTimeout(() => {
                    this.featuredCar = car;
                }, 500);
            },
            clearTimer() {
                clearTimeout(this.timer);
            }
        }
    }
</script>

<style scoped>
    .not-selected {
        border:2px solid #6c757d;
    }
    .selected {
        border:2px solid #cbd3da;
    }
</style>