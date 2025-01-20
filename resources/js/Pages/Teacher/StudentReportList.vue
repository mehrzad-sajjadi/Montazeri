<template>
    <Head title="ُstudent Reports" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <div class="flex flex-col">
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                    >
                        لیست گزارشات
                        {{ student.user_name }} {{ student.last_name }}
                    </h2>

                    <p>
                        مجموع ساعت های گزرانده از کارآموزی :
                        {{ totalTime }}
                        <br />
                        میزان ساعت باقی مانده:
                        {{ reminder }}
                    </p>
                </div>
                <div class="flex flex-row">
                    <!-- route('teacher.student.company', student.id) -->
                    <Link
                        :href="route('teacher.student.company', student.id)"
                        as="button"
                        type="button"
                        class="h-8 px-4 flex items-center m-2 text-sm transition-colors duration-150 bg-[#6c757d] hover:bg-[#757b80] rounded-lg text-white border border-[#6c757d] hover:border-transparent"
                    >
                        اطلاعات شرکت
                        <BuildingOfficeIcon class="size-5"></BuildingOfficeIcon>
                    </Link>
                    <button
                        @click="remove(student.id)"
                        :href="route('teacher.student.delete', student.id)"
                        as="button"
                        type="button"
                        class="h-8 px-4 m-2 flex items-center text-sm text-white duration-150 rounded-lg bg-red-600 dark:bg-red-700 border-red-600 dark:border-red-700 border hover:border-black dark:hover:border-white"
                    >
                        حذف دانشجو
                        <UserMinusIcon class="size-5"></UserMinusIcon>
                    </button>
                </div>
            </div>
        </template>

        <div class="flex justify-center py-4">
            <Table :headers="props.header" :arrays="reports"></Table>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    reports: Object,
    header: Object,
    student: Object,
    totalTime: String,
    reminder: String,
});
function remove(id) {
    if (confirm("آیا از حذف دانشجو مطمئن هستید ؟ ")) {
        router.delete(route("teacher.student.delete", id));
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
