<script setup lang="ts">
import { vMaska } from 'maska';
import type { MaskTokens } from 'maska';
import { ref, computed, onMounted } from 'vue';

interface Props {
    mask?: string | ((value: string) => string);
    maskTokens?: MaskTokens;
    maskEager?: boolean;
    modelValue: string | number;
    placeholder?: string;
    type?: HTMLInputElement['type'];
}

export type TextInputProps = Props;

let props = withDefaults(defineProps<Props>(), {
    mask: '',
    maskTokens: undefined,
    maskEager: false,
    modelValue: '',
    placeholder: '',
    type: 'text',
});

defineEmits(['update:modelValue']);

let input = ref<HTMLInputElement | null>(null);

let maskOptions = computed(() => {
    return {
        mask: props.mask,
        tokens: props.maskTokens,
        eager: props.maskEager,
    };
});

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <div class="relative rounded-md shadow-sm">
        <div
            v-if="$slots.leadingIcon"
            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
        >
            <slot name="leadingIcon" />
        </div>

        <input
            ref="input"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6"
            :class="{
                'px-3': !$slots.leadingIcon && !$slots.trailingIcon,
                'pl-9 pr-3': $slots.leadingIcon,
                'pl-3 pr-9': $slots.trailingIcon,
            }"
            :type="type"
            v-maska:[maskOptions]
            :placeholder="placeholder"
            :value="modelValue"
            @input="
                $emit(
                    'update:modelValue',
                    ($event.target as HTMLInputElement).value
                )
            "
        />

        <div
            v-if="$slots.trailingIcon"
            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none"
        >
            <slot name="trailingIcon" />
        </div>
    </div>
</template>
