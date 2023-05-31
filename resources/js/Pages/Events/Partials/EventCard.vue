<script setup lang="ts">
import { UserIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';

import date from '@/utils/date';
import { currencyFormat } from '@/utils/number';

defineProps<{
    item: App.Models.Event;
}>();
</script>

<template>
    <Link :href="route('events.show', item)">
        <div
            class="relative h-full rounded-sm shadow-sm bg-gray-50 group group-hover:bg-white"
        >
            <div
                class="block w-full overflow-hidden rounded-t-sm aspect-h-7 aspect-w-10 focus-within:ring-2 focus-within:ring-red-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100"
            >
                <img
                    :src="item.banner || 'https://via.placeholder.com/300'"
                    alt=""
                    class="object-cover pointer-events-none group-hover:opacity-75"
                />

                <button
                    type="button"
                    class="absolute inset-0 focus:outline-none"
                >
                    <span class="sr-only">
                        View details for {{ item.title }}
                    </span>
                </button>
            </div>

            <div class="px-4 py-3 space-y-2.5">
                <p
                    class="block text-lg font-semibold leading-6 text-gray-900 pointer-events-none"
                >
                    {{ item.title }}
                </p>

                <!-- prettier-ignore -->
                <p
                    class="block text-sm font-semibold text-red-700 pointer-events-none"
                >
                    {{ date(item.next_start_date).format('ddd, MMM DD, YYYY hh:mmA (zzz)') }}
                </p>

                <!-- prettier-ignore -->
                <p
                    class="block text-sm font-medium text-gray-600 pointer-events-none"
                >
                    {{ item.free ? 'Free' : `Starts at ${currencyFormat(item.price)}` }}
                </p>

                <div>
                    <p
                        class="text-sm font-medium text-gray-700 uppercase pointer-events-none"
                    >
                        {{ item.organizer?.name }}
                    </p>

                    <div class="flex items-center mt-0.5">
                        <UserIcon class="flex-shrink-0 w-4 h-4 text-gray-700" />

                        <p
                            class="ml-2 text-sm font-medium text-gray-700 pointer-events-none"
                        >
                            {{ 0 }} attendees
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </Link>
</template>
