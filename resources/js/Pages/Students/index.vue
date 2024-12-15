<template>
    <Head title="ُstudents" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    لیست دانشجویان شما
                </h2>
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
});
</script>
