<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                {{ breadcrumbName }}
                <Breadcrumb :breadcrumbName="breadcrumbName" />
            </div>
        </template>
        <Toast :successMessage="$page.props.flash.success" />
        <div>
            <h1>Your Page</h1>
            <MapComponent />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MapComponent from '@/Components/MapComponent.vue';
</script>
