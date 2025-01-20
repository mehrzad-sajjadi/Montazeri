<template>
    <Head title="ُstudent Reports" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                >
                    لیست دانشجویان
                    {{ teacher.name }}
                    {{ teacher.last_name }}
                </h2>
                <button
                    @click="deleteTeacher(props.teacher.id)"
                    as="button"
                    type="button"
                    class="h-8 px-4 m-2 flex items-center text-sm text-white duration-150 rounded-lg bg-red-600 dark:bg-red-700 border-red-600 dark:border-red-700 border hover:border-black dark:hover:border-white"
                >
                    حذف استاد
                    <UserMinusIcon class="size-5"></UserMinusIcon>
                </button>
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
    teacher: Object,
});

function deleteTeacher(id) {
    if (confirm("آیا از حذف استاد مورد نظر مطمئن هستید ؟")) {
        router.delete(route("faculty.teacher.delete", id));
    }
}
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
    UserMinusIcon,
} from "@heroicons/vue/24/solid";
</script>
