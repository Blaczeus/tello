<script setup lang="ts">
import { useColorMode } from "@vueuse/core";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { Button } from "@/components/shadcn/ui/button";
import { Moon, Sun } from "lucide-vue-next";

const mode = useColorMode();
const page = usePage();

const hideLabelOnRoutes = ['/', 'login', 'register']

const showLabel = computed(() => !hideLabelOnRoutes.includes(page.url.split('/')[1]));
</script>

<template>
  <Button @click="mode = mode === 'dark' ? 'light' : 'dark'" size="sm" variant="ghost"
    class="w-full flex justify-start items-center gap-4 px-2 py-1.5">
    <Moon v-if="mode === 'light'" class="size-4 mr-2 h-4" />
    <Sun v-else class="size-4 mr-2 h-4" />
    <span class="" v-if="showLabel">{{ mode === 'light' ? 'Dark' : 'Light' }} Mode</span>
  </Button>
</template>
