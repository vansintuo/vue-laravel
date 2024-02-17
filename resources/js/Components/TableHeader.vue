<template>
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
        <th scope="col" class="px-4 py-3">{{ headerColumns.id }}</th>
        <th scope="col" class="px-4 py-3">{{ headerColumns.roleName }}</th>
        <th scope="col" class="px-4 py-3">{{ headerColumns.description }}</th>
        <th scope="col" class="px-4 py-3 text-center">{{ headerColumns.actions }}</th>
      </tr>
    </thead>
  </template>
  
  <script setup>
  const headerColumns = defineProps(['headerColumns']);
  </script>
  