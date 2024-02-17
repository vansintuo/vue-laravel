<template>
    <Head :title="breadcrumbName" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                {{ breadcrumbName }}
                <Breadcrumb :breadcrumbName="breadcrumbName" />
            </div>
        </template>
        <Toast :successMessage="$page.props.flash.success" />

        <div class="py-3">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="flex flex-col md:flex-row justify-between items-center p-2">
                    <div class="flex flex-row md:flex-row justify-between sm:justify-between items-center mb-2 md:mb-0">
                        <Link v-if="$page.props.user.permissions.includes('Role create')" href="/roles/create"
                            class="py-2 px-4 mb-2 md:mr-3 md:mb-0 w-auto whitespace-nowrap focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm">
                        Add New
                        </Link>

                        <select v-model="perPage" @change="getRoles" id="roles"
                            class="w-40 md:w-40 py-2 px-5 mb-2 md:mb-0 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-500">
                            <option value="10">10 Per Page</option>
                            <option value="15">15 Per Page</option>
                            <option value="30">30 Per Page</option>
                            <option value="50">50 Per Page</option>
                        </select>
                    </div>
                    <div class="relative w-full md:w-80 mb-2 md:mb-0">
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
                            class="block w-full p-2 pl-10 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search for items">
                    </div>
                </div>

            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th scope="col" class="px-4 py-3">Id</th>
                            <th scope="col" class="px-4 py-3">Roel Name</th>
                            <th scope="col" class="px-4 py-3">Description</th>
                            <th scope="col" class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <template v-if="roles.data.length > 0">
                            <tr v-for="(role, index) in roles.data" :key="role.id" class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ index + 1 }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ role.name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ role.description }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex gap-5 justify-center">
                                        <Link :href="route('roles.edit', role.id)" class="text-blue-500"
                                            v-if="$page.props.user.permissions.includes('Role update')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <!-- Edit Icon -->
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                        </Link>

                                        <Link :href="route('roles.show', role.id)" class="text-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <!-- Show Icon -->
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        </Link>

                                        <button @click="confirmDeleteRole(role.id)" class="text-red-700"
                                            v-if="$page.props.user.permissions.includes('Role delete')">
                                            <!-- Delete Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
                                            </svg>
                                        </button>

                                        <Modal :show="showConfirmDeleteRoleModal" @close="closeModal">
                                            <div class="p-6">
                                                <h2 class="text-lg font-semibold text-slate-800">Are you sure to delete this
                                                    Role?</h2>
                                                <div class="mt-6 flex space-x-4">
                                                    <DangerButton @click="deleteRole">Delete</DangerButton>
                                                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                                </div>
                                            </div>
                                        </Modal>

                                    </div>
                                </td>
                            </tr>
                        </template>

                        <template v-else>
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-sm text-red-500 text-center">
                                    <div class="flex items-center justify-center gap-5">
                                        Record Not Found<svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>

                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>

                </table>
                <!-- Pagination -->
                <TableFooter :totalRecords="roles.total" :paginationLinks="roles.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
  
<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Modal from '@/Components/Modal.vue';
import Toast from "@/Components/Toast.vue";
import Breadcrumb from '@/Components/Breadcrumb.vue';
import TableFooter from '@/Components/TableFooter.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { ref, watch, defineProps } from "vue";

const showConfirmDeleteRoleModal = ref(false)
const form = useForm({})

const confirmDeleteRole = (roleId) => {
    form.data.id = roleId;
    showConfirmDeleteRoleModal.value = true;
}


const closeModal = () => {
    showConfirmDeleteRoleModal.value = false;
}

const deleteRole = () => {
    const roleId = form.data.id;
    form.delete(route('roles.destroy', roleId), {
        onSuccess: () => closeModal()
    })
}


const breadcrumbName = ref('Roles');
const props = defineProps(['roles', 'filters']);


const search = ref(props.filters.search);
const perPage = ref(10);

watch(search, (value) => {
    router.get(
        "roles",
        { search: value, perPage: perPage.value },
        {
            preserveState: true,
            replace: true,
        }
    );
});

function getRoles() {
    router.get(
        "/roles",
        { perPage: perPage.value, search: search.value },
        {
            preserveState: true,
            replace: true,
        }
    );
}


</script>
  