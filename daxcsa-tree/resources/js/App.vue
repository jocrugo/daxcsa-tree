<template>
  <div class="app-container">
    <div class="main-container">
      <h1 class="title">
        <span class="emoji">🌳</span>
        Daxcsa Connections: Roots & Branches
        <span class="emoji">✨</span>
      </h1>

      <!-- Botón Volver al Padre -->
      <button
        class="action-button"
        @click="goToParent"
        :disabled="!currentRoot.parent_username"
      >
        ↑ Go Up Level
      </button>

      <!-- Árbol con maxDepth dinámico -->
      <div class="tree-wrapper">
        <TreeView
          :node="currentRoot"
          :depth="0"
          :maxDepth="computedMaxDepth"
          :onNodeClick="handleNodeClick"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import TreeView from './components/TreeView.vue'
import data from './assets/Daxcsa.json'

const treeData = data.data.attributes[0]
const currentRoot = ref(treeData)

const isMobile = ref(false)
function checkMobile() {
  isMobile.value = window.innerWidth <= 600
}
onMounted(() => {
  checkMobile()
  window.addEventListener('resize', checkMobile)
})
onUnmounted(() => {
  window.removeEventListener('resize', checkMobile)
})

const computedMaxDepth = computed(() => isMobile.value ? 1 : 3)

function handleNodeClick(node) {
  currentRoot.value = node
}

function goToParent() {
  if (!currentRoot.value.parent_username) return
  const findNode = (node, username) => {
    if (node.username === username) return node
    if (!node.children) return null
    for (const c of node.children) {
      const found = findNode(c, username)
      if (found) return found
    }
    return null
  }
  const parent = findNode(treeData, currentRoot.value.parent_username)
  if (parent) currentRoot.value = parent
}
</script>

<style>
:root {
  --clr-primary: #0d47a1;
  --clr-accent:  #1976d2;
  --clr-light:   #ffffff;
  --transition-fast: .15s ease-out;
}

.app-container {
  min-height: 100vh;
  background: linear-gradient(135deg, #f4f6f8 0%, #d9e2ec 100%);
  padding: 2.5rem 1rem;
  box-sizing: border-box;
}

.main-container {
  max-width: 1120px;
  margin: auto;
  background: var(--clr-light);
  border-radius: .75rem;
  box-shadow: 0 4px 12px rgba(0,0,0,.1);
  padding: 2rem;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.title {
  font-family: 'Segoe UI', Tahoma, sans-serif;
  font-size: 3rem; font-weight: 700;
  color: var(--clr-primary);
  margin-bottom: 1.5rem;
  animation: fadeIn 1s both;
}
.title .emoji {
  display: inline-block;
  transition: transform var(--transition-fast);
}
.title .emoji:hover {
  transform: translateY(-4px);
}

.action-button {
  font-family: 'Segoe UI', Tahoma, sans-serif;
  font-size: 1rem; font-weight: 600;
  color: var(--clr-light);
  background-color: var(--clr-accent);
  border: none; border-radius: .5rem;
  padding: .75rem 1.25rem;
  margin-bottom: 1.5rem;
  cursor: pointer;
  transition: background var(--transition-fast), transform var(--transition-fast);
}
.action-button:hover:not(:disabled) {
  background-color: #1565c0;
  transform: translateY(-2px);
}
.action-button:active:not(:disabled) {
  transform: scale(.98);
}
.action-button:disabled {
  opacity: .5;
  cursor: default;
}

.tree-wrapper {
  width: 100%;
  overflow-x: hidden; 
  overflow-y: auto;
  animation: fadeIn 0.6s both;
}

/* Animación */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 600px) {
  .title { font-size: 2.4rem; }
  .action-button { width: 100%; }
}
</style>
