<template>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-white p-8">
      <div class="max-w-7xl mx-auto flex flex-col items-center">
  
        <!-- Título principal -->
        <h1
          class="text-5xl md:text-6xl font-extrabold text-center mb-8
                 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500
                 bg-clip-text text-transparent drop-shadow-lg animate-pulse"
        >
          <span class="inline-block transform hover:scale-110 transition-transform duration-300">🌳</span>
          Conexiones Daxcsa: Raíces y Ramas
          <span class="inline-block transform hover:-translate-y-1 transition-transform duration-300">✨</span>
        </h1>
  
        <!-- Árbol genealógico -->
        <div class="w-full overflow-x-auto">
          <TreeView
            :node="currentRoot"
            :depth="0"
            :maxDepth="3"
            :onNodeClick="handleNodeClick"
          />
        </div>
        
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import TreeView from './components/TreeView.vue'
  import data from './assets/Daxcsa.json'
  
  const treeData = data.data.attributes[0]
  const currentRoot = ref(treeData)
  
  function handleNodeClick(node) {
    currentRoot.value = node
  }
  </script>
  