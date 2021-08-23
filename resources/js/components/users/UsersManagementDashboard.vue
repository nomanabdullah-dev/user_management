<template>
    <div>
        <div class="card mt-3" v-if="active.dashboard">
            <div class="card-body">
                <h3>Manage Users <button class="btn btn-sm btn-outline-success float-right" @click="setActive('createUser')"><i class="fas fa-plus"></i> User</button></h3>

                <paginator
                    v-if="results !== null"
                    v-bind:results="results"
                    v-on:get-page="getPage"
                ></paginator>

                <paginator-details
                    v-if="results !== null"
                    v-bind:results="results"
                ></paginator-details>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Since</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="results != null">
                        <tr v-for="user in results.data" :key="user.id">
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.user_since }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <paginator
                    v-if="results !== null"
                    v-bind:results="results"
                    v-on:get-page="getPage"
                ></paginator>
            </div>
        </div>

        <create-user
            v-if="active.createUser"
            v-on:view-dashboard="setActive('dashboard')"
        ></create-user>
    </div>
</template>

<script>
import Paginator from '../utilities/pagination/Paginator.vue'
import PaginatorDetails from '../utilities/pagination/PaginatorDetails.vue'
import CreateUser from './CreateUser.vue'

    export default {
        components : {
            Paginator,
            PaginatorDetails,
            CreateUser
        },
        mounted() {
            this.getUsers()
        },
        data() {
            return {
                results : null,
                active: {
                    dashboard: true,
                    createUser: false
                },
                params : {
                    page : 1
                }
            }
        },
        methods: {
            getUsers: function() {
                axios.get('/data/users', {params: this.params}).then(response => {
                    this.results = response.data.results
                })
            },
            getPage: function(event) {
                this.params.page = event
                window.scrollTo(0,0)
                this.getUsers()
            },
            setActive: function(component) {
                Object.keys(this.active).forEach(key => this.active[key] = false)
                this.active[component] = true
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
