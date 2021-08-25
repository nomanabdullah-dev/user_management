<template>
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3><button class="btn btn-sm btn-outline-primary mr-3" @click="$emit('view-dashboard')"><i class="fas fa-chevron-left"></i> Back</button> User Logs <small class="text-muted">{{ user.name }}</small></h3>

                <paginator v-if="results !== null" v-bind:results="results"></paginator>
                <paginator-details v-if="results !== null" v-bind:results="results"></paginator-details>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Log Type</th>
                            <th>Message</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody v-if="results !== null">
                        <tr v-for="log in results.data" :key="log.index">
                            <td>{{ log.slug }}</td>
                            <td>{{ log.message }}</td>
                            <td>{{ log.pretty_date }}</td>
                        </tr>
                    </tbody>
                </table>
                <paginator v-if="results !== null" v-bind:results="results"></paginator>
            </div>
        </div>
    </div>
</template>

<script>
import Paginator from '../../utilities/pagination/Paginator.vue'
import PaginatorDetails from '../../utilities/pagination/PaginatorDetails.vue'
    export default {
        components: {
            Paginator,
            PaginatorDetails
        },
        mounted(){
            this.getLogs()
        },
        props: ['user'],
        data() {
            return {
                results: null,
                params: {
                    page: 1
                }
            }
        },
        methods: {
            getLogs: function (){
                axios.get('data/users/logs/' + this.user.id, {params: this.params})
                    .then(response => {
                        this.results = response.data.results
                    })
            }
        }
    }
</script>

<style lang="sass" scoped>

</style>
