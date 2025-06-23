<template>
    <div class="p-4 border rounded shadow bg-white w-fit">
      <h2 class="font-bold">{{ node.username }}</h2>
      <p>{{ node.full_name }}</p>
      <p class="text-sm text-gray-500">{{ node.status }}</p>
    </div>
  </template>
  
  <script setup>
  const props = defineProps({
    node: Object
  })
  </script>
  