<template>
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3><button class="btn btn-sm btn-outline-primary mr-3" @click="$emit('view-dashboard')"><i class="fas fa-chevron-left"></i> Back</button> Add New User</h3>
                <hr>

                <div class="alert alert-warning" role="alert" v-if="errors.length > 0">
                    <ul>
                        <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </div>

                <form>
                    <div class="form-group row">
                        <div class="col-3">
                            <label>Name</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" v-model="data.name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label>Email</label>
                        </div>
                        <div class="col-9">
                            <input type="email" class="form-control" v-model="data.email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label>Role</label>
                        </div>
                        <div class="col-9">
                            <select class="form-control" v-model="data.role">
                                <option value="'user'">User</option>
                                <option value="'admin'">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label>Password</label>
                        </div>
                        <div class="col-9">
                            <input type="password" class="form-control" v-model="data.password" placeholder="Must contain a lower and uppercase letter, a number and a special character">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label>Confirm Password</label>
                        </div>
                        <div class="col-9">
                            <input type="password" class="form-control" v-model="data.confirm_password">
                        </div>
                    </div>
                    <button class="btn btn-primary" @click.prevent="storeUser">Create User</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        data() {
            return {
                data: {
                    name : '',
                    email : '',
                    role : '',
                    password : '',
                    confirm_password : '',
                },
                errors: []
            }
        },
        methods: {
            storeUser: function() {
                this.errors = []
                axios.post('/data/users', {
                    name: this.data.name,
                    email: this.data.email,
                    role: this.data.role,
                    password: this.data.password,
                    confirm_password: this.data.confirm_password
                }).then(response => {
                    this.$emit('created-user', 'User created successfully: ' + response.data.user.name + ' | email: ' + response.data.user.email)
                }).catch(errors => {
                    if(errors.response.status === 422){
                        this.flashErrors(errors.response.data.errors)
                    }
                    if(errors.response.status === 403){
                        this.errors = ["You are not authorized to create users"]
                    }
                })
            },
            flashErrors: function(errors) {
                for(const [key, value] of Object.entries(errors)){
                    for(let item in value){
                        this.errors.push(value[item])
                    }
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
