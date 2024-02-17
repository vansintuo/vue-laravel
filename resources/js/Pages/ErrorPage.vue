
<script setup>
import { computed } from 'vue'
import { Link } from "@inertiajs/vue3"

const props = defineProps({ status: Number })

const title = computed(() => {
    return {
        503: '503: Service Unavailable',
        500: '500: Server Error',
        404: '404: Page Not Found',
        403: '403: Forbidden',
    }[props.status] || 'Error';
})

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[props.status] || 'An unexpected error occurred.';
})
</script>

<template>
    <div id="main">
        <div class="fof">
            <h1>{{ title }}</h1><br>
            <p style="margin-bottom: 10px !important;">{{ description }}</p>
            <Link href="/dashboard"
                style="background-color: rgb(5, 5, 126); padding: 10px; color: #fff; border-radius: 10px;">Back
            </Link>
        </div>
    </div>
</template>

<style scoped>
* {
    transition: all 0.6s;
}

html {
    height: 100%;
}

body {
    font-family: 'Lato', sans-serif;
    color: #888;
    margin: 0;
}

#main {
    display: table;
    width: 100%;
    height: 100vh;
    text-align: center;
}

.fof {
    display: table-cell;
    vertical-align: middle;
}

.fof h1 {
    font-size: 50px;
    display: inline-block;
    padding-right: 12px;
    animation: type .5s alternate infinite;
}

@keyframes type {
    from {
        box-shadow: inset -3px 0px 0px #888;
    }

    to {
        box-shadow: inset -3px 0px 0px transparent;
    }
}
</style>