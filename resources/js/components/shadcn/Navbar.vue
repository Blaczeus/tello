<script lang="ts" setup>
import { ref } from "vue";
import { useColorMode } from "@vueuse/core";
const mode = useColorMode();
mode.value = "dark";

import {
  NavigationMenu,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
} from "@/components/shadcn/ui/navigation-menu";
import {
  Sheet,
  SheetContent,
  SheetFooter,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from "@/components/shadcn/ui/sheet";

import { Button } from "@/components/shadcn/ui/button";
import { Separator } from "@/components/shadcn/ui/separator";
import { ChevronsDown, Menu } from "lucide-vue-next";
import GithubIcon from "@/components/shadcn/icons/GithubIcon.vue";
import ToggleTheme from "./ToggleTheme.vue";

interface RouteProps {
  href: string;
  label: string;
}

interface FeatureProps {
  title: string;
  description: string;
}

const routeList: RouteProps[] = [
  { href: "/dashboard", label: "Dashboard" },
  { href: "/tasks", label: "My Tasks" },
  { href: "/projects", label: "Projects" },
  { href: "/teams", label: "Teams" },
];

const featureList: FeatureProps[] = [
  {
    title: "Create Tasks",
    description: "Quickly create and manage your personal or team tasks.",
  },
  {
    title: "Start Sprints",
    description: "Organize work into sprints and track progress efficiently.",
  },
  {
    title: "Assign Members",
    description: "Collaborate by assigning tasks to teammates.",
  },
];

const isOpen = ref<boolean>(false);
</script>

<template>
  <header :class="{
    'shadow-light': mode === 'light',
    'shadow-dark': mode === 'dark',
    'w-[90%] md:w-[70%] lg:w-[75%] lg:max-w-screen-xl top-5 mx-auto sticky border z-40 rounded-2xl flex justify-between items-center p-2 bg-card shadow-md': true,
  }">
      <!-- Logo -->
      <a href="/" class="font-bold text-lg flex items-center">
        <ChevronsDown
          class="bg-gradient-to-tr from-[hsl(24.6_95%_53.1%)]/70 via-[hsl(24.6_95%_53.1%)] to-[hsl(24.6_95%_53.1%)]/70 rounded-lg size-9 mr-2 border text-white" />

        Tello
      </a>

    <!-- Mobile Navigation -->
    <div class="flex items-center lg:hidden">
      <Sheet v-model:open="isOpen">
        <SheetTrigger as-child>
          <Menu @click="isOpen = true" class="cursor-pointer" />
        </SheetTrigger>

        <SheetContent side="left" class="flex flex-col justify-between rounded-tr-2xl rounded-br-2xl bg-card">
          <div>
            <SheetHeader class="mb-4 ml-4">
              <SheetTitle class="flex items-center">
                <a href="/" class="flex items-center">
                  <ChevronsDown
                    class="bg-gradient-to-tr from-primary/70 via-primary to-primary/70 rounded-lg size-9 mr-2 border text-white" />
                  Tello
                </a>
              </SheetTitle>
            </SheetHeader>

            <div class="flex flex-col gap-2">
              <Button v-for="{ href, label } in routeList" :key="label" as-child variant="ghost"
                class="justify-start text-base">
                <a @click="isOpen = false" :href="href">{{ label }}</a>
              </Button>
            </div>
          </div>

          <SheetFooter class="flex-col sm:flex-col justify-start items-start">
            <Separator class="mb-2" />
            <ToggleTheme />
          </SheetFooter>
        </SheetContent>
      </Sheet>
    </div>

    <!-- Desktop Navigation -->
    <NavigationMenu class="hidden lg:block">
      <NavigationMenuList>
        <NavigationMenuItem>
          <NavigationMenuLink asChild>
            <div class="flex gap-2">
              <Button v-for="{ href, label } in routeList" :key="label" as-child variant="ghost" class="text-base">
                <a :href="href">{{ label }}</a>
              </Button>
            </div>
          </NavigationMenuLink>
        </NavigationMenuItem>
      </NavigationMenuList>
    </NavigationMenu>

    <!-- Right Controls -->
    <div class="hidden lg:flex items-center gap-2">
      <ToggleTheme />
      <Button as-child size="sm" variant="ghost" aria-label="View on GitHub">
        <a href="https://github.com/blackzeus" target="_blank"
          aria-label="View on GitHub">
          <GithubIcon class="size-5" />
        </a>
      </Button>
    </div>
  </header>
</template>

<style scoped>
.shadow-light {
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.085);
}

.shadow-dark {
  box-shadow: inset 0 0 5px rgba(255, 255, 255, 0.141);
}
</style>
