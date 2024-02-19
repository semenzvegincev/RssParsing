<template>
    <div>
        <div class="editPost" v-if="editedPost && editedPost.id === post.id">
            <form @submit.prevent="updatePost()">
                <input type="text" v-model="editedPost.author" placeholder="Author" required
                       class="border-gray-300 rounded-md px-4 py-2 mb-2 text-black">
                <input type="text" v-model="editedPost.category" placeholder="Category" required
                       class="border-gray-300 rounded-md px-4 py-2 mb-2 text-black">
                <input type="text" v-model="editedPost.title" placeholder="Title" required
                       class="border-gray-300 rounded-md px-4 py-2 mb-2 text-black">
                <input type="text" v-model="editedPost.description" placeholder="Description" required
                       class="border-gray-300 rounded-md px-4 py-2 mb-2 text-black">
                <input type="text" v-model="editedPost.content" placeholder="Content" required
                       class="border-gray-300 rounded-md px-4 py-2 mb-2 text-black">
                <input type="text" v-model="editedPost.pubDate" placeholder="pubDate" required
                       class="border-gray-300 rounded-md px-4 py-2 mb-2 text-black">
                <input type="text" v-model="editedPost.thumbnailUrl" placeholder="thumbnailUrl" required
                       class="border-gray-300 rounded-md px-4 py-2 mb-2 text-black">
                <input type="text" v-model="editedPost.link" placeholder="link" required
                       class="border-gray-300 rounded-md px-4 py-2 mb-2 text-black">

                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                    Save
                </button>
                <button type="button" @click="editedPost = null"
                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 ml-2">
                    Cancel
                </button>
            </form>
        </div>

        <div>
            <span class="material-icons cursor-pointer text-green-500 mr-2 ml-2" @click="editPost(post)">Edit</span>
            <span class="material-icons cursor-pointer text-red-500 ml-2" @click="deletePost(post)">Delete</span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        post: {
            type: Object,
            required: true
        },
        editedPost: Object,
        updatePost: Function,
        editPost: Function,
        deletePost: Function
    }
}
</script>
