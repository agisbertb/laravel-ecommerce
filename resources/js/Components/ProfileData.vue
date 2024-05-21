<template>
    <div>
        <h2 class="text-xl font-semibold mb-4">Profile Data</h2>
        <UpdateProfileInformationForm :user="user" />
        <SectionBorder />
        <UpdatePasswordForm />
        <SectionBorder />
        <DeleteAccountSection />
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import UpdateProfileInformationForm from '@/Components/UpdateProfileInformationForm.vue';
import UpdatePasswordForm from '@/Components/UpdatePasswordForm.vue';
import DeleteAccountSection from '@/Components/DeleteAccountSection.vue';
import SectionBorder from "@/Components/SectionBorder.vue";

const props = defineProps({
    user: Object,
});
</script>
