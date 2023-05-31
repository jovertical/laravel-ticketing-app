<script setup lang="ts">
import { CurrencyDollarIcon } from '@heroicons/vue/24/outline';
import { computed } from 'vue';

import TextInput from '@/Components/TextInput.vue';
import type { TextInputProps } from '@/Components/TextInput.vue';

defineProps<TextInputProps>();

let maskOptions = computed(() => ({
    mask: '0.99',

    maskTokens: {
        0: { pattern: /[0-9]/, multiple: true },
        9: {
            pattern: /[0-9]/,
            optional: true,
            transform: (value: string) => (value.length > 2 ? '' : value),
        },
    },
}));
</script>

<template>
    <TextInput
        class="block w-full mt-1"
        required
        :modelValue="modelValue"
        @update:modelValue="($event) => $emit('update:modelValue', $event)"
        v-bind="maskOptions"
    >
        <template #trailingIcon>
            <CurrencyDollarIcon class="w-5 h-5 text-gray-400" />
        </template>
    </TextInput>
</template>
