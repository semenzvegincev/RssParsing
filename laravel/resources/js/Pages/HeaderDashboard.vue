<template>
    <div>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">AdminBoard</h2>
        <div class="flex justify-between items-center">

            <!-- Search -->
            <form @submit.prevent="handleSubmit" class="mt-4 flex items-center space-x-2">
                <input type="text" :value="searchTerm" @input="updateSearchTerm($event.target.value)" placeholder="Search..."
                       class="py-1 px-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
                <button type="submit"
                        class="py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                    Search
                </button>
            </form>

            <!-- Create Button -->
            <button @click="toggleCreateForm" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                Create New Post
            </button>
        </div>

        <!-- Create Form -->
        <CreatePostForm v-if="createFormVisible" :fetch-posts="fetchPosts" @cancel="toggleCreateForm"/>
    </div>
</template>

<script>
import { ref } from 'vue';
import CreatePostForm from './CreatePostForm.vue';

export default {
    components: {
        CreatePostForm
    },
    props: ['searchPosts', 'toggleCreateForm', 'createFormVisible', 'searchTerm', 'fetchPosts'],
    methods: {
        handleSubmit() {
            this.searchPosts();
        },
        updateSearchTerm(value) {
            this.$emit('update:searchTerm', value);
        }
    }
};
</script>
