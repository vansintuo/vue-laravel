<!-- Toast.vue -->

<template>
    <TransitionGroup tag="div" enter-from-class="translate-x-full opacity-0" enter-active-class="duration-500"
        leave-active-class="duration-500" leave-to-class="translate-x-full opacity-0"
        class="fixed top-4 right-4 z-50 w-full max-w-xs space-y-4">
        <div v-if="message" :class="toastClasses" role="alert">
            <div :class="iconContainerClasses">
                <svg class="w-5 h-5" :class="iconClasses" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
            </div>
            <div class="ms-3 text-sm font-normal">{{ message }}</div>
            <button type="button" @click="closeToast"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </TransitionGroup>
</template>
  
<script setup>
import { ref, onMounted, defineProps } from "vue";

const { successMessage } = defineProps(['successMessage']);
const message = ref(successMessage || '');
const timeout = 3000;

onMounted(() => {
    setTimeout(() => {
        closeToast();
    }, timeout);
});

const closeToast = () => {
    message.value = '';
};

const toastClasses = ['fixed', 'top-4', 'right-4', 'z-50', 'flex', 'items-center', 'w-full', 'max-w-xs', 'p-4', 'mb-4', 'text-gray-500', 'bg-white', 'rounded-lg', 'shadow'];
const iconContainerClasses = ['inline-flex', 'items-center', 'justify-center', 'flex-shrink-0', 'w-8', 'h-8', 'text-green-500', 'bg-green-100', 'rounded-lg'];
const iconClasses = ['w-5', 'h-5'];
</script>
  