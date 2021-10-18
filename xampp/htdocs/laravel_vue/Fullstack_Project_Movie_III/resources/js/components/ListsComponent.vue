<template>
    <div class="container">
        <div class="row justify-content-center">
            <createlist></createlist>
            <showlists></showlists>
        </div>
    </div>
</template>

<script>
import showlists from './lists/ShowListsComponent.vue';
import createlist from './lists/CreateListComponent.vue';

export default {
    name: 'list',
    components: {
        showlists,
        createlist
    }
}
</script>