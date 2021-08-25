<template>
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3>
                    <button class="btn btn-sm btn-outline-primary mr-3" @click="$emit('view-dashboard')"><i class="fas fa-chevron-left"></i> Back</button>
                    Change User Password <small class="text-muted">{{ user.name }}</small>
                    <button class="btn btn-sm btn-outline-primary float-right" @click.prevent="sendResetLink">Send Reset Link</button>
                </h3>

                <hr>

                <div class="alert alert-warning" role="alert" v-if="errors.length > 0">
                    <ul>
                        <li v-for="error in errors" :key="error.index">{{ error }}</li>
                    </ul>
                </div>

                <form>
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
                    <button class="btn btn-primary" @click.prevent="updatePassword">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        props: ['user'],
        data() {
            return {
                data: {
                    password: '',
                    confirm_password: ''
                },
                errors: []
            }
        },
        methods: {
            updatePassword: function() {
                this.errors = []
                axios.post('/data/users/updates/password/' + this.user.id, {
                    _method: 'PUT',
                    password: this.data.password,
                    confirm_password: this.data.confirm_password
                }).then(response => {
                    this.$emit('updated-password', "Password updated successfully for " + this.user.name)
                }).catch(errors => {
                    if(errors.response.status === 422){
                        Object.keys(errors.response.data.errors).forEach(key => {
                            errors.response.data.errors[key].forEach(error => this.errors.push(error))
                        })
                    }
                    if(errors.response.status === 403){
                        this.errors.push("Not authorized to change this users password")
                    }
                })
            },
            sendResetLink: function() {
                axios.post('/data/users/updates/send-reset-link/' + this.user.id).then(response => this.$emit('sent-reset-link', 'Reset password link sent to ' + this.user.name + ' sucessfully'))
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>
