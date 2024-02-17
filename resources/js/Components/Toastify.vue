<!-- components/Toastify.vue -->

<template>
    <Toast v-if="visible" :message="message" :type="type" :position="position" />
  </template>
  
  <script>
  import { ref, watch } from 'vue';
  import { Toast } from 'vue3-toastify';
  
  export default {
    components: {
      Toast,
    },
    props: {
      message: String,
      type: String,
      position: String,
    },
    setup() {
      const visible = ref(true);
  
      watch(() => {
        setTimeout(() => {
          visible.value = false;
        }, 3000);
      });
  
      return { visible };
    },
  };
  </script>
  