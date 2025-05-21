<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils'
import { Primitive, type PrimitiveProps } from 'reka-ui'
import { type ButtonVariants, buttonVariants } from '.'

interface Props extends PrimitiveProps {
  variant?: ButtonVariants['variant']
  size?: ButtonVariants['size']
  class?: HTMLAttributes['class']
}

const props = withDefaults(defineProps<Props>(), {
  as: 'button',
})
</script>

<template>
  <Primitive
    :as="as"
    :as-child="asChild"
    :class="cn(
      buttonVariants({ variant, size }),
      'bg-[hsl(24.6,95%,53.1%)] text-white hover:bg-[hsl(24.6,95%,47%)] transition-colors duration-200 ease-in-out',
      props.class
    )"
  >
    <slot />
  </Primitive>
</template>

