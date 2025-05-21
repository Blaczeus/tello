<template>
  <div class="flex flex-wrap gap-2">
    <button v-for="tab in tabs" :key="tab.value" @click="selectTab(tab.value)" :class="[
      'inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-md transition',
      isActive(tab.value)
        ? 'bg-white dark:bg-white/5 text-orange-600 dark:text-orange-400 ring-1 ring-transparent'
        : 'group text-gray-700 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400',
    ]">
      {{ tab.label }}
      <span :class="[
        'inline-flex rounded-full px-2 py-0.5 text-xs font-medium leading-normal',
        isActive(tab.value)
          ? 'bg-orange-100 dark:bg-orange-400/10 text-orange-600 dark:text-orange-400'
          : 'bg-white dark:bg-white/[0.05] text-gray-700 dark:text-white group-hover:text-orange-600 dark:group-hover:text-orange-400',
      ]">
        {{ tab.count }}
      </span>
    </button>
  </div>
</template>

<script lang="ts" setup>
import { ref, defineEmits, defineProps, watch } from 'vue';

interface TabItem {
  label: string;
  value: string;
  count: number;
}

const props = defineProps<{
  tabs: TabItem[];
  active: string;
}>();

const emit = defineEmits<{
  (e: 'update:active', value: string): void;
}>();

const activeTab = ref(props.active);

// sync internal ref with external changes
watch(() => props.active, (newVal) => {
  activeTab.value = newVal;
});

function selectTab(value: string) {
  activeTab.value = value;
  emit('update:active', value);
}

function isActive(value: string) {
  return activeTab.value === value;
}
</script>
