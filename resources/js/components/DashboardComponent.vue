<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tickets</div>

                    <div class="card-body">
                        <div  class="row">
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" type="text" placeholder="Search by Customer Name" v-model="search">
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-primary" @click="searchCustomer">Search</button>
                                <button class="btn btn-success" @click="reset">Reset</button>
                            </div>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th></th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ticket in tickets" v-bind:key="ticket.id">
                                <td>{{ticket.customer_name}}</td>
                                <td>{{ticket.email}}</td>
                                <td>{{ticket.phone_no}}</td>
                                <td v-if="ticket.status == 0" class="font-red">NEW</td>
                                <td v-else></td>
                                <td><a class="btn btn-primary" :href="'/ticket/get/'+ ticket.id">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {

        data(){
            return{
                tickets: [],
                search: ''
            }
        },
        
        mounted() {
            axios.get('/tickets')
            .then((response) => {
                this.tickets = response.data
            })

            console.log('Component mounted.')
        },

        methods:{

            searchCustomer(){
                axios.get('/ticket/' + this.search)
                .then((response) => {
                    this.tickets = response.data
                })
            },

            reset(){
                axios.get('/tickets')
                .then((response) => {
                    this.tickets = response.data
                })
            }
        }
    }
</script>
