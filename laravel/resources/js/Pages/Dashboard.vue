<template>
    <Head title="AdminBoard"/>

    <AuthenticatedLayout>
        <template #header>
            <HeaderDashboard :searchPosts="searchPosts" :toggleCreateForm="toggleCreateForm"
            :createFormVisible="createFormVisible" :searchTerm.sync="searchTerm" :fetchPosts="fetchPosts"/>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <PostList :posts="posts" :isLoading="isLoading" :editedPost="editedPost" :deletePost="deletePost"
                         :editPost="editPost" :updatePost="updatePost" :toggleContent="toggleContent"/>
                        <Pagination :pagination="pagination" :changePage="changePage"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {ref} from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import DashboardStyles from './DashboardStyles.vue';
import CreatePostForm from './CreatePostForm.vue';
import EditDeletePost from './EditDeletePost.vue';
import Pagination from './Pagination.vue';
import HeaderDashboard from './HeaderDashboard.vue';
import PostList from "./PostList.vue";

export default {
    components: {
        PostList,
        AuthenticatedLayout,
        Head,
        DashboardStyles,
        CreatePostForm,
        EditDeletePost,
        Pagination,
        HeaderDashboard
    },
    setup() {
        const posts = ref([]);
        const isLoading = ref(false);
        const error = ref(null);
        const url = ref('/api/posts');

        const pagination = ref({'currentPage': 1, 'prevPage': null, 'nextPage': null});
        const editedPost = ref(null);
        const newPost = ref({
            author: '', category: '', title: '', description: '',
            content: '', pubDate: '', thumbnailUrl: '', link: ''
        });
        const searchTerm = ref('');
        const createFormVisible = ref(false);
        const noResultsMessage = ref('');


        const toggleCreateForm = () => {
            createFormVisible.value = !createFormVisible.value;
        };

        const searchPosts = async () => {
            try {
                isLoading.value = true;
                const response = await axios.get('/api/search', {params: {search: searchTerm.value}});
                pagination.value.currentPage = response.data.current_page;
                pagination.value.prevPage = response.data.prev_page_url;
                pagination.value.nextPage = response.data.next_page_url;
                posts.value = response.data.original.data;
            } catch (error) {
                error.value = error.response.data.message;
                posts.value = [];
            } finally {
                isLoading.value = false;
            }
        };

        const fetchPosts = async () => {
            isLoading.value = true;
            try {
                const response = await fetch(url.value);
                const data = await response.json();
                pagination.value.currentPage = data.current_page;
                pagination.value.prevPage = data.prev_page_url;
                pagination.value.nextPage = data.next_page_url;
                posts.value = data.data.map(post => ({...post, expanded: false}));
            } catch (error) {
                console.error('Error fetching posts:', error);
            }
            isLoading.value = false;
        };

        const changePage = (pageNumber) => {
            url.value = pageNumber;
            fetchPosts();
        };

        const deletePost = async (post) => {
            try {
                const response = await fetch(`/api/posts/${post.id}`, {
                    method: 'DELETE'
                });

                if (response.ok) {
                    posts.value = posts.value.filter(p => p.id !== post.id);
                } else {
                    console.error('Failed to delete post');
                }
            } catch (error) {
                console.error('Error deleting post:', error);
            }
        };

        const editPost = (post) => {
            if (editedPost.value && editedPost.value.id === post.id) {
                editedPost.value = null;
            } else {
                editedPost.value = {...post};
            }
        };

        const updatePost = async () => {
            try {
                const response = await fetch(`/api/posts/${editedPost.value.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(editedPost.value)
                });

                if (response.ok) {
                    editedPost.value = null;
                    fetchPosts();
                } else {
                    console.error('Failed to update post');
                }
            } catch (error) {
                console.error('Error updating post:', error);
            }
        };

        const toggleContent = (post) => {
            post.expanded = !post.expanded;
        };

        fetchPosts();
        return {
            posts,
            isLoading,
            noResultsMessage,
            changePage,
            pagination,
            deletePost,
            editPost,
            editedPost,
            updatePost,
            newPost,
            createFormVisible,
            toggleCreateForm,
            toggleContent,
            searchTerm,
            searchPosts,
            error,
            fetchPosts

        };
    },
};
</script>
