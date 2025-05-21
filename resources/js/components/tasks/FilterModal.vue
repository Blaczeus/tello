<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogClose,
} from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';

const props = defineProps<{
  show: boolean;
  initialSort?: string;
  initialSearch?: string;
  initialDateFrom?: string;
  initialDateTo?: string;
  initialStatus?: string;
}>();

const emit = defineEmits<{
  (e: 'close'): void;
}>();

// Filters
const sortBy = ref(props.initialSort || '');
const search = ref(props.initialSearch || '');
const dateFrom = ref(props.initialDateFrom || '');
const dateTo = ref(props.initialDateTo || '');
const status = ref(props.initialStatus || '');

const applyFilters = () => {
  router.get(route('tasks.index'), {
    sort: sortBy.value,
    search: search.value,
    date_from: dateFrom.value,
    date_to: dateTo.value,
    status: status.value,
  }, {
    preserveScroll: true,
    preserveState: true,
  });

  emit('close');
};

const resetFilters = () => {
  sortBy.value = '';
  search.value = '';
  dateFrom.value = '';
  dateTo.value = '';
  status.value = '';

  router.get(route('tasks.index'), {}, {
    preserveScroll: true,
    preserveState: true,
  });

  emit('close');
};
</script>

<template>
  <Dialog :open="show" @update:open="val => !val && emit('close')">
    <DialogContent class="max-w-md">
      <DialogHeader>
        <DialogTitle>Filter & Sort Tasks</DialogTitle>
        <DialogDescription>Refine your task list by combining filters.</DialogDescription>
      </DialogHeader>

      <div class="space-y-4">
        <div>
          <Label for="search">Search</Label>
          <Input v-model="search" id="search" placeholder="e.g. project name..." />
        </div>

        <div>
          <Label for="sort">Sort By</Label>
          <select v-model="sortBy" id="sort"
            class="w-full rounded-md border px-3 py-2 dark:bg-gray-800 dark:text-white">
            <option value="">-- Select --</option>
            <option value="newest">Newest First</option>
            <option value="oldest">Oldest First</option>
            <option value="title-asc">Title A-Z</option>
            <option value="title-desc">Title Z-A</option>
          </select>
        </div>

        <div>
          <Label for="status">Status</Label>
          <select v-model="status" id="status"
            class="w-full rounded-md border px-3 py-2 dark:bg-gray-800 dark:text-white">
            <option value="">-- All --</option>
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
          </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <Label for="date_from">From Date</Label>
            <Input id="date_from" type="date" v-model="dateFrom" />
          </div>
          <div>
            <Label for="date_to">To Date</Label>
            <Input id="date_to" type="date" v-model="dateTo" />
          </div>
        </div>
      </div>

      <DialogFooter class="mt-6 gap-2">
        <Button variant="secondary" @click="resetFilters">Clear</Button>
        <DialogClose as-child>
          <Button @click="applyFilters">Apply</Button>
        </DialogClose>
      </DialogFooter>
    </DialogContent>
  </Dialog>
</template>
