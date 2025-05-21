<script setup lang="ts">
import { Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';

interface Props {
    href: string;
    tabindex?: number;
    method?: Method;
    as?: string;
}

defineProps<Props>();
</script>

<template>
  <Link
    :href="href"
    :tabindex="tabindex"
    :method="method"
    :as="as"
    class="text-[hsl(24.6,95%,53.1%)] underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:text-[hsl(24.6,95%,47%)] hover:decoration-current! dark:decoration-neutral-500"
  >
    <slot />
  </Link>
</template>

