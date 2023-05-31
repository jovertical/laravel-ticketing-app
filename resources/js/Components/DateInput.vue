<script setup lang="ts">
import { ref, watch } from 'vue';
// @ts-ignore - VueTailwindDatepicker is not typed
import VueTailwindDatepicker from 'vue-tailwind-datepicker';

let props = withDefaults(
    defineProps<{
        modelValue?: string | string[];
        disabled?: boolean;
        formatter?: {
            date: string;
            month: string;
        };
    }>(),
    {
        modelValue: '',
        disabled: false,
        formatter: () => ({
            date: 'MMM DD, YYYY',
            month: 'MMM',
        }),
    }
);

let emit = defineEmits<{
    (event: 'update:modelValue', value: string | string[]): void;
}>();

// @ts-ignore
let modelValue = ref<string[]>([].concat(props.modelValue));
let formatter = ref(props.formatter);

watch(
    () => modelValue.value,
    (modelValue) => {
        emit(
            'update:modelValue',
            Array.isArray(props.modelValue) ? modelValue : modelValue[0]
        );
    }
);
</script>

<template>
    <vue-tailwind-datepicker
        class="border-gray-300 rounded-md shadow-sm focus:!border-none focus:!ring-2 focus:!ring-red-500"
        v-model="modelValue"
        :disabled="props.disabled"
        :formatter="formatter"
        as-single
    />
</template>
