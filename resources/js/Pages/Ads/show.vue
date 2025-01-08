<template>
    <Head title="ثبت آگهی" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2
                    class="font-semibold dark:text-white text-xl text-gray-800 leading-tight"
                >
                    جزئیات آگهی جذب کارآموز
                </h2>
                <Link
                    :href="route('company.show', props.intern.company_id)"
                    as="button"
                    type="button"
                    class="h-8 px-4 flex items-center m-2 text-sm transition-colors duration-150 bg-[#6c757d] hover:bg-[#757b80] rounded-lg text-white border border-[#6c757d] hover:border-transparent"
                >
                    اطلاعات شرکت
                    <BuildingLibraryIcon class="size-5"></BuildingLibraryIcon>
                </Link>
            </div>
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
                                <p
                                    class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    {{ intern.skill }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    تعداد
                                </label>
                                <p
                                    class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    {{ intern.number }}
                                </p>
                            </div>
                        </div>

                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            شرحی از وظایف
                        </label>

                        <p
                            class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            {{ intern.text }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-row justify-between mb-4">
                    <Link
                        :href="route('intern.index')"
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

const props = defineProps({
    intern: Object,
});

import {
    TrashIcon,
    EyeIcon,
    PencilSquareIcon,
    PlusCircleIcon,
    ClipboardDocumentListIcon,
    HandThumbDownIcon,
    CheckBadgeIcon,
    UserPlusIcon,
    FolderPlusIcon,
    NewspaperIcon,
    BuildingLibraryIcon,
} from "@heroicons/vue/24/solid";
</script>
