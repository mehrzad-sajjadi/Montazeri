<template>
    <Head title="Create new Task" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-medium text-xl dark:text-white text-gray-800 leading-tight"
            >
                جزئیات گزارش تاریخ
                <span class="underline">
                    {{ date }}
                </span>

                {{ report.user_name }}
            </h2>
            <div>
                ساعت ورود
                {{ report.start_time }}
            </div>
        </template>

        <div
            class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
        >
            <div class="flex flex-col justify-between">
                <div>
                    <div class="mb-5 py-2 px-2 w-full">
                        <!-- عنوان گزارش -->
                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            عنوان گزارش
                        </label>

                        <!-- متن گزارش -->
                        <p
                            class="bg-white text-md rounded-lg py-5 px-3 shadow-md dark:bg-gray-800 dark:text-gray-300"
                        >
                            {{ report.text }}
                        </p>

                        <!-- تصویر گزارش -->
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
                        :href="
                            route(
                                'teacher.student.reports',
                                props.report.student_id
                            )
                        "
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
});

import { BuildingStorefrontIcon } from "@heroicons/vue/24/solid";
</script>
