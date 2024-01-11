<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    onAfterSubmit: {
        type: Function
    },
    data: {
        id: null,
        number: '',
        taxIdBuyer: '',
        taxIdSeller: '',
        productName: '',
        priceNET: 0,
        created: ''
    }
});


const form = useForm({
    number: props.data.number,
    taxIdBuyer: props.data.taxIdBuyer,
    taxIdSeller: props.data.taxIdSeller,
    productName: props.data.productName,
    priceNET: (parseInt(props.data.priceNET) / 100).toFixed(2),
    created: props.data.created
});

const submit = () => {
    let url = route('invoice.create');
    if (!isNaN(props.data.id) && props.data.id > 0) {
        url = route('invoice.edit');
    }
    const priceNET = parseFloat(form.priceNET) * 100;

    form.transform((data) => ({
        ...data,
        priceNET: priceNET,
        id: props.data.id
    })).post(url, {
        onSuccess: () => {

            props.onAfterSubmit();
        }
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <div class="p-5">

            <div>
                <InputLabel for="number" value="Nr faktury" />

                <TextInput
                    id="number"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.number"
                    required
                    autofocus
                    autocomplete="number"
                />

                <InputError class="mt-2" :message="form.errors.number" />
            </div>

            <div class="mt-4">
                <InputLabel for="taxIdBuyer" value="NIP kupującego" />

                <TextInput
                    id="taxIdBuyer"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.taxIdBuyer"
                    required
                    autocomplete="taxIdBuyer"
                />

                <InputError class="mt-2" :message="form.errors.taxIdBuyer" />
            </div>

            <div class="mt-4">
                <InputLabel for="taxIdBuyer" value="NIP sprzedającego" />

                <TextInput
                    id="taxIdSeller"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.taxIdSeller"
                    required
                    autocomplete="taxIdSeller"
                />

                <InputError class="mt-2" :message="form.errors.taxIdSeller" />
            </div>
            <div class="mt-4">
                <InputLabel for="productName" value="Nazwa produktu" />

                <TextInput
                    id="productName"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.productName"
                    required
                    autocomplete="productName"
                />

                <InputError class="mt-2" :message="form.errors.productName" />
            </div>

            <div class="mt-4">
                <InputLabel for="priceNET" value="Kwota Netto" />

                <TextInput
                    id="priceNET"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.priceNET"
                    required
                    autocomplete="priceNET"
                />

                <InputError class="mt-2" :message="form.errors.priceNET" />
            </div>
            <div class="mt-4">
                <InputLabel for="created" value="Data wystawienia" />

                <TextInput
                    id="created"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.created"
                    required
                    autocomplete="created"
                />

                <InputError class="mt-2" :message="form.errors.priceNET" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </div>    
    </form>
</template>
