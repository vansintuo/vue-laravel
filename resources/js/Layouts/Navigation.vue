<template>
    <aside class="z-20 hidden w-64 overflow-y-auto bg-gray-900 md:block flex-shrink-0">
        <div class="py-4 text-white">
            <Link class="ml-6 text-lg font-bold text-white" :href="route('dashboard')">
            GOO
            </Link>

            <ul class="mt-6">
                <li class="relative px-6 py-3">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        <template #icon>
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </template>
                        Dashboard
                    </NavLink>
                </li>

                <li class="relative px-6 py-3">
                    <NavLink :href="route('users.index')" :active="route().current('users.index')">
                        <template #icon>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </template>
                        Users
                    </NavLink>
                </li>


                <li class="relative px-6 py-3">
                    <NavLink :href="route('locations.index')" :active="route().current('locations.index')">
                        <template #icon>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </template>
                        locations
                    </NavLink>
                </li>

                <li class="relative px-6 py-3">
                    <NavLink :href="route('about')" :active="route().current('about')">
                        <template #icon>
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                                </path>
                            </svg>
                        </template>
                        About us
                    </NavLink>
                </li>

                <li v-if="$page.props.user.permissions.includes('Role view')" class="relative px-6 py-3">
                    <NavLink :href="route('roles.index')"
                        :active="route().current('roles.index') || route().current('roles.create') || route().current('roles.edit')">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </template>
                        Roles
                    </NavLink>
                </li>

                <li class="relative px-6 py-3">
                    <button @click="showingTwoLevelMenu = !showingTwoLevelMenu"
                        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-300"
                        aria-haspopup="true">
                        <span class="inline-flex items-center">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            <span class="ml-4">Two-level menu</span>
                        </span>
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul v-show="showingTwoLevelMenu"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-700"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 text-white hover:text-gray-300">
                            <a class="w-full" href="#">Child menu</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 text-white hover:text-gray-300">
                            <a class="w-full" href="#/abu">Menu </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script>
import NavLink from '@/Components/NavLink.vue'
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

export default {
    components: {
        NavLink,
        Link,
    },
    canRegister: {
        type: Boolean,
    },
    setup() {
        let showingTwoLevelMenu = ref(false)

        return {
            showingTwoLevelMenu
        }

    },
}




import { onMounted } from 'vue';
import L from 'leaflet';
import axios from 'axios';

const map = ref(null);
const locations = ref([]);

onMounted(async () => {
    // Fetch locations from Laravel
    const response = await axios.get('/locations');
    locations.value = response.data;

    // Initialize the map
    map.value = L.map('map').setView([51.505, -0.09], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map.value);

    // Add markers to the map
    locations.value.forEach(location => {
        L.marker([location.latitude, location.longitude])
            .addTo(map.value)
            .bindPopup(location.name);
    });
});
</script>
