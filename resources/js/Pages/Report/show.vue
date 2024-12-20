<template>
    <Head title="Create new Task" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-medium text-xl text-gray-800 leading-tight">
                جزئیات گزارش تاریخ
                <span class="underline">
                    {{ date }}
                </span>

                {{ report.user_name }}
            </h2>
        </template>

        <div
            class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
        >
            <div class="flex flex-col justify-between">
                <div>
                    <div class="mb-5 py-2 px-2 w-full">
                        <div class="flex flex-row justify-between">
                            <label
                                class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                            >
                                عنوان گزارش
                            </label>

                            <div
                                class="grid grid-cols-2 space-x-4 dark:text-white"
                            >
                                <div>
                                    ساعت ورود
                                    {{ start_time }}
                                </div>
                                <div>
                                    ساعت خروج
                                    {{ end_time }}
                                </div>
                            </div>
                        </div>

                        <p
                            class="bg-white text-md rounded-lg py-5 px-3 shadow-md dark:bg-gray-800 dark:text-gray-300"
                        >
                            {{ report.text }}
                        </p>

                        <div
                            v-if="image_url"
                            class="mt-4 flex justify-between items-center"
                        >
                            <img
                                :src="image_url"
                                alt="گزارش تصویری"
                                class="max-w-xs rounded-lg shadow-md border border-gray-300 dark:border-gray-700"
                            />
                        </div>
                    </div>
                </div>

                <div class="flex flex-row justify-between mb-4">
                    <a
                        v-if="image_url"
                        :href="image_url"
                        :download="image_name"
                        as="button"
                        type="button"
                        class="h-8 px-4 flex items-center m-2 text-sm text-indigo-100 transition-colors duration-150 bg-blue-500 hover:bg-blue-600 rounded-lg focus:shadow-outline"
                    >
                        دریافت گزارش
                        <ArrowDownTrayIcon class="size-5"></ArrowDownTrayIcon>
                    </a>

                    <Link
                        :href="route('report.index')"
                        type="button"
                        as="button"
                        class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                    >
                        بازگشت
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";
import DatePicker from "vue3-persian-datetime-picker";
import { ArrowDownTrayIcon } from "@heroicons/vue/24/solid";

const props = defineProps({
    report: Object,
    image_url: String,
    image_name: String,
    date: String,
    start_time: String,
    end_time: String,
});
</script>
