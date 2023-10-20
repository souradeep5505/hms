@extends('admin.resource.from-main')
@section('title', 'Dashboard')
@section('content')
<style>
    #multistep {
        background-color: #111;
    }

    #steps,
    .v-alert {
        border-radius: 3px !important;
    }

    label {
        animation: none !important;
    }
</style>
<div id="app">
    <v-app id="multistep">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm6>
                        <v-card id="steps" class="animated fadeIn">
                            <v-stepper v-model="step">
                                <!-- Stepper steps -->
                                <v-stepper-header>
                                    <v-stepper-step :complete="step > 1" step="1" color="teal accent-4">Details</v-stepper-step>
                                    <v-divider></v-divider>
                                    <v-stepper-step :complete="step > 2" step="2" color="teal accent-4">Attributes</v-stepper-step>
                                    <v-divider></v-divider>
                                    <v-stepper-step :complete="step > 3" step="3" color="teal accent-4">Health</v-stepper-step>
                                    <v-divider></v-divider>
                                    <v-stepper-step :complete="submitted" step="4" color="teal accent-4">Result</v-stepper-step>
                                </v-stepper-header>
                            </v-stepper>

                            <v-toolbar class="teal accent-2">
                                <v-toolbar-title>
                                    <h3 v-if="step === 1">Personal Details</h3>
                                    <h3 v-if="step === 2">Attributes</h3>
                                    <h3 v-if="step === 3">Health</h3>
                                    <h3 v-if="step === 4">Result</h3>
                                </v-toolbar-title>
                            </v-toolbar>

                            <v-card-text>
                                <v-form @submit.prevent="validateBeforeSubmit">
                                    <!-- Step 1: Details -->
                                    <div v-if="step === 1" class="animated fadeIn">
                                        <!-- Details form fields -->
                                    </div>

                                    <!-- Step 2: Attributes -->
                                    <div v-if="step === 2" class="animated fadeIn">
                                        <!-- Attributes form fields -->
                                    </div>

                                    <!-- Step 3: Health -->
                                    <div v-if="step === 3" class="animated fadeIn">
                                        <!-- Health form fields -->
                                    </div>

                                    <!-- Step 4: Result -->
                                    <div v-if="step === 4" class="animated fadeIn">
                                        <!-- Result form fields -->
                                    </div>
                                </v-form>
                            </v-card-text>

                            <!-- Actions: Previous, Next, Submit -->
                            <v-card-actions>
                                <v-layout justify-center>
                                    <v-btn class="teal accent-2" @click.prevent="prev()" v-if="step > 1">Prev</v-btn>
                                    <v-btn class="teal accent-2" @click.prevent="next()" v-if="step < 4">Next</v-btn>
                                    <v-btn dark class="teal accent-5" type="submit" v-if="step === 4">Submit</v-btn>
                                </v-layout>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>
</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vee-validate@3.4.5/dist/vee-validate.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    Vue.use(VeeValidate);

    new Vue({
        el: "#app",
        data: () => ({
            step: 1,
            details: {
                // Details data
            },
            attributes: {
                // Attributes data
            },
            health: {
                // Health data
            },
            email: null,
            submitted: false,
            message: null
        }),
        computed: {
            countries() {
                return countries;
            }
        },
        methods: {
            // Your methods
        }
    });
</script>
@endsection
