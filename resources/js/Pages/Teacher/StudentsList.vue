<template>
    <Head title="Teacher" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                >
                    لیست دانشجویان شما
                </h2>
            </div>
        </template>
        <!-- Searchbar -->
        <div class="flex justify-center py-4">
            <input
                type="text"
                placeholder="نام یا نام خانوادگی دانشجو را وارد کنید"
                v-model="search"
                @input="submitSearch"
                class="w-[300px] px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:border-gray-700 focus:ring-gray-300 dark:focus:ring-gray-600"
            />
        </div>
        <div class="flex justify-center py-4">
            <Table :headers="props.header" :arrays="students"></Table>
        </div>
        <p
            class="flex mb-15 flex-row justify-center dark:text-white text-xl text-center"
            v-if="$page.props.crud.success"
        >
            {{ $page.props.crud.success }}
        </p>
    </AuthenticatedLayout>
</template>
<script setup>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    students: Object,
    header: Object,
    search: String,
});
const search = ref(props.search || "");

// ارسال درخواست جستجو به بک‌اند
const submitSearch = () => {
    router.get(
        route("teacher.index"),
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
    NewspaperIcon,
} from "@heroicons/vue/24/solid";
</script>
