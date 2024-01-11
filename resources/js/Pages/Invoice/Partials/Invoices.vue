<script setup>
import { router } from '@inertiajs/vue3';
 



const props = defineProps({
    invoices: Object,
    onItemEdit: {
        type: Function
    }
});

const editItem = (item) => {
  const invoice = { ...item};
  props.onItemEdit(invoice);
};

const deleteItem = (item, index) => {

    router.delete(route('invoice.delete'), {
      data: {id: item.id},
    });

};

const getDateFormat = (dateString) => {
  let d = new Date(dateString),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
</script>



<template>
    <div class="">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Nr faktury</th>
            <th scope="col" class="px-6 py-3">NIP kupującego</th>
            <th scope="col" class="px-6 py-3">NIP sprzedającego</th>
            <th scope="col" class="px-6 py-3">Nazwa produktu</th>
            <th scope="col" class="px-6 py-3">Kwota Netto</th>
            <th scope="col" class="px-6 py-3">Data wystawienia</th>
            <th scope="col" class="px-6 py-3">Data edycji</th>
            <th scope="col" class="px-6 py-3">Funkcje</th>
            <!-- Add more headers as needed -->
          </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in invoices" :key="item.id">
                <td class="px-6 py-4">{{ item.number }}</td>
                <td class="px-6 py-4">{{ item.taxIdBuyer }}</td>
                <td class="px-6 py-4">{{ item.taxIdSeller }}</td>
                <td class="px-6 py-4">{{ item.productName }}</td>
                <td class="px-6 py-4">{{ (parseInt(item.priceNET) / 100).toFixed(2) }}</td>
                <td class="px-6 py-4">{{ getDateFormat(item.created) }}</td>
                <td class="px-6 py-4">{{ item.updated_at }}</td>
                <td class="px-6 py-4">
                  <button @click="editItem(item)">Edytuj</button>
                  <button @click="deleteItem(item, index)">Usuń</button>
                </td>
            </tr>
        </tbody>
      </table>
    </div>
  </template>

