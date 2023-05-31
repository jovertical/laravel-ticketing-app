<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EventsList from '@/Pages/Events/Partials/EventsList.vue';
import type { PaginatedCollection } from '@/types';

let props = defineProps<{
    events: PaginatedCollection<App.Models.Event>;
}>();
</script>

<template>
    <Head title="Explore" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Explore
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Explore upcoming & currently happening events. You can also
                create your own events and others can join.
            </p>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <EventsList :items="props.events" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
