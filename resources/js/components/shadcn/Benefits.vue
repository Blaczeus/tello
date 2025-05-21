<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from "@/components/shadcn/ui/card";

import {
  CheckSquare,
  Users,
  CalendarDays,
  BarChart2,
} from "lucide-vue-next";

interface BenefitsProps {
  icon: string;
  title: string;
  description: string;
}

const benefitList: BenefitsProps[] = [
  {
    icon: "checkSquare",
    title: "Simple Task Tracking",
    description:
      "Quickly add, organize, and complete tasks — all in one place, with minimal friction.",
  },
  {
    icon: "users",
    title: "Team Collaboration",
    description:
      "Assign tasks, leave feedback, and coordinate with your team effortlessly.",
  },
  {
    icon: "calendarDays",
    title: "Smart Scheduling",
    description:
      "Manage deadlines, set reminders, and stay ahead with integrated calendars.",
  },
  {
    icon: "barChart2",
    title: "Progress Insights",
    description:
      "Track progress across projects and identify blockers with visual reports.",
  },
];

const iconMap: Record<
  string,
  | typeof CheckSquare
  | typeof Users
  | typeof CalendarDays
  | typeof BarChart2
> = {
  checkSquare: CheckSquare,
  users: Users,
  calendarDays: CalendarDays,
  barChart2: BarChart2,
};
</script>

<template>
  <section id="features" class="w-full mx-auto px-10 md:px-6 xl:px-8 py-[6rem] sm:py-[8rem]"
    style="padding-right: 60px; padding-left: 60px;">
    <div class="grid lg:grid-cols-2 place-items-center lg:gap-24">
      <div>
        <h2 class="text-lg mb-2 tracking-wider" style="color: hsl(24.6 95% 53.1%)">
          Benefits
        </h2>

        <h2 class="text-3xl md:text-4xl font-bold mb-4">
          Work Smarter, Not Harder
        </h2>
        <p class="text-xl text-muted-foreground mb-8">
          Whether you're managing personal goals or leading a team, our task manager
          helps you stay on top of everything — without the chaos.
        </p>
      </div>

      <div class="grid lg:grid-cols-2 gap-4 w-full">
        <Card v-for="({ icon, title, description }, index) in benefitList" :key="title"
          class="transition-all delay-75 group/number" :class="[
            'hover:bg-[hsl(var(--background))]',
            'dark:hover:bg-[hsl(var(--background))]',
            'bg-[hsla(60,5%,96%,0.5)] dark:bg-[hsla(24,10%,8%,1)]'
          ]">
          <CardHeader>
            <div class="flex justify-between">
              <component class="size-8 mb-6" :style="{ color: 'hsl(24.6 95% 53.1%)' }" :is="iconMap[icon]" />

              <span
                class="text-5xl text-muted-foreground/15 font-medium transition-all delay-75 group-hover/number:text-muted-foreground/30">
                0{{ index + 1 }}
              </span>
            </div>

            <CardTitle>{{ title }}</CardTitle>
          </CardHeader>

          <CardContent class="text-muted-foreground">
            {{ description }}
          </CardContent>
        </Card>
      </div>


    </div>
  </section>
</template>

