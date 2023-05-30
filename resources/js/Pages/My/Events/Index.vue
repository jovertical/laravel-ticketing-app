<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import date from '@/utils/date';
import { currencyFormat } from '@/utils/number';

let props = defineProps<{
    events: App.Models.Event[];
}>();
</script>

<template>
    <Head title="Your Events" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Your Events
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1
                            class="text-base font-semibold leading-6 text-gray-900"
                        >
                            Events
                        </h1>

                        <p class="mt-2 text-sm text-gray-700">
                            A list of all the events you have created. You can
                            edit or delete them from here. You can also create a
                            new event.
                        </p>
                    </div>

                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <button
                            type="button"
                            class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Add event
                        </button>
                    </div>
                </div>

                <div class="flow-root mt-8">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                        >
                            <div
                                class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg"
                            >
                                <table
                                    class="min-w-full divide-y divide-gray-300"
                                >
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                Title
                                            </th>

                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Starts
                                            </th>

                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Ends
                                            </th>

                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Price
                                            </th>

                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Seats
                                            </th>

                                            <th
                                                scope="col"
                                                class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                            >
                                                <span class="sr-only">
                                                    Edit
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody
                                        class="bg-white divide-y divide-gray-200"
                                    >
                                        <!-- prettier-ignore -->
                                        <tr
                                            v-for="event in events"
                                            :key="event.id"
                                        >
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6"
                                            >
                                                {{ event.title }}
                                            </td>

                                            <td
                                                class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap"
                                            >
                                                {{ date(event.start_date).format('MMM DD, YYYY') }}
                                            </td>

                                            <td
                                                class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap"
                                            >
                                                {{ date(event.end_date).format('MMM DD, YYYY') }}
                                            </td>

                                            <td
                                                class="px-3 py-4 text-sm text-yellow-500 whitespace-nowrap"
                                            >
                                                {{ currencyFormat(event.price) }}
                                            </td>

                                            <td
                                                class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap"
                                            >
                                                {{ event.seats }}
                                            </td>

                                            <td
                                                class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6"
                                            >
                                                <a
                                                    href="#"
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                >
                                                    Edit
                                                    <span class="sr-only">
                                                        ,{{ event.title }}
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
