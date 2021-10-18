<template>
<div class="col">
    <h2>Create your list:</h2>
    <form @submit.prevent="submitForm('listName')" class="form-group">
        <label for="listName">List name:</label>
        <input type="text" class="form-control" id="listName" name="list-name" v-model="listName">
        <p id="sucess"></p>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>

</template>

<script>
export default {
    name: 'createList',
    data() {
        return {
            listName: ''
        }
    },
    methods: {
        submitForm() {
            const listName = document.getElementById('listName').value;
            this.$store.dispatch('createList', listName);
            this.listName = '';
        }
    }
}
</script>
