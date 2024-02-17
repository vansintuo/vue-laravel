<template>
    <Head :title="breadcrumbName" />


    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                {{ breadcrumbName }}
                <Breadcrumb :breadcrumbName="breadcrumbName" />
            </div>

        </template>
        <div class="py-3">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="flex flex-row md:flex-row items-center p-2">
                    <div class="flex flex-col md:flex-col items-center mb-2 md:mb-0">
                        <Link href="/roles"
                            class="py-2 px-4 mb-2 md:mr-3 md:mb-0 w-auto whitespace-nowrap focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm text-center sm:text-left md:text-start">
                        Back
                        </Link>
                    </div>

                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-4">
                <form @submit.prevent="updateRole" class="mx-auto p-4">
                    <div class="flex flex-col justify-between md:flex-row gap-4 sm:flex">
                        <div class=" w-full mb-5 group">
                            <label for="rolename" class="block mb-2 text-sm font-medium text-gray-900">
                                Role Name <span class="text-red-700">*</span></label>
                            <input type="text" v-model="form.name"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <InputError class="mt-2" :message="form.errors.name" />

                        </div>
                        <div class=" w-full mb-5 group">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
                                Description</label>
                            <input type="text" v-model="form.description"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <InputError class="mt-2" :message="form.errors.description" />

                        </div>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-50">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Permissions
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        View
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Create
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Update
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="group in Object.keys(permissions)" :key="group" class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium uppercase text-gray-900 whitespace-nowrap">
                                        {{ group }}
                                    </th>
                                    <th v-for="(permission, index) in permissions[group]" :key="permission.id"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                        <input type="checkbox" :id="'permission_' + permission.id" :value="permission.id"
                                            v-model="form.permissions"
                                            class="text-purple-600 form-checkbox focus:shadow-outline-purple focus:border-purple-400 focus:outline-none dark:focus:shadow-outline-gray" />

                                    </th>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="mt-3 flex flex-row sm:flex-row gap-2 items-center justify-end">
                        <button type="submit"
                            class="text-white bg-blue-800 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto sm:w-auto px-5 py-2.5 text-center sm:text-left">Save</button>
                        <Link href="/roles"
                            class="text-white bg-red-500 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto sm:w-auto px-5 py-2.5 text-center sm:text-left">
                        Cancel
                        </Link>
                    </div>

                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
  
<script setup>
import InputError from '@/Components/InputError.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref, defineProps, defineEmits, computed, watch } from 'vue';

const breadcrumbName = ref('Edit Role');

const emit = defineEmits(['update:permissions']);

const props = defineProps({
    // checked: {
    //     type: [Array, Boolean],
    //     default: false,
    // },
    role: {
        type: Object,
    },
    permissions: {
        type: Object,
    },

});
const isPermissionAssigned = (permissionId) => {
    return form.checkedPermissions.includes(permissionId);
};

const form = useForm({
    name: props.role?.name,
    description: props.role?.description,
    permissions: props.role?.permissions ? props.role.permissions.map(permission => permission.id) : [],
    checkedPermissions: props.role?.permissions ? props.role.permissions.map(permission => permission.id) : [],
});

const updateRole = async () => {
    form.checkedPermissions = form.permissions.slice();

    await router.post(`/roles/${props.role.id}`, {
        _method: "put",
        name: form.name,
        description: form.description,
        permissions: form.permissions,
    });
};

watch(() => form.permissions, (newPermissions) => {
    form.checkedPermissions = newPermissions.slice();
});
</script>

