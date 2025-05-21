<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import TaskDeleteDialog from '@/components/tasks/TaskDeleteDialog.vue';


const breadcrumbs = [
  { title: 'Home', href: '/' },
  { title: 'Dashboard', href: '/dashboard' },
];

const props = defineProps<{
  tasks: Array<{
    id: number;
    title: string;
    status: string;
    due_date: string;
  }>;
  taskStats: {
    completed: number;
    pending: number;
    overdue: number;
    upcoming: number;
    total: number;
  };
}>();

</script>

<template>

  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-4 p-4 rounded-xl h-full">
      <!-- Stat Cards -->
      <div class="grid gap-4 md:grid-cols-3 auto-rows-min">
        <div v-for="card in [
          { label: 'Pending Tasks', value: taskStats.pending, link: '/tasks?status=in_progress' },
          { label: 'Total Tasks', value: taskStats.total, link: '/tasks' },
          { label: 'Completed Tasks', value: taskStats.completed, link: '/tasks?status=completed' }
        ]" :key="card.label"
          class="cursor-pointer transition hover:ring-1 hover:ring-brand-500 hover:scale-[1.01] bg-white border border-gray-200 dark:bg-white/5 dark:border-gray-800 shadow-theme-sm rounded-xl p-5"
          @click="$inertia.visit(card.link)">
          <div class="flex h-full flex-col justify-between">
            <div>
              <p class="text-sm text-muted-foreground mb-1">{{ card.label }}</p>
              <h2 class="text-3xl font-bold text-black dark:text-white">{{ card.value }}</h2>
            </div>
            <span class="text-sm text-orange-600 font-medium hover:underline mt-4">
              Go to {{ card.label }}
            </span>
          </div>
        </div>
      </div>


      <!-- Task List Area -->
      <div class="relative flex-1 p-4 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
        <div class="relative z-10">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-muted-foreground">Recent Tasks</h3>
          </div>

          <div v-if="tasks.length === 0"
            class="p-5 bg-white border border-gray-200 rounded-xl shadow-theme-sm dark:border-gray-800 dark:bg-white/5 text-center text-sm text-muted-foreground">
            No recent tasks to show.
          </div>

          <ul class="space-y-2">
            <li v-for="task in tasks" :key="task.id"
              class="p-5 bg-white border border-gray-200 rounded-xl shadow-theme-sm dark:border-gray-800 dark:bg-white/5 transition hover:ring-1 hover:ring-brand-500">
              <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex flex-col gap-1 text-sm text-muted-foreground">
                  <h4 class="text-base font-semibold text-black dark:text-white">{{ task.title }}</h4>
                  <div class="flex items-center gap-3">
                    <p v-if="task.status !== 'completed'" class="italic">Due: {{ new
                      Date(task.due_date).toLocaleDateString() }}</p>
                    <span class="text-xs px-2 py-1 rounded-full capitalize font-medium" :class="{
                      'bg-yellow-100 text-yellow-800': task.status === 'pending',
                      'bg-green-100 text-green-800': task.status === 'completed',
                      'bg-red-100 text-red-800': task.status === 'overdue'
                    }">
                      {{ task.status }}
                    </span>
                  </div>
                </div>
                <div class="flex items-center gap-2">
                  <a :href="`/tasks/${task.id}`"
                    class="px-3 py-1 rounded-md text-sm bg-orange-100 text-orange-800 hover:bg-orange-200">
                    View
                  </a>
                  <TaskDeleteDialog :task-id="task.id" />
                </div>
              </div>

            </li>
          </ul>

          <!-- View All Button -->
          <div class="mt-6">
            <Link href="/tasks"
              class="inline-block bg-orange-600 text-white px-4 py-2 rounded-md text-sm hover:bg-orange-700">
            View All Tasks
            </Link>
          </div>
        </div>
      </div>

    </div>
  </AppLayout>
</template>
