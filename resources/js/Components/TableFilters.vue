<template>
    <div class="flex flex-col md:flex-row justify-between items-center p-2">
        <div class="flex flex-row md:flex-row justify-between items-center mb-2 md:mb-0">
            <Link :href="addLink"
                class="py-2 px-4 mb-2 md:mr-3 md:mb-0 w-auto whitespace-nowrap focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm">
            {{ addText }}
            </Link>

            <select v-model="perPage" @change="getRoles" id="roles"
                class="w-full md:w-40 py-2 px-5 mb-2 md:mb-0 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-500">
                <option v-for="option in perPageOptions" :key="option.value" :value="option.value">{{ option.label }}
                </option>
            </select>
        </div>

        <div class="relative w-full md:w-80 mb-2 md:mb-0">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input v-model="search" type="text" id="table-search"
                class="block w-full p-2 pl-10 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search for items">
        </div>
    </div>
</template>
  
<script setup>
import { ref } from "vue";

const props = defineProps(['addLink', 'addText', 'perPageOptions']);
const perPage = ref(5);
const search = ref('');

function getRoles() {
    // Implement the logic to get roles based on filters
}
</script>
  