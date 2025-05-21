<script setup lang="ts">
import { computed } from 'vue';
import { Dialog, DialogContent, DialogDescription, DialogHeader, DialogTitle, DialogClose } from '@/components/ui/dialog';
import TaskForm from './TaskForm.vue';
import { XMarkIcon } from '@heroicons/vue/24/outline';

const props = defineProps<{
  open: boolean;
  task?: {
    id: number;
    title: string;
    description: string;
    status: string;
    due_date: string;
  };
}>();

const emit = defineEmits<{
  (e: 'update:open', value: boolean): void;
}>();

const modalOpen = computed({
  get: () => props.open,
  set: (value: boolean) => emit('update:open', value),
});

function closeModal() {
  emit('update:open', false);
}
</script>

<template>
  <Dialog v-model:open="modalOpen">
    <DialogContent class="sm:max-w-lg">
      <DialogHeader>
        <DialogTitle>{{ props.task ? 'Edit Task' : 'Create Task' }}</DialogTitle>
        <DialogDescription class="text-sm text-muted-foreground">
          Fill out the task details below.
        </DialogDescription>

        <!-- Close Button -->
        <DialogClose as-child>
          <button aria-label="Close" @click="closeModal"
            class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
            <XMarkIcon class="h-5 w-5" />
          </button>
        </DialogClose>
      </DialogHeader>

      <TaskForm :task="task" :onClose="closeModal" />
    </DialogContent>
  </Dialog>
</template>
