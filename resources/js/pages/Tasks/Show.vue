<script lang="ts" setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { CalendarDaysIcon, ArrowLeftIcon } from '@heroicons/vue/24/solid';
import { format, parseISO } from 'date-fns';
import TaskCreateDialog from '@/components/tasks/TaskCreateDialog.vue';
import TaskDeleteDialog from '@/components/tasks/TaskDeleteDialog.vue';
import { ref } from 'vue';

const showEditDialog = ref(false);
const showDeleteDialog = ref(false);




const props = defineProps<{
  task: {
    id: number;
    title: string;
    description?: string;
    status: string;
    due_date?: string;
    created_at?: string;
    updated_at?: string;
  };
}>();

const breadcrumbs = [
  { title: 'Home', href: '/' },
  { title: 'Tasks', href: '/tasks' },
  { title: props.task.title, href: `/tasks/${props.task.id}` },
];

const formattedDueDate = props.task.due_date
  ? format(parseISO(props.task.due_date), 'MMMM d, yyyy')
  : 'No due date';
</script>

<template>

  <Head :title="task.title" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="px-6 py-4">
      <div class="mb-6">
        <Link href="/tasks" class="inline-flex items-center gap-2 text-sm text-muted-foreground hover:underline">
        <ArrowLeftIcon class="w-4 h-4" />
        Back to tasks
        </Link>
      </div>

      <div
        class="bg-white dark:bg-white/5 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm space-y-6">
        <div>
          <h1 class="text-2xl font-semibold text-gray-900 dark:text-white py-2">{{ task.title }}</h1>
          <p class="text-sm font-medium py-2">
            Status:
            <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold capitalize" :class="{
              'bg-green-100 text-green-700 dark:bg-green-900/20 dark:text-green-300': task.status === 'completed',
              'bg-orange-100 text-orange-700 dark:bg-orange-900/20 dark:text-orange-300': task.status === 'pending',
              'bg-gray-100 text-gray-700 dark:bg-gray-900/20 dark:text-gray-300': task.status === 'new',
            }">
              {{ task.status }}
            </span>
          </p>

        </div>

        <div v-if="task.description">
          <h2 class="text-sm font-medium text-gray-500 dark:text-gray-300">Description</h2>
          <p class="mt-1 text-gray-700 dark:text-white/90">{{ task.description }}</p>
        </div>

        <div>
          <h2 class="text-sm font-medium text-gray-500 dark:text-gray-300">Due Date</h2>
          <p class="mt-1 flex items-center gap-2 text-sm text-gray-700 dark:text-white/90">
            <CalendarDaysIcon class="w-4 h-4" />
            {{ formattedDueDate }}
          </p>
        </div>
      </div>

      <div class="mt-4 flex gap-3 justify-end px-6">
        <button @click="showEditDialog = true"
          class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md">
          Edit Task
        </button>
        <button @click="showDeleteDialog = true"
          class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-md">
          Delete Task
        </button>
      </div>

    </div>
  </AppLayout>

  <TaskCreateDialog v-model:open="showEditDialog" :task="task" />
  <TaskDeleteDialog v-model:open="showDeleteDialog" :task-id="task.id" />

</template>
