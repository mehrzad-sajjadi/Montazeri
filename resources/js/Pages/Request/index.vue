<template>
    <Head title="ُstudent Reports" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <div class="flex flex-col">
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                    >
                        لیست درخواستهای کارآموزی
                    </h2>
                </div>
            </div>
        </template>

        <div class="flex justify-center py-4">
            <Table :headers="props.header" :arrays="requests"></Table>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
const props = defineProps({
    requests: Object,
    header: Object,
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
} from "@heroicons/vue/24/solid";
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>
