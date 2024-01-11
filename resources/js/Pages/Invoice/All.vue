<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Invoices from './Partials/Invoices.vue';
import Form from './Partials/Form.vue';
import Modal from '@/Components/Modal.vue';
import { Head } from '@inertiajs/vue3';
import {ref} from 'vue';

const props = defineProps({
    invoices: Object
});

const invoiceAddModal = ref(false);
const emptyItem = {
    id: null,
    number: '',
    taxIdBuyer: '',
    taxIdSeller: '',
    productName: '',
    priceNET: 0,
    created: ''
}



let invoiceObject = {
        id: null,
        number: '',
        taxIdBuyer: '',
        taxIdSeller: '',
        productName: '',
        priceNET: 0,
        created: ''
    };

const showInvoiceAddModal = () => {
    invoiceAddModal.value = true;
    invoiceObject = {...emptyItem};
};

const closeInvoiceAddModal = () => {
    invoiceAddModal.value = false;
};

const onInvoiceItemEdit = (data) => {
    invoiceAddModal.value = true;
    invoiceObject = data;
}



</script>

<template>
    <Head title="Invoices" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoices</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <button @click="showInvoiceAddModal">Dodaj</button>
                </div>
                <Modal :show="invoiceAddModal" @close="closeInvoiceAddModal">
                        <Form :onAfterSubmit="closeInvoiceAddModal" :data="invoiceObject" />
                </Modal>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Invoices :invoices="invoices" :onItemEdit="onInvoiceItemEdit" />
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
