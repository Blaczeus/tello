<script setup lang="ts">
import { ChevronsDown } from "lucide-vue-next";
</script>

<template>
  <div class="flex items-center justify-center font-bold text-lg text-black dark:text-white">
    <a href="/" class="flex items-center">
      <ChevronsDown
        class="size-9 mr-2 rounded-lg border bg-gradient-to-tr from-[hsl(24.6_95%_53.1%)]/70 via-[hsl(24.6_95%_53.1%)] to-[hsl(24.6_95%_53.1%)]/70 text-white"
      />
    </a>
    <span class='flex items-center text-3xl'>Tello</span>
  </div>
</template>
