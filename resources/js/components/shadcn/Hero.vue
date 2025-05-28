<script setup lang="ts">

import { Badge } from "@/components/shadcn/ui/badge";
import { Button } from "@/components/shadcn/ui/button";
import { ArrowRight } from "lucide-vue-next";
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <section class="relative w-full px-4 sm:px-6 md:px-10 lg:px-16 xl:px-20 overflow-x-hidden">
    <div class="grid place-items-center w-full max-w-screen-xl gap-8 mx-auto py-20 md:py-32">
      <div class="relative w-[90%] text-center space-y-8">
        <!-- ORB BACKGROUND LAYER -->
        <div class="absolute inset-0 pointer-events-none z-0">
          <!-- Orange Orb (Top Right) -->
          <div class="absolute animate-float-slow top-[10%] right-[-150px] w-[400px] h-[400px]
              bg-[hsla(24.6,95%,53.1%,0.15)] rounded-full
              backdrop-blur-xl border border-white/20 shadow-2xl blur-2xl">
          </div>

          <!-- Pink Orb (Bottom Left) -->
          <div class="absolute animate-float-reverse bottom-[-100px] left-[-150px] w-[400px] h-[400px]
              bg-[#D247BF33] rounded-full
              backdrop-blur-2xl border border-white/10 shadow-xl blur-2xl">
          </div>
        </div>
        <Badge variant="outline" class="text-sm py-2 relative z-10">
          <span class="mr-2 text-[hsl(24.6_95%_53.1%)]">
            <Badge class="bg-[hsl(24.6_95%_53.1%)]">Beta</Badge>
          </span>
          <span> Tello is now live! </span>
        </Badge>

        <div class="max-w-screen-md mx-auto text-center text-5xl md:text-6xl font-bold relative z-10">
          <h1>
            Stay organized and
            <span class="text-transparent bg-gradient-to-r from-[#D247BF] to-[hsl(24.6_95%_53.1%)] bg-clip-text">
              get things done
            </span>
            with Tello
          </h1>
        </div>

        <p class="max-w-screen-sm mx-auto text-xl text-muted-foreground relative z-10">
          A modern task manager built for teams and individuals. Create tasks, set deadlines, track progress, and
          collaborate in real time — all in one place.
        </p>

        <div class="flex flex-col md:flex-row justify-center items-center gap-4 relative z-10">
          <Button class="font-bold group/arrow bg-[hsl(24.6_95%_53.1%)] text-white hover:bg-[hsl(19,100%,55%)]"
            style="width: 80%; max-width: 240px;">
            <Link :href="route('login')"
              class="flex justify-evenly">
            Get Started
              <ArrowRight class="size-5 ml-2 group-hover/arrow:translate-x-1 transition-transform" />
            </Link>
          </Button>

          <Button as-child variant="secondary" class="font-bold" style="width: 80%; max-width: 240px;">
            <a href="#features">See Features</a>
          </Button>
        </div>
      </div>
    </div>
  </section>
</template>




<style scoped>

@keyframes float-slow {
  0% {
    transform: translateY(0px) translateX(0px);
  }

  50% {
    transform: translateY(-30px) translateX(15px);
  }

  100% {
    transform: translateY(0px) translateX(0px);
  }
}

@keyframes float-reverse {
  0% {
    transform: translateY(0px) translateX(0px);
  }

  50% {
    transform: translateY(30px) translateX(-20px);
  }

  100% {
    transform: translateY(0px) translateX(0px);
  }
}

.animate-float-slow {
  animation: float-slow 6s ease-in-out infinite;
}

.animate-float-reverse {
  animation: float-reverse 8s ease-in-out infinite;
}

.img-shadow-animation {
  animation-name: img-shadow-animation;
  animation-iteration-count: infinite;
  animation-duration: 2s;
  animation-timing-function: linear;
  animation-direction: alternate;
}

.img-shadow-animation-alt {
  animation-name: img-shadow-animation-alt;
  animation-iteration-count: infinite;
  animation-duration: 2s;
  animation-timing-function: linear;
  animation-direction: alternate;
}

.img-border-animation {
  animation-name: img-border-animation;
  animation-iteration-count: infinite;
  animation-duration: 2s;
  animation-timing-function: linear;
  animation-direction: alternate;
}

@keyframes img-shadow-animation {
  from {
    opacity: 0.5;
    transform: translateX(30px);
  }

  to {
    opacity: 1;
    transform: translateY(0px);
  }
}

@keyframes img-shadow-animation-alt {
  from {
    opacity: 0.4;
    transform: translateY(-10px) scale(0.95);
    filter: blur(30px);
  }

  to {
    opacity: 1;
    transform: translateY(10px) scale(1.05);
    filter: blur(40px);
  }
}


@keyframes img-border-animation {
  from {
    border-top-color: rgba(249, 115, 22, 0.1);
  }

  to {
    border-top-color: rgba(249, 115, 22, 0.6);
  }
}
</style>
