<template>
    <Head title="ثبت آگهی" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold dark:text-white text-xl text-gray-800 leading-tight"
            >
                ویرایش آگهی جذب کارآموز
            </h2>
        </template>

        <div
            class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
        >
            <div class="flex flex-col justify-between">
                <div>
                    <div class="mb-5 py-2 px-2 w-full">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-x-6 gap-y-4 sm:gap-x-2"
                        >
                            <div>
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    مهارتهای اصلی
                                </label>
                                <input
                                    class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    autofocus
                                    v-model="form.skill"
                                />
                                <p class="text-red-600">
                                    {{ $page.props.errors.skill }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    تعداد
                                </label>
                                <input
                                    class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.number"
                                    type="number"
                                />
                                <p class="text-red-600">
                                    {{ $page.props.errors.number }}
                                </p>
                            </div>
                        </div>

                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            شرحی از وظایف
                        </label>

                        <input
                            class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            v-model="form.text"
                        />
                        <p class="text-red-600">
                            {{ $page.props.errors.text }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-row justify-between mb-4">
                    <button
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white hover:border-transparent dark:bg-gray-800 dark:text-blue-400 dark:border-blue-400 dark:hover:bg-blue-500 dark:hover:text-white dark:hover:border-transparent"
                        as="button"
                        type="button"
                        @click="submit"
                    >
                        ویرایش آگهی
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";
import DatePicker from "vue3-persian-datetime-picker";

const props = defineProps({
    intern: Object,
});

const form = useForm({
    skill: props.intern.skill,

    number: props.intern.number,

    text: props.intern.text,
    company_id: props.intern.company_id,
});
function submit() {
    form.put(route("intern.update", props.intern.id), {});
}
</script>
