<script setup lang="ts">
import { onMounted, ref } from 'vue';

withDefaults(
    defineProps<{
        modelValue: string;
        rows?: number;
    }>(),
    {
        modelValue: '',
        rows: 4,
    }
);

defineEmits(['update:modelValue']);

const input = ref<HTMLTextAreaElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <textarea
        ref="input"
        class="border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-red-500 dark:focus:border-red-600 focus:ring-red-500 dark:focus:ring-red-600"
        :value="modelValue"
        :rows="rows"
        @input="
            $emit(
                'update:modelValue',
                ($event.target as HTMLTextAreaElement).value
            )
        "
    />
</template>
