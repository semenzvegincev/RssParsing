<template>
    <form @submit.prevent="handleSubmit">
        <input type="text" v-model="newPost.author" placeholder="Author" required
               class="border-gray-300 rounded-md px-4 py-2 mb-2">
        <input type="text" v-model="newPost.category" placeholder="Category" required
               class="border-gray-300 rounded-md px-4 py-2 mb-2">
        <input type="text" v-model="newPost.title" placeholder="Title" required
               class="border-gray-300 rounded-md px-4 py-2 mb-2">
        <input type="text" v-model="newPost.description" placeholder="Description" required
               class="border-gray-300 rounded-md px-4 py-2 mb-2">
        <input type="text" v-model="newPost.content" placeholder="Content" required
               class="border-gray-300 rounded-md px-4 py-2 mb-2">
        <input type="text" v-model="newPost.pubDate" placeholder="Date" required
               class="border-gray-300 rounded-md px-4 py-2 mb-2">
        <input type="text" v-model="newPost.thumbnailUrl" placeholder="URL photo" required
               class="border-gray-300 rounded-md px-4 py-2 mb-2">
        <input type="text" v-model="newPost.link" placeholder="Url" required
               class="border-gray-300 rounded-md px-4 py-2 mb-2">

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
            Создать пост
        </button>

    </form>
</template>

<script>
import { ref } from 'vue';

export default {
    props: {
        createFormVisible: Boolean,
        fetchPosts: Function
    },
    setup(props) {
        const newPost = ref({
            author: '', category: '', title: '', description: '', content: '',
            pubDate: '', thumbnailUrl: '', link: ''
        });

        const handleSubmit = async () => {
            try {
                const response = await fetch('/api/posts', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(newPost.value),
                });
                if (response.ok) {
                    newPost.value = {
                        author: '', category: '', title: '', description: '', content: '',
                        pubDate: '', thumbnailUrl: '', link: ''
                    };
                    props.fetchPosts();
                    props.createFormVisible = false;
                } else {
                    console.error('Failed to create post');
                }
            } catch (error) {
                console.error('Error creating post:', error);
            }
        };

        return {
            newPost,
            handleSubmit
        };
    }
};
</script>
