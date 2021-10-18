<template>
    <div class="col">
        <h1>Show Lists</h1>
        <div v-for="list in getMovieLists" :key="list.id">
            <listdetails :list="list"></listdetails>
        </div>
    </div>
</template>

<script>
import listdetails from './ListDetailsComponent.vue';
import {mapGetters } from 'vuex';

export default {
    name: 'showLists',
    created() {
        this.$store.dispatch('showLists');
    },
    computed: {
        ...mapGetters(['getMovieLists']),
    },
    components: {
        listdetails
    }
}
</script>

