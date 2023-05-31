<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

import DateInput from '@/Components/DateInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import ImageUploader from '@/Components/ImageUploader.vue';
import MoneyInput from '@/Components/MoneyInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButtonLink from '@/Components/SecondaryButtonLink.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import TimeInput from '@/Components/TimeInput.vue';

let form = useForm({
    title: '',
    description: '',
    banner: null,
    start_date: '',
    start_time: '',
    end_date: '',
    end_time: '',
    price: '',
    seats: '',
});

let submit = () => {
    form.post(route('user.events.store'), {
        forceFormData: true,
    });
};
</script>

<template>
    <div
        class="w-full px-6 py-4 mt-6 bg-white shadow-md sm:max-w-2xl dark:bg-gray-800 sm:rounded"
    >
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Create a new event
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Fill in the form below to create a new event.
            </p>
        </header>

        <form class="relative mt-6 space-y-6" @submit.prevent="submit">
            <div class="w-full">
                <InputLabel for="title" value="Title" />

                <TextInput
                    id="title"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.title"
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="w-full">
                <InputLabel for="description" value="Description" />

                <TextareaInput
                    id="description"
                    class="block w-full mt-1"
                    v-model="form.description"
                />

                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div class="w-full">
                <InputLabel for="banner" value="Banner" />

                <ImageUploader
                    id="banner"
                    class="block w-full mt-1"
                    v-model="form.banner"
                />

                <InputError class="mt-2" :message="form.errors.banner" />
            </div>

            <div class="flex items-center w-full space-x-4">
                <div class="w-1/2">
                    <InputLabel for="start_date" value="Start Date" />

                    <!-- prettier-ignore -->
                    <DateInput
                                    id="start_date"
                                    class="block w-full mt-1"
                                    v-model="form.start_date"
                                    :disable-date="
                                        (date: Date) => {
                                            return date < new Date()
                                                || date > new Date(form.end_date)
                                        }
                                    "
                                />

                    <InputError
                        class="mt-2"
                        :message="form.errors.start_date"
                    />
                </div>

                <div class="w-1/2">
                    <InputLabel for="end_date" value="End Date" />

                    <!-- prettier-ignore -->
                    <DateInput
                                    id="end_date"
                                    class="block w-full mt-1"
                                    v-model="form.end_date"
                                    :disable-date="(date: Date) => date < new Date(form.start_date)"
                                    :disabled="!form.start_date"
                                />

                    <InputError class="mt-2" :message="form.errors.end_date" />
                </div>
            </div>

            <div class="flex items-center w-full space-x-4">
                <div class="w-1/2">
                    <InputLabel for="start_time" value="Start Time" />

                    <TimeInput
                        id="start_time"
                        class="block w-full mt-1"
                        v-model="form.start_time"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.start_time"
                    />
                </div>

                <div class="w-1/2">
                    <InputLabel for="end_time" value="End Time" />

                    <TimeInput
                        id="end_time"
                        class="block w-full mt-1"
                        v-model="form.end_time"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.end_time" />
                </div>
            </div>

            <div class="flex items-center w-full space-x-4">
                <div class="w-1/2">
                    <InputLabel for="price" value="Price" />

                    <MoneyInput
                        id="price"
                        class="block w-full mt-1"
                        v-model="form.price"
                    />

                    <InputError class="mt-2" :message="form.errors.price" />
                </div>

                <div class="w-1/2">
                    <InputLabel for="seats" value="Seats" />

                    <TextInput
                        id="seats"
                        type="number"
                        class="block w-full mt-1"
                        v-model="form.seats"
                    />

                    <InputError class="mt-2" :message="form.errors.seats" />
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4">
                <SecondaryButtonLink :href="route('user.events.index')">
                    Cancel
                </SecondaryButtonLink>

                <PrimaryButton
                    type="submit"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Save
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>
