<template>
    <div class="flex justify-between items-center mt-4">
        <button v-if="pagination.prevPage" type="button"
                @click="changePage(pagination.prevPage)"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24">
                <path
                    d="M10 18l-6-6 6-6"/>
            </svg>
        </button>
        <span>{{ pagination.currentPage }}</span>
        <button v-if="pagination.nextPage" type="button"
                @click="changePage(pagination.nextPage)"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24">
                <path
                    d="M14 6l6 6-6 6"/>
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        pagination: {
            type: Object,
            required: true
        },
        changePage: Function
    }
}
</script>
