<template>
    <AuthenticatedLayout>
        <template #header>
            Create Users
        </template>
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <form @submit.prevent="createUser">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput id="name" type="text" class="block w-full mt-1" v-model="form.name" autofocus
                        autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email"
                        autocomplete="username" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput id="password" type="password" class="block w-full mt-1" v-model="form.password"
                        autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput id="password_confirmation" type="password" class="block w-full mt-1"
                        v-model="form.password_confirmation" autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Role" />
                    <select v-model="form.type" id="role">
                        <option v-for="role in roles" :key="role.name" :value="role.name">
                            {{ role.name }}
                        </option>
                    </select>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit"
                        class="text-white bg-blue-800 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto sm:w-auto px-5 py-2.5 text-center sm:text-left">Save</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm } from '@inertiajs/vue3';
import {defineProps } from 'vue';
const props = defineProps({
    roles: Array,
});
const form = useForm({
    name: '',
    email: '',
    password: '',
    type:'',
    password_confirmation: '',
    terms: false,
});
const createUser = async () => {
    try {
        await form.post(route('users.store'));
    } catch (error) {
        console.log(error);
    }
}
</script>
