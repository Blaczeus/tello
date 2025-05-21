<script setup lang="ts">
import { ChevronsDown, Github, Twitter, ArrowUp } from "lucide-vue-next";
import Separator from "./ui/separator/Separator.vue";

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: "smooth" });
}
</script>

<template>
  <footer id="footer" class="relative w-[80%] mx-auto py-20 sm:py-28">
    <!-- Orbs -->
    <div class="absolute inset-0 pointer-events-none z-0">
      <!-- Orange Orb (Top Right) -->
      <div
        class="absolute top-[25%] right-[150px] w-[400px] h-[400px]
        bg-[hsla(24.6,95%,53.1%,0.15)] rounded-full
        backdrop-blur-xl border border-white/20 shadow-2xl blur-2xl"
      ></div>
    </div>

    <div class="relative z-10 p-10 bg-muted/50 dark:bg-card border rounded-2xl">
      <div class="grid gap-4 sm:grid-cols-1 lg:flex lg:justify-between w-[80%] justify-self-center lg:items-start">
        <!-- Branding -->
        <div class="max-w-sm">
          <a href="/" class="font-bold text-lg flex items-center">
            <ChevronsDown
              class="bg-gradient-to-tr from-orange-500/70 via-orange-500 to-orange-500/70 rounded-lg size-9 mr-2 border text-white"
            />
            Tello Tasks
          </a>
          <p class="text-sm text-muted-foreground mt-2">Organize your life, one task at a time.</p>
        </div>

        <!-- Socials -->
        <div>
          <h3 class="font-bold text-lg mb-2">Socials</h3>
          <ul class="space-y-3">
            <li>
              <a href="https://github.com/leoMirandaa" target="_blank" class="flex items-center gap-2 transition text-[#333] hover:text-black dark:text-white dark:hover:text-orange-400">
                <Github class="size-5" />
                <span>GitHub</span>
              </a>
            </li>
            <li>
              <a href="https://twitter.com/" target="_blank" class="flex items-center gap-2 transition text-[#1DA1F2] hover:text-blue-400">
                <Twitter class="size-5" />
                <span>Twitter</span>
              </a>
            </li>
          </ul>
        </div>
      </div>

      <Separator class="my-6" />

      <p class="text-sm text-muted-foreground text-center">
        &copy; 2025 Built with ❤️ by
        <a
          target="_blank"
          href="https://github.com/leoMirandaa"
          class="text-primary border-primary transition-all hover:border-b-2"
        >
          Nervego
        </a>
      </p>
    </div>


    <!-- Floating Back to Top Button -->
    <button
      @click="scrollToTop"
      class="fixed bottom-6 right-6 z-50 bg-gradient-to-tr from-orange-500/70 via-orange-500 to-orange-500/70 text-white p-3 rounded-full shadow-lg hover:scale-105 transition"
      aria-label="Back to top"
    >
      <ArrowUp class="size-4" />
    </button>
  </footer>
</template>
