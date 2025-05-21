<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';

// Props
const props = defineProps<{
    taskId: number;
    redirectTo?: string;
}>();

const form = useForm({});

const deleteTask = (e: Event) => {
    e.preventDefault();

    form.delete(route('tasks.destroy', props.taskId), {
        preserveScroll: true,
        onSuccess: () => {
            if (props.redirectTo) {
                window.location.href = props.redirectTo;
            }
        },
    });
};
</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button variant="destructive" size="sm">Delete Task</Button>
        </DialogTrigger>
        <DialogContent>
            <form @submit="deleteTask" class="space-y-6">
                <DialogHeader>
                    <DialogTitle>Are you sure?</DialogTitle>
                    <DialogDescription>
                        This will permanently delete the task. This action cannot be undone.
                    </DialogDescription>
                </DialogHeader>

                <DialogFooter class="gap-2">
                    <DialogClose as-child>
                        <Button type="button" variant="secondary">Cancel</Button>
                    </DialogClose>
                    <Button type="submit" variant="destructive" :disabled="form.processing">
                        Confirm Delete
                    </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
