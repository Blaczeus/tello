<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance';
import { Moon, Sun } from 'lucide-vue-next';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const { appearance, updateAppearance } = useAppearance();

const tabs = [
  { value: 'light', Icon: Sun, label: 'Light' },
  { value: 'dark', Icon: Moon, label: 'Dark' },
] as const;

const next = computed(() => {
  const index = tabs.findIndex(tab => tab.value === appearance.value);
  return tabs[(index + 1) % tabs.length];
});

const page = usePage();
const hideRoutes = ['/', '/login', '/register'];
const showLabel = computed(() => !hideRoutes.includes(page.url.split('?')[0]));
</script>

<template>
  <button @click="updateAppearance(next.value)"
    class="inline-flex items-center gap-2 rounded-md px-3.5 py-1.5 bg-neutral-100 text-neutral-700 transition-colors hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-300 dark:hover:bg-neutral-700">
    <component :is="next.Icon" class="h-4 w-4" />
    <span v-if="showLabel" class="text-sm">{{ next.label }} Mode</span>
  </button>
</template>
