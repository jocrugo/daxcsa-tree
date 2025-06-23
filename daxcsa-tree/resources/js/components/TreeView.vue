<template>
  <div class="tree-node" :data-depth="depth">
    <!-- Card -->
    <div class="node-card" @click="onNodeClick(node)">
      <div class="flex flex-col items-center text-center">
        <div class="text-indigo-900 font-bold text-lg">{{ node.username }}</div>
        <div class="text-slate-800 text-base font-medium">{{ node.full_name }}</div>
        <div class="mt-1 flex items-center gap-1 text-xs">
          <span :class="statusColor">● {{ node.status }}</span>
        </div>
        <div class="text-[13px] text-slate-500 mt-1">
          {{ node.product_name || 'Sin producto' }} · {{ node.category_name || 'N/A' }}
        </div>
        <div class="text-[11px] italic text-gray-500 mt-1">
          Posición: <strong>{{ node.binary_placement || 'ROOT' }}</strong>
        </div>
      </div>
    </div>

    <!-- Conectores (hasta nivel 2) -->
    <div v-if="hasChildren && depth < maxDepth" class="connector-wrapper">
      <div class="line-vertical-up"></div>
      <div class="line-horizontal"></div>
      <div class="children">
        <div v-for="child in orderedChildren" :key="child.username" class="child-box">
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
  node: Object,
  depth: Number,
  maxDepth: Number,
  onNodeClick: Function,
})

const orderedChildren = computed(() => {
  const arr = [...(props.node.children || [])]
    .sort((a, b) => a.binary_placement === 'Left' ? -1 : 1)
  return arr.slice(0, 3)
})
const hasChildren = computed(() => orderedChildren.value.length > 0)
const statusColor = computed(() =>
  props.node.status === 'Active' ? 'text-green-600' : 'text-red-500'
)
</script>

<style scoped>
.tree-node { display: flex; flex-direction: column; align-items: center; position: relative; margin-bottom: 3rem; }
.node-card {
  background: rgba(255,255,255,0.85);
  backdrop-filter: blur(10px);
  border: 1px solid #cbd5e1;
  border-radius: 1.5rem;
  padding: 1.25rem;
  max-width: 280px;
  box-shadow: 0 12px 24px rgba(0,0,0,0.06);
  cursor: pointer;
  transition: transform .2s, box-shadow .2s;
  z-index: 2;
}
.node-card:hover { transform: translateY(-4px) scale(1.02); box-shadow: 0 16px 32px rgba(0,0,0,0.1); }

.connector-wrapper { position: relative; width: 100%; z-index: 1; }
.line-vertical-up {
  position: absolute; top: calc(100% + 0.5rem); left: 50%;
  width: 2px; height: 1rem; background: #cbd5e1; transform: translateX(-50%);
}
.line-horizontal {
  position: absolute; top: calc(100% + 1.5rem); left: 10%; right: 10%;
  height: 2px; background: #cbd5e1; border-radius: 1px;
}
.children { display: flex; justify-content: space-evenly; margin-top: 2.5rem; }
.child-box { position: relative; display: flex; flex-direction: column; align-items: center; }
.line-vertical-down {
  position: absolute; top: -2rem; width: 2px; height: 2rem; background: #cbd5e1;
}

@media (max-width: 768px) {
  .children { gap: 2rem; overflow-x: auto; padding-bottom: 1rem; }
  .line-horizontal { left: 5%; right: 5%; }
  .node-card { max-width: 220px; }
}
</style>
