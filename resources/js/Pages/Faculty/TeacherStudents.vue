<template>
    <Head title="ُstudent Reports" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                >
                    لیست دانشجویان
                    {{ teacher }}
                </h2>
                <!-- <Link
                    href="#"
                    as="button"
                    type="button"
                    class="h-8 px-4 flex items-center m-2 text-sm transition-colors duration-150 bg-[#6c757d] hover:bg-[#757b80] rounded-lg text-white border border-[#6c757d] hover:border-transparent"
                >
                    اطلاعات شرکت
                    <BuildingOfficeIcon class="size-5"></BuildingOfficeIcon>
                </Link> -->
            </div>
        </template>

        <div class="flex justify-center py-4">
            <Table :headers="props.header" :arrays="students"></Table>
        </div>
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
    teacher: String,
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
    BuildingOfficeIcon,
} from "@heroicons/vue/24/solid";
</script>
