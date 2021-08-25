<template>
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3><button class="btn btn-sm btn-outline-primary mr-3" @click="$emit('view-dashboard')"><i class="fas fa-chevron-left"></i> Back</button> Update Email <small class="text-muted">{{ user.email }}</small></h3>

                <hr>

                <div class="alert alert-warning" role="alert" v-if="errors.length > 0">
                    <ul>
                        <li v-for="error in errors" :key="error.index">{{ error }}</li>
                    </ul>
                </div>

                <form>
                    <div class="form-group row">
                        <div class="col-3">
                            <label>New Email</label>
                        </div>
                        <div class="col-9">
                            <input type="email" class="form-control" v-model="data.email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label>Enter Password to Confirm</label>
                        </div>
                        <div class="col-9">
                            <input type="password" class="form-control" v-model="data.password">
                        </div>
                    </div>
                    <button class="btn btn-primary" @click.prevent="updateEmail">Update Email</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        mounted(){
            this.data.email = this.user.email
        },
        props: ['user'],
        data() {
            return {
                data: {
                    email: '',
                    password: ''
                },
                errors: []
            }
        },
        methods: {
            updateEmail: function() {
                this.errors = []
                axios.post('/data/accounts/updates/email/'+this.user.id, {
                    _method: 'PUT',
                    email: this.data.email,
                    password: this.data.password
                }).then(response => {
                    this.$emit('updated-email', 'Successfully updated the email for ' + this.user.name)
                }).catch(errors =>{
                    console.dir(errors)
                    if(errors.response.status === 403){
                        this.errors.push("Not authorized to change the data. Please varify your password is correct.")
                    }
                    if(errors.response.status === 422) {
                        Object.keys(errors.response.data.errors).forEach(key => {
                            errors.response.data.errors[key].forEach(err => this.errors.push(err))
                        })
                    }
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
