<template>
    <div
        aria-live="assertive"
        class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start"
    >
        <div class="flex flex-col items-center w-full space-y-4 sm:items-end">
            <transition
                enter-active-class="transition duration-300 ease-out transform"
                enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                leave-active-class="transition duration-100 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    v-if="notification.show.value && notification.data.value"
                    class="w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5"
                >
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <!-- prettier-ignore -->
                                <CheckCircleIcon
                                    v-if="notification.data.value.type === 'success'"
                                    class="w-6 h-6 text-green-500"
                                    aria-hidden="true"
                                />

                                <!-- prettier-ignore -->
                                <XCircleIcon
                                    v-if="notification.data.value.type === 'failure'"
                                    class="w-6 h-6 text-red-500"
                                    aria-hidden="true"
                                />
                            </div>

                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ notification.data.value.title }}
                                </p>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ notification.data.value.message }}
                                </p>
                            </div>

                            <div class="flex flex-shrink-0 ml-4">
                                <button
                                    type="button"
                                    class="inline-flex text-gray-500 bg-white rounded-md hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    @click="notification.hide()"
                                >
                                    <span class="sr-only">Close</span>
                                    <XMarkIcon
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useNotification } from '@/use/notification';
import { CheckCircleIcon, XCircleIcon } from '@heroicons/vue/24/outline';
import { XMarkIcon } from '@heroicons/vue/24/solid';

let notification = useNotification();
</script>
