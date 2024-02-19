<template>
    <div>
        <div v-if="isLoading">Loading...</div>
        <div v-else>
            <div v-if="posts.length === 0">Empty</div>
            <div v-else>
                <div v-for="post in posts" :key="post.id" class="mb-6 border-b pb-6">
                    <div class="flex justify-between mb-2">
                        <h4 class="text-lg font-semibold">{{ post.title }}</h4>
                        <span class="text-gray-500">{{ post.pubDate }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <p><span class="font-semibold">Author:</span> {{ post.author }}</p>
                        <p><span class="font-semibold">Category:</span> {{ post.category }}</p>
                    </div>
                    <p class="text-gray-700 dark:text-gray-200 mb-4">Description: {{ post.description }}</p>
                    <div class="content-wrapper mb-4">
                        <p class="content" :class="{ expanded: post.expanded }" v-if="!post.expanded">
                            {{ post.content.slice(0, 40) }}{{ post.content.length > 40 ? '...' : '' }}
                        </p>
                        <p class="content" :class="{ expanded: post.expanded }" v-else>{{ post.content }}</p>
                        <button class="text-blue-500 hover:underline" @click="toggleContent(post)">
                            {{ post.expanded ? 'Read Less' : 'Read More' }}
                        </button>
                    </div>
                    <p class="text-gray-500 mb-2"><span class="font-semibold">Thumbnail URL:</span> {{ post.thumbnailUrl }}</p>
                    <a :href="post.link" class="ml-2 text-blue-500 hover:underline" target="_blank">Open Link</a>
                    <!-- Edit Post , Delete Post -->
                    <EditDeletePost :post="post" :editedPost="editedPost" :updatePost="updatePost" :editPost="editPost" :deletePost="deletePost"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import EditDeletePost from "@/Pages/EditDeletePost.vue";

export default {
    components: {EditDeletePost},
    props: {
        posts: Array,
        isLoading: Boolean,
        editedPost: Object,
        deletePost: Function,
        editPost: Function,
        updatePost: Function,
        toggleContent: Function
    }
};
</script>
