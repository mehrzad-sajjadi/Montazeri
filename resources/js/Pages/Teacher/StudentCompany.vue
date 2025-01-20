<template>
    <Head title="محل کارآموزی دانشجو" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-white leading-tight"
            >
                اطلاعات محل کارآموزی
                {{ student.user_name }}
                {{ student.last_name }}
            </h2>
        </template>

        <div
            class="flex flex-col w-full lg:w-5/6 mx-auto my-8 p-6 border border-gray-300 dark:border-gray-500 rounded-lg bg-white dark:bg-gray-800 shadow-md"
        >
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6"
            >
                <div>
                    <label
                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        نام شرکت
                    </label>
                    <p
                        class="w-full p-3 text-gray-900 dark:text-white border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700"
                    >
                        {{ student.company }}
                    </p>
                </div>

                <div>
                    <label
                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        تلفن
                    </label>
                    <p
                        class="w-full p-3 text-gray-900 dark:text-white border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700"
                    >
                        {{ student.phone }}
                    </p>
                </div>

                <div>
                    <label
                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        نام سرپرست
                    </label>
                    <p
                        class="w-full p-3 text-gray-900 dark:text-white border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700"
                    >
                        {{ student.boss_name }}
                    </p>
                </div>

                <div>
                    <label
                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        تاریخ شروع کارآموزی
                    </label>
                    <p
                        class="w-full p-3 text-gray-900 dark:text-white border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700"
                    >
                        {{ start_date }}
                    </p>
                </div>
            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6"
            >
                <div>
                    <label
                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        سمت
                    </label>
                    <p
                        class="w-full p-3 text-gray-900 dark:text-white border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700"
                    >
                        {{ student.position }}
                    </p>
                </div>
                <div>
                    <label
                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        آدرس
                    </label>
                    <p
                        class="w-full p-3 text-gray-900 dark:text-white border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700"
                    >
                        {{ student.address }}
                    </p>
                </div>
            </div>

            <div class="pb-11">
                <label
                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                >
                    روزهای کارآموزی
                </label>
                <ul class="text-gray-900 dark:text-white flex flex-row">
                    <li v-for="(day, index) in days" :key="index" class="mx-5">
                        <span>{{ day }}</span>
                    </li>
                </ul>
            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6"
            >
                <div class="flex flex-row justify-between">
                    <Link
                        :href="route('teacher.student.reports', student.id)"
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
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage, Link } from "@inertiajs/vue3";
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";
import DatePicker from "vue3-persian-datetime-picker";

const props = defineProps({
    student: Object,
    start_date: String,
    days: Object,
});
</script>
