<script setup>
import TreeView from './components/TreeView.vue'
import data from './assets/Daxcsa.json'

const rootNode = data.data.attributes[0] // Primer nodo (distributor.16344)
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Árbol Genealógico Daxcsa</h1>
    <TreeView :node="rootNode" />
  </div>
</template>
