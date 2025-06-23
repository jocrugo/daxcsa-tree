<script setup>
import TreeView from './components/TreeView.vue'
import data from './assets/Daxcsa.json'

const rootNode = data.data.attributes[0] // Este es el primer distribuidor
</script>

<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Árbol Genealógico Daxcsa</h1>
    <TreeView :node="rootNode" />
  </div>
</template>
