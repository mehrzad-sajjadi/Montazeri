<template>
    <Head title="Teacher" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                >
                    لیست اگهی های کارآموزی
                </h2>
            </div>
        </template>
        <div class="flex justify-center py-4">
            <input
                type="text"
                placeholder="چه مهارتی داری ؟"
                v-model="search"
                @input="submitSearch"
                class="w-[300px] px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:border-gray-700 focus:ring-gray-300 dark:focus:ring-gray-600"
            />
        </div>

        <div class="flex justify-center py-4">
            <Table :headers="props.header" :arrays="ads"></Table>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    ads: Object,
    header: Object,
});

const search = ref(props.search || "");

// ارسال درخواست جستجو به بک‌اند
const submitSearch = () => {
    router.get(
        route("intern.index"),
        { search: search.value },
        { preserveState: true } // جلوگیری از رفرش مجدد صفحه
    );
};

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
} from "@heroicons/vue/24/solid";
</script>
