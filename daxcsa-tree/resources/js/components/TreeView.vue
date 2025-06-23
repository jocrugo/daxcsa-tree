<template>
  <div>
    <div>{{ node.username }}</div>
  </div>
</template>

<script setup>
const props = defineProps({
  node: Object
})
</script>
