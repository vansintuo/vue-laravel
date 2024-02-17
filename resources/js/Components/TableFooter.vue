<template>
    <div class="w-auto px-4 py-3 text-md text-gray-500">
      <div class="flex items-center justify-between">
        Total Records: {{ totalRecords }}
        <pagination :links="paginationLinks" />
      </div>
    </div>
  </template>
  
  <script setup>
  import Pagination from '@/Components/Pagination.vue';

  import { defineProps } from 'vue';
  
  const { totalRecords, paginationLinks } = defineProps(['totalRecords', 'paginationLinks']);
  </script>
  