<template>
    <div>
        <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"
                v-if="results.current_page > 2"
                @click.prevent="$emit('get-page', 1)">
                <a class="page-link" href="#">
                    <i class="fas fa-chevron-left"></i>
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
            <li class="page-item"
                v-if="results.current_page > 1"
                @click.prevent="$emit('get-page', results.current_page - 1)">
                <a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a>
            </li>
            <li class="page-item"
                v-if="results.current_page < results.last_page"
                @click.prevent="$emit('get-page', results.current_page + 1)">
                <a class="page-link" href="#">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            <li class="page-item"
                v-if="results.current_page < results.last_page - 1"
                @click.prevent="$emit('get-page', results.last_page)">
                <a class="page-link" href="#">
                    <i class="fas fa-chevron-right"></i>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        mounted(){
            console.log(this.results)
        },
        props : ['results']
    }
</script>

<style lang="scss" scoped>

</style>
