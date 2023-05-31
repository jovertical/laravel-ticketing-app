<script setup lang="ts">
import { PhotoIcon } from '@heroicons/vue/24/solid';
import { ref, watch } from 'vue';

interface Props {
    modelValue: File | null;
}

let props = withDefaults(defineProps<Props>(), {
    modelValue: null,
});

let emit = defineEmits<{
    (event: 'update:modelValue', value: File | null): void;
}>();

let photo = ref<File | null>(props.modelValue);

let loadedPhoto = ref<HTMLInputElement | null>(null);

watch(
    () => photo.value,
    (newPhoto) => {
        emit('update:modelValue', newPhoto);
    }
);

let loadPhoto = (event: Event) => {
    let newPhoto = (event.target as HTMLInputElement).files?.[0];

    if (!newPhoto) {
        return;
    }

    photo.value = newPhoto;

    if (loadedPhoto.value) {
        loadedPhoto.value.src = URL.createObjectURL(newPhoto);
    }
};

defineExpose({ loadedPhoto });
</script>

<template>
    <div>
        <div
            v-if="!photo"
            class="flex justify-center px-6 py-10 border border-dashed rounded-lg border-gray-900/25"
        >
            <div class="text-center">
                <PhotoIcon
                    class="w-12 h-12 mx-auto text-gray-300"
                    aria-hidden="true"
                />

                <div class="flex mt-4 text-sm leading-6 text-gray-600">
                    <label
                        for="file-upload"
                        class="relative font-semibold text-red-600 bg-white rounded-md cursor-pointer focus-within:outline-none focus-within:ring-2 focus-within:ring-red-600 focus-within:ring-offset-2 hover:text-red-500"
                    >
                        <span>Upload a file</span>
                        <input
                            id="file-upload"
                            name="file-upload"
                            type="file"
                            class="sr-only"
                            accept="image/png, image/jpeg, image/gif"
                            :max="1"
                            @change="loadPhoto"
                        />
                    </label>

                    <p class="pl-1">or drag and drop</p>
                </div>

                <p class="text-xs leading-5 text-gray-600">
                    PNG, JPG, GIF up to 10MB
                </p>
            </div>
        </div>

        <div v-show="photo">
            <img
                class="object-cover object-center w-full h-56 rounded-lg aspect-video"
                ref="loadedPhoto"
            />
        </div>
    </div>
</template>
