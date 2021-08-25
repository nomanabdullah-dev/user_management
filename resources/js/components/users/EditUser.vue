<template>
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3><button class="btn btn-sm btn-outline-primary mr-3" @click="$emit('view-dashboard')"><i class="fas fa-chevron-left"></i> Back</button> Edit User <small class="text-muted">{{ user.name }}</small></h3>

                <hr>

                <div class="alert alert-warning" role="alert" v-if="errors.length > 0">
                    <ul>
                        <li v-for="error in errors" :key="error.index">{{ error }}</li>
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
                                <option :value="'user'">User</option>
                                <option :value="'admin'">Admin</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary" @click.prevent="updateUser">Update User</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        mounted(){
            this.assignUserToData()
        },
        props: ['user'],
        data() {
            return {
                data: {
                    name: '',
                    email: '',
                    role: '',
                },
                errors: []
            }
        },
        methods: {
            updateUser: function() {
                this.errors = []
                axios.post('/data/users/' + this.user.id, {
                    _method: 'PUT',
                    name: this.data.name,
                    email: this.data.email,
                    role: this.data.role
                }).then(response => {
                    this.$emit('user-updated', response.data.user.name + "'s profile has been updated")
                }).catch(errors => {
                    if(errors.response.status === 500){
                        this.errors.push("This email address may already be taken. Please try another one.")
                    }
                    if(errors.response.status === 422){
                        Object.keys(errors.response.data.errors).forEach(key => {
                            errors.response.data.errors[key].forEach(error => this.errors.push(error))
                        })
                    }
                })

            },
            assignUserToData: function() {
                Object.keys(this.data).forEach(key => this.data[key] = this.user[key]);
            }
        },
        watch: {
            user: function(){
                this.assignUserToData()
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
