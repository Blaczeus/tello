<script lang="ts" setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import TaskCard from '@/components/tasks/TaskCard.vue';
import { Plus } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import TaskCreateDialog from '@/components/tasks/TaskCreateDialog.vue';
import FilterModal from '@/components/tasks/FilterModal.vue';
import TaskTab from '@/components/tasks/TaskTab.vue';
import { ref } from 'vue';

interface Task {
  id: number;
  title: string;
  description: string;
  status: string;
  due_date?: string;
}
const props = defineProps<{
  tasks: {
    data: Task[];
    links: { url: string | null; label: string; active: boolean }[];
    meta: object;
  };
  counts: {
    all: number;
    todo: number;
    in_progress: number;
    completed: number;
  };
  active: string;
}>();

const showCreateDialog = ref(false);

const breadcrumbs = [
  { title: 'Home', href: '/' },
  { title: 'Tasks', href: '/tasks' },
];

const activeTab = ref(props.active);

const showFilter = ref(false);

function handleTabChange(status: string) {
  activeTab.value = status;

  router.get('/tasks', { status }, {
    preserveState: true,
    preserveScroll: true,
  })
}

const tabs = [
  { label: 'All Tasks', value: 'all', count: props.counts.all },
  { label: 'To do', value: 'todo', count: props.counts.todo },
  { label: 'In Progress', value: 'in_progress', count: props.counts.in_progress },
  { label: 'Completed', value: 'completed', count: props.counts.completed },
];

</script>

<template>

  <Head title="Tasks" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <!-- Header -->
    <div class="w-full max-w-screen-xl mx-auto mt-4 px-4 py-6 sm:px-6 lg:px-8 rounded-xl">
      <div class="max-w-screen-xl mx-auto flex flex-col gap-6 items-center">
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between w-full">

          <!-- Tabs Wrapper -->
          <div class="flex justify-center w-full xl:w-auto">
            <!-- Tabs -->
            <div class="flex flex-wrap items-center gap-x-1 gap-y-2 rounded-lg p-1 bg-gray-100 dark:bg-white/5">
              <TaskTab :tabs="tabs" v-model:active="activeTab" @update:active="handleTabChange" />
            </div>
          </div>

          <!-- Actions -->
          <div class="flex flex-wrap justify-center xl:justify-end items-center gap-3 w-full xl:w-auto">
            <!-- Filter Button -->
            <button v-if="props.counts.all >= 10" @click="showFilter = true" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium 
         text-gray-700 shadow-theme-xs hover:text-orange-600 
         dark:border-gray-700 dark:text-gray-400 dark:hover:text-orange-400 
         dark:hover:bg-white/[0.03]">
              <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M12.08 4.08C11.08 4.08 10.26 4.9 10.26 5.9C10.26 6.91 11.08 7.72 12.08 7.72C13.08 7.72 13.9 6.91 13.9 5.9C13.9 4.9 13.08 4.08 12.08 4.08ZM2.29 6.65H8.84C9.18 8.13 10.5 9.22 12.08 9.22C13.66 9.22 14.98 8.13 15.32 6.65H17.7C18.12 6.65 18.46 6.32 18.46 5.9C18.46 5.49 18.12 5.15 17.7 5.15H15.31C14.97 3.68 13.66 2.58 12.08 2.58C10.5 2.58 9.19 3.68 8.85 5.15H2.29C1.88 5.15 1.54 5.49 1.54 5.9C1.54 6.32 1.88 6.65 2.29 6.65ZM4.68 13.35H2.29C1.88 13.35 1.54 13.68 1.54 14.1C1.54 14.51 1.88 14.85 2.29 14.85H4.68C5.02 16.32 6.34 17.42 7.91 17.42C9.49 17.42 10.81 16.32 11.15 14.85H17.71C18.12 14.85 18.46 14.51 18.46 14.1C18.46 13.68 18.12 13.35 17.71 13.35H11.15C10.81 11.87 9.49 10.78 7.91 10.78C6.34 10.78 5.02 11.87 4.68 13.35ZM9.74 14.1C9.74 13.09 8.92 12.28 7.91 12.28C6.91 12.28 6.1 13.09 6.1 14.1C6.1 15.1 6.91 15.92 7.91 15.92C8.92 15.92 9.74 15.1 9.74 14.1Z">
                </path>
              </svg>
              Filter & Sort
            </button>

            <FilterModal :show="showFilter" @close="showFilter = false" :initialSort="route().params.sort"
              :initialStatus="route().params.status" />


            <!-- Create Task Button -->
            <Button @click="showCreateDialog = true"
              class="bg-orange-500 hover:bg-orange-600 text-white rounded-lg px-4 py-2 text-sm font-medium flex items-center gap-2">
              <Plus class="w-4 h-4" />
              Create Task
            </Button>
            <TaskCreateDialog v-model:open="showCreateDialog" />
          </div>
        </div>
      </div>
    </div>


    <!-- Task List -->
    <div class="p-6">
      <ul v-if="tasks.data.length" class="space-y-2">
        <TaskCard v-for="task in tasks.data" :key="task.id" :task="task" />
      </ul>
      <p v-else class="text-muted-foreground">No tasks found.</p>

      <!-- Pagination -->
      <div v-if="props.counts.all >= 10" class="mt-6">
        <div class="flex justify-center gap-2 flex-wrap">
          <template v-for="link in tasks.links" :key="link.label">
            <Link v-if="link.url" :href="link.url" class="px-3 py-1 rounded-md text-sm" :class="{
              'bg-orange-500 text-white': link.active,
              'text-gray-500 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white': !link.active,
            }">{{ link.label }}</Link>
            <span v-else class="px-3 py-1 rounded-md text-sm text-gray-400 cursor-not-allowed" v-html="link.label" />
          </template>
        </div>
      </div>


    </div>
  </AppLayout>
</template>
