<template>
  <Link :href="`/tasks/${task.id}`" class="block" draggable="true">
  <div
    class="p-5 bg-white border border-gray-200 rounded-xl shadow-theme-sm dark:border-gray-800 dark:bg-white/5 hover:ring-1 hover:ring-brand-500 transition"
    :class="{ 'opacity-60': checked }">
    <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
      <div class="flex items-start w-full gap-4">
        <span class="text-gray-400">
          <Bars3Icon class="w-5 h-5" />
        </span>

        <div class="w-full">
          <div class="flex items-start gap-2">
            <input type="checkbox" :id="`taskCheckbox-${task.id}`"
              class="shrink-0 mt-1 h-5 w-5 text-brand-500 border-gray-300 rounded dark:border-gray-700"
              v-model="checked" @change="toggleStatus" @click.stop />
            <div class="ml-2.5">
              <p :class="[
                'text-base font-medium',
                checked ? 'line-through text-gray-400 dark:text-gray-500' : 'text-gray-800 dark:text-white/90'
              ]">
                {{ task.title }}
              </p>

              <p v-if="task.description" :class="[
                'text-sm text-muted-foreground mt-0.5 line-clamp-1',
                checked ? 'line-through opacity-60' : ''
              ]">
                {{ task.description }}
              </p>


            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-col-reverse items-start justify-end w-full gap-3 xl:flex-row xl:items-center xl:gap-5">
        <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium opacity-100" :class="task.status === 'completed'
          ? 'bg-green-100 text-green-600 dark:bg-green-500/15 dark:text-green-400'
          : 'bg-yellow-100 text-yellow-600 dark:bg-yellow-500/15 dark:text-yellow-400'">
          {{ capitalizedStatus }}
        </span>

        <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
          <span class="flex items-center gap-1" :class="checked ? 'line-through opacity-60' : ''">
            <CalendarDaysIcon class="w-4 h-4" />
            {{ formattedDueDate }}
          </span>
        </div>
      </div>
    </div>
  </div>
  </Link>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { Bars3Icon, CheckIcon, CalendarDaysIcon } from '@heroicons/vue/24/solid'
import { format, isToday, isTomorrow, parseISO } from 'date-fns'
import { router } from '@inertiajs/vue3'


const props = defineProps({
  task: {
    type: Object,
    required: true,
  },
})

const checked = ref(props.task.status === 'completed')

const capitalizedStatus = computed(() =>
  props.task.status.charAt(0).toUpperCase() + props.task.status.slice(1)
)

const formattedDueDate = computed(() => {
  if (!props.task.due_date) return 'No due date'
  const due = parseISO(props.task.due_date)
  if (isToday(due)) return 'Today'
  if (isTomorrow(due)) return 'Tomorrow'
  return format(due, 'MMMM d, yyyy')
})

const toggleStatus = () => {
  const newStatus = checked.value ? 'completed' : 'pending'

  router.patch(`/tasks/${props.task.id}/status`, {
    status: newStatus,
  }, {
    preserveScroll: true,
    onSuccess: () => {
      checked.value = newStatus === 'completed'
    },
    onError: () => {
      checked.value = !checked.value
    },
  })
}
</script>
