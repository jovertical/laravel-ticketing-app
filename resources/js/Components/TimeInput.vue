<script setup lang="ts">
import { ClockIcon } from '@heroicons/vue/24/outline';
import { computed } from 'vue';

import TextInput from '@/Components/TextInput.vue';
import type { TextInputProps } from '@/Components/TextInput.vue';

defineProps<TextInputProps>();

let maskOptions = computed(() => ({
    mask: (value: string) => {
        if (parseInt(value[0]) === 1) {
            return 'AB:CD EM';
        }

        return '0A:CD EM';
    },

    maskTokens: {
        A: { pattern: /[0-9]/ },
        B: { pattern: /[0-2]/ },
        C: { pattern: /[0-5]/ },
        D: { pattern: /[0-9]/ },
        E: {
            pattern: /[APap]/,
            transform: (value: string) => value.toUpperCase(),
        },
    },
}));
</script>

<template>
    <TextInput
        class="block w-full mt-1"
        required
        placeholder="__:__ AM/PM"
        :modelValue="modelValue"
        @update:modelValue="($event) => $emit('update:modelValue', $event)"
        v-bind="maskOptions"
    >
        <template #trailingIcon>
            <ClockIcon class="w-5 h-5 text-gray-400" />
        </template>
    </TextInput>
</template>
