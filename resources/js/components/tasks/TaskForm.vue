<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import Textarea from '@/components/TextArea.vue';
import { Button } from '@/components/ui/button';
import {
  Dialog,
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog';
import { watch } from 'vue';
import { ref } from 'vue';
const showConfirmation = ref(false);


const props = defineProps<{
  task?: {
    id: number;
    title: string;
    description: string;
    status: string;
    due_date: string;
  };
  onClose: () => void;
}>();

console.log('Task due_date:', props.task?.due_date);
console.log('Formatted:', props.task?.due_date?.split('T')[0]);

const isEditing = computed(() => !!props.task);

const today = new Date().toISOString().split('T')[0];

function formatDateToInput(dateString: string) {
  const date = new Date(dateString.replace(' ', 'T'));
  if (isNaN(date.getTime())) return '';
  return date.toISOString().split('T')[0];
}

const form = useForm({
  title: props.task?.title ?? '',
  description: props.task?.description ?? '',
  status: props.task?.status ?? 'pending',
  due_date: props.task?.due_date
    ? formatDateToInput(props.task.due_date)
    : '',
});

watch(
  () => props.task,
  (newTask) => {
    if (newTask) {
      form.title = newTask.title;
      form.description = newTask.description;
      form.status = newTask.status;
      form.due_date = formatDateToInput(newTask.due_date);
    }
  },
  { immediate: true }
);

const submit = (e: Event) => {
  e.preventDefault();

  if (
    isEditing.value &&
    form.due_date &&
    form.due_date < today
  ) {
    showConfirmation.value = true;
    return;
  }

  performSubmit();
};

const performSubmit = () => {
  const method = isEditing.value ? 'put' : 'post';
  const url = isEditing.value
    ? route('tasks.update', props.task!.id)
    : route('tasks.store');

  form[method](url, {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      props.onClose();
    },
  });
};

</script>

<template>
  <form @submit="submit" class="space-y-6">
    <div>
      <Label class="mb-1 block" for="title">Title</Label>
      <Input id="title" v-model="form.title" />
      <InputError :message="form.errors.title" />
    </div>

    <div>
      <Label class="mb-1 block" for="description">Description</Label>
      <Textarea id="description" v-model="form.description" rows="4" />
      <InputError :message="form.errors.description" />
    </div>

    <div>
      <Label class="mb-1 block" for="status">Status</Label>
      <select id="status" v-model="form.status"
        class="flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs outline-none transition-colors file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm
      border-input dark:bg-input/30 file:text-foreground selection:bg-primary selection:text-primary-foreground focus-visible:ring-2 focus-visible:ring-[hsl(24.6,95%,53.1%)] focus-visible:ring-offset-0 focus-visible:border-[hsl(24.6,95%,53.1%) aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive">
        <option value="" disabled>Select status</option>
        <option value="new">New</option>
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
      </select>
      <InputError :message="form.errors.status" />
    </div>

    <div>
      <Label class="mb-1 block" for="due_date">Due Date</Label>
      <Input id="due_date" type="date" v-model="form.due_date" :min="!isEditing ? today : undefined" />
      <InputError :message="form.errors.due_date" />
    </div>
    <div v-if="isEditing && form.due_date && form.due_date < today" class="text-sm text-red-600 mt-1">
      ⚠️ This task is past its due date.
    </div>



    <div class="flex justify-end gap-2 pt-4">
      <Button type="button" variant="secondary" @click="props.onClose">Cancel</Button>
      <Button type="submit" :disabled="form.processing">
        {{ isEditing ? 'Update Task' : 'Create Task' }}
      </Button>
    </div>
  </form>

  <Dialog v-model:open="showConfirmation">
    <DialogContent>
      <DialogHeader>
        <DialogTitle>Proceed with Past Due Date?</DialogTitle>
        <DialogDescription>
          This task has a due date in the past. Are you sure you want to save your changes?
        </DialogDescription>
      </DialogHeader>

      <DialogFooter class="gap-2">
        <DialogClose as-child>
          <Button variant="secondary" @click="showConfirmation = false">Cancel</Button>
        </DialogClose>
        <Button @click="performSubmit" :disabled="form.processing">
          Yes, Save Anyway
        </Button>
      </DialogFooter>
    </DialogContent>
  </Dialog>

</template>
