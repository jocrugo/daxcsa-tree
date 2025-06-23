<template>
    <div class="min-h-screen p-8 bg-gradient-to-br from-slate-100 via-white to-slate-100">
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
  
        <!-- Información actual y acciones -->
        <div class="w-full max-w-2xl mb-6 flex items-center justify-between gap-4">
          <h2 class="text-xl md:text-2xl font-semibold text-slate-800">
            {{ currentRoot.full_name }} ({{ currentRoot.username }})
          </h2>
          <button
            v-if="hasParent"
            @click="goToParent"
            class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-700 hover:-translate-y-0.5 transform transition"
          >
            Ver padre
          </button>
        </div>
  
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
  import { ref, computed } from 'vue'
    import TreeView from './components/TreeView.vue'
    import data from './assets/Daxcsa.json'
  
    const treeData = data.data.attributes[0]
  const currentRoot = ref(treeData)
  const history = ref([treeData])
    
  function handleNodeClick(node) {
    history.value.push(node)
    currentRoot.value = node
  }
  
  function goToParent() {
    if (history.value.length > 1) {
      history.value.pop()
      currentRoot.value = history.value[history.value.length - 1]
    }
  }
  
  const hasParent = computed(() => history.value.length > 1)
  </script>