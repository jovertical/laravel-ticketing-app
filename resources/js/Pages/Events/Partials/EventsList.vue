<script setup lang="ts">
import EventCard from '@/Pages/Events/Partials/EventCard.vue';
import type { PaginatedCollection } from '@/types';

defineProps<{
    items: PaginatedCollection<App.Models.Event>;
}>();
</script>

<template>
    <ul
        role="list"
        class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8"
    >
        <li v-for="event in items.data" :key="event.id">
            <EventCard :item="event" class="h-full" />
        </li>
    </ul>
</template>
