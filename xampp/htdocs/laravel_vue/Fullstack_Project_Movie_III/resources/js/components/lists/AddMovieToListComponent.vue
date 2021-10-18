<template>
    <div>
        <h2>Add {{ getMovieDetails['original_title'] }} To List:</h2>
        <form @submit.prevent="sendData()">
            <div class="form-group">
                <label for="listName">Select a list</label>
                <select class="selectpicker" id="listId">
                    <option v-for="list in getMovieLists" :key="list.id" :value="list.id">{{ list['name'] }}</option>
                </select>
            </div>
            <button class="btn btn-success">
                Add to List
            </button>
        </form>
        <p id="success"></p>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'addMovieToList',
    props: ['id'],
    data() {
        return {
            lists: [],
            value: '',

        };
    },
    created() {
        this.$store.dispatch('getMovieDetails', this.id),
        this.$store.dispatch('showLists')
    },
    methods: {
        sendData() {
            const data = {
                'listId': $('#listId').children("option:selected").val(),
                'movieId': this.id
    
            };
            this.$store.dispatch('addMovieToList', data);
        }
    },
    computed: {
        ...mapGetters(['getMovieDetails', 'getMovieLists'])
    }
}
</script>