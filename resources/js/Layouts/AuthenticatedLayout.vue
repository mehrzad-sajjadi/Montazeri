<script setup>
import { ref } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { useDark, useToggle, useLocalStorage } from "@vueuse/core";
import SideBar from "@/Components/SideBar.vue";

const menu = ref(usePage().props.menu);
const useStorage = useLocalStorage("showSidebar", true);

const isDark = useDark();
const toggleDark = useToggle(isDark);
console.log(isDark.value);
const showingNavigationDropdown = ref(false);

console.log(menu);

import {
    MoonIcon,
    SunIcon,
    UserIcon,
    UserCircleIcon,
    Bars3Icon,
} from "@heroicons/vue/24/solid";
</script>

<template>
    <div
        :class="[
            'fixed left-0 transition-all duration-300 h-screen overflow-y-auto',
            useStorage ? 'w-[calc(100%_-_300px)]' : 'w-full',
        ]"
        class="fixed left-0"
    >
        <div
            class="min-h-screen bg-gradient-to-r from-gray-100 via-gray-50 to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900"
        >
            <transition
                enter-active-class="transition-transform duration-300 ease"
                leave-active-class="transition-transform duration-300 ease"
                enter-from-class="translate-x-full"
                leave-to-class="translate-x-full"
            >
                <div v-if="useStorage" class="fixed top-0 right-0">
                    <SideBar :menu="menu"></SideBar>
                </div>
            </transition>

            <!-- Navigation -->
            <nav class="bg-white dark:bg-gray-800 shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <div class="flex items-center space-x-4">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Bars3Icon
                                    @click="
                                        () => {
                                            useStorage = !useStorage;
                                        }
                                    "
                                    class="size-8 cursor-pointer dark:text-white"
                                ></Bars3Icon>
                            </div>
                        </div>

                        <div class="flex items-center space-x-6">
                            <!-- Dark Mode Toggle -->
                            <button
                                class="text-gray-700 mx-6 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 p-2 rounded-full bg-gray-100 dark:bg-gray-700 shadow-md hover:shadow-lg transition"
                                @click="toggleDark()"
                            >
                                <span v-if="!isDark">
                                    <SunIcon class="h-6 w-6"></SunIcon>
                                </span>
                                <span v-else>
                                    <MoonIcon class="h-6 w-6"></MoonIcon>
                                </span>
                            </button>

                            <!-- Settings Dropdown -->
                            <div class="relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span
                                            class="inline-flex rounded-md shadow-md"
                                        >
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-gray-200 dark:hover:bg-gray-600 transition"
                                            >
                                                {{ $page.props.auth.user.name }}
                                                {{
                                                    $page.props.auth.user
                                                        .last_name
                                                }}
                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- <DropdownLink
                                            :href="route('profile.edit')"
                                            class="hover:text-blue-600 dark:hover:text-blue-400"
                                        >
                                            پروفایل
                                        </DropdownLink> -->
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                            class="hover:text-blue-600 dark:hover:text-blue-400"
                                        >
                                            خروج
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header
                class="bg-gray-50 dark:bg-gray-800 shadow-md dark:text-white"
            >
                <div
                    class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 dark:text-white"
                >
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot />
            </main>
        </div>
    </div>
</template>
