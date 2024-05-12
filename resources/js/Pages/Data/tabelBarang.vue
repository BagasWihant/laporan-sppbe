<template>
    <div class="bg-primary-content overflow-x-auto shadow rounded-lg">
        <table class="table table-zebra ">
            <!-- head -->
            <thead class="bg-slate-50 text-base">
                <tr>
                    <th><input type="checkbox" v-model="selectingAll" @change="selectAll" /></th>
                    <th>No</th>
                    <th>Name</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <!-- {{ barang.data }} -->
                <!-- row 1 -->
                <tr v-for="(dt, index) in barang.data" :key="dt.id">
                    <th><input type="checkbox" @change="toggleSelect(dt)" :checked="selectingAll" /></th>
                    <th>{{ index + nomor }}</th>
                    <th>{{ dt.nama }}</th>
                    <th>{{ dt.satuan }}</th>
                    <th>{{ dt.stok }}</th>
                    <th>{{ vueNumberFormat(dt.harga, { prefix: 'Rp. ', precision: 0 }) }}</th>
                    
                </tr>
            </tbody>
        </table>
        <slot />
    </div>
</template>

<script setup>
import { ref } from 'vue';

const selectingAll = ref(false);
const selected = ref([]);
const props = defineProps({
    barang: Object,
    nomor: Number
})
const toggleSelect = (data) => {
    const ind = selected.value.indexOf(data.id)
    if (ind === -1) {
        selected.value.push(data.id)
    } else {
        selected.value.splice(ind, 1)
    }
}
const selectAll = () => {
    if (selectingAll.value) selected.value = props.barang.data.map(barang => barang.id)
    else selected.value = []
}

</script>
