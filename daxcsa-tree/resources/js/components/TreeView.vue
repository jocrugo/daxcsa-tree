<template>
    <div class="text-center">
      <!-- Nodo actual -->
      <div class="border rounded-lg p-3 shadow bg-white w-fit mx-auto">
        <strong>{{ node.username }}</strong>
        <div class="text-sm">{{ node.full_name }}</div>
        <div class="text-xs text-gray-500">{{ node.status }}</div>
      </div>
  
      <!-- Hijos (si existen) -->
      <div v-if="orderedChildren.length" class="flex justify-center gap-12 mt-4">
        <TreeView
          v-for="(child, index) in orderedChildren"
          :key="index"
          :node="child"
        />
      </div>
    </div>
  </template>
  
  <script setup>
  import TreeView from './TreeView.vue'
  import { computed } from 'vue'
  
  const props = defineProps({
    node: Object
  })
  
  // Ordenar hijos: primero Left, luego Right
  const orderedChildren = computed(() => {
    if (!props.node.children) return []
    return [...props.node.children].sort((a, b) => {
      return a.binary_placement === 'Left' ? -1 : 1
    })
  })
  </script>
  