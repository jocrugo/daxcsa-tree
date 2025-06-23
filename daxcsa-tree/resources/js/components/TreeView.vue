<!-- components/TreeView.vue -->
<template>
  <div class="tree-node" :data-depth="depth">
    <div class="node-card" @click="onNodeClick(node)">
      <div class="node-content">
        <div class="username">{{ node.username }}</div>
        <div class="full-name">{{ node.full_name }}</div>
        <div class="status">
          <span :class="node.status === 'Active' ? 'dot-active' : 'dot-inactive'">●</span>
          <span class="status-text">{{ node.status }}</span>
        </div>
        <div class="product-category">
          {{ node.product_name || 'Sin producto' }} · {{ node.category_name || 'N/A' }}
        </div>
        <div class="position">
          Posición: <strong>{{ node.binary_placement || 'ROOT' }}</strong>
        </div>
      </div>
    </div>

    <div v-if="hasChildren && depth < maxDepth" class="connector-wrapper">
      <div class="line-vertical-up"></div>
      <div class="line-horizontal"></div>
      <div class="children">
        <div
          v-for="child in orderedChildren"
          :key="child.username"
          class="child-box"
        >
          <div class="line-vertical-down"></div>
          <TreeView
            :node="child"
            :depth="depth + 1"
            :maxDepth="maxDepth"
            :onNodeClick="onNodeClick"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import TreeView from './TreeView.vue'

const props = defineProps({
  node: { type: Object, required: true },
  depth: { type: Number, required: true },
  maxDepth: { type: Number, required: true },
  onNodeClick: { type: Function, required: true }
})

const orderedChildren = computed(() =>
  [...(props.node.children || [])]
    .sort((a, b) => a.binary_placement === 'Left' ? -1 : 1)
    .slice(0, 3)
)
const hasChildren = computed(() => orderedChildren.value.length > 0)
</script>

<style scoped>
.tree-node {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 3rem;
  animation: fadeIn 0.5s both;
}

/* Nodo */
.node-card {
  background: #ffffff;
  border: 1px solid #e0e0e0;
  border-radius: 0.75rem;
  padding: 1.25rem;
  max-width: 18rem;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  transition: transform 0.2s, box-shadow 0.2s;
  cursor: pointer;
}
.node-card:hover {
  transform: translateY(-0.15rem);
  box-shadow: 0 4px 14px rgba(0,0,0,0.12);
}
.node-card:active {
  transform: scale(0.98);
}

.node-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  font-family: 'Segoe UI', Tahoma, sans-serif;
  color: var(--clr-secondary, #37474f);
}

/* Textos */
.username {
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--clr-primary, #0d47a1);
  transition: color var(--transition-fast, 0.15s);
}
.username:hover {
  color: var(--clr-accent, #1976d2);
}

.full-name {
  font-size: 1rem;
  font-weight: 500;
  margin-top: 0.25rem;
}

.status {
  display: flex;
  align-items: center;
  gap: 0.25rem;
  font-size: 0.75rem;
  margin-top: 0.25rem;
}
.dot-active { color: #2e7d32; }
.dot-inactive { color: #c62828; }
.status-text { color: #546e7a; }

.product-category {
  font-size: 0.8125rem;
  margin-top: 0.25rem;
}

.position {
  font-size: 0.6875rem;
  font-style: italic;
  margin-top: 0.25rem;
}

/* Conectores */
.connector-wrapper { position: relative; width: 100%; }
.line-vertical-up {
  position: absolute; top: calc(100% + 0.5rem);
  left: 50%; width: 2px; height: 1rem;
  background: #cfd8dc; transform: translateX(-50%);
}
.line-horizontal {
  position: absolute; top: calc(100% + 1.5rem);
  left: 10%; right: 10%; height: 2px;
  background: #cfd8dc;
}
.children {
  display: flex; justify-content: space-evenly;
  margin-top: 2.5rem;
}
.child-box {
  position: relative; display: flex;
  flex-direction: column; align-items: center;
}
.line-vertical-down {
  position: absolute; top: -2rem;
  width: 2px; height: 2rem; background: #cfd8dc;
}

/* Animación fadeIn */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(8px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 768px) {
  .children {
    gap: 1.5rem;
    overflow-x: auto;
    padding-bottom: 1rem;
  }
  .line-horizontal {
    left: 5%; right: 5%;
  }
}
</style>
