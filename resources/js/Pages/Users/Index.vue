<template>

    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            Users
        </template>
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="flex flex-col md:flex-row justify-between items-center p-2">
                    <div class="flex flex-row md:flex-row justify-between sm:justify-between items-center mb-2 md:mb-0">
                        <div class="bg-white overflow-hidden shadow-sm">
                            <div class="flex flex-col md:flex-row justify-end items-center p-2">
                                <div
                                    class="flex flex-row md:flex-row justify-between sm:justify-between items-center mb-2 md:mb-0">
                                    <Link v-if="$page.props.user.permissions.includes('Role create')"
                                        href="/users/create" class="py-2 px-4 mb-2 md:mr-3 md:mb-0 w-auto whitespace-nowrap focus:outline-none text-white bg-gray-700 hover:bg-gray-800
                            focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm">
                                    Add New
                                    </Link>
                                </div>

                            </div>
                        </div>
                        <select v-model="perPage" @change="getUser" id="roles"
                            class="w-40 md:w-40 py-2 px-5 mb-2 md:mb-0 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-500">
                            <option value="10">10 Per Page</option>
                            <option value="15">15 Per Page</option>
                            <option value="30">30 Per Page</option>
                            <option value="50">50 Per Page</option>
                        </select>
                    </div>
                    <!-- <div class="relative w-full md:w-80 mb-2 md:mb-0">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg v-if="!search" class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg v-if="search" aria-hidden="true" role="status"
                                class="inline w-4 h-4 me-3 text-blue-200 animate-spin" viewBox="0 0 100 101" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="#1C64F2" />
                            </svg>

                        </div>
                        <input v-model="search" type="text" id="table-search"
                            class="block w-full p-2 pl-10 text-sm te xt-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search for items">
                    </div> -->


                </div>

            </div>

            <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
                <div class="overflow-x-auto w-full">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Type</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            <tr v-for="(user, index) in users.data" :key="user.id" class="text-gray-700">
                                <td class="px-4 py-3 text-sm">{{ index + 1 }}</td>
                                <td class="px-4 py-3 text-sm">{{ user.name }}</td>
                                <td class="px-4 py-3 text-sm">{{ user.email }}</td>
                                <td class="px-4 py-3 text-sm">{{ user.type }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                    <pagination :links="users.links" @page-changed="fetchUsers" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from "vue";

const users = ref($page.props.users);
const search = ref('');
const perPage = ref(10);

const fetchUsers = (url = route('users.index')) => {
    router.get(url, { search: search.value, perPage: perPage.value }, { preserveState: true });
};

// Watchers for reactive changes
watch([search, perPage], fetchUsers);

</script>
