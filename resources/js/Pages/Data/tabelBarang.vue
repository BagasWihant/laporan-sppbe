<template>
    <div class="bg-primary-content overflow-x-auto shadow rounded-lg">
        <table class="table table-zebra table-xs">
            <!-- head -->
            <thead class="bg-slate-50 text-base">
                <tr>
                    <th><input type="checkbox" v-model="selectAllToggle" @change="selectAll" /></th>
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
                <tr v-for="(dt, index) in dataBarang.data" :key="dt.id">
                    <th><input type="checkbox" :value="dt.id" v-model="selected" @change="pilihSatu(dt)" /></th>
                    <th>{{ index + from }}</th>
                    <th>{{ dt.nama }}</th>
                    <th>{{ dt.satuan }}</th>
                    <th>{{ dt.stok }}</th>
                    <th>{{ vueNumberFormat(dt.harga, { prefix: 'Rp. ', precision: 0 }) }}</th>
                </tr>
            </tbody>
        </table>
        <div class="overflow-x-auto w-full bg-slate-50 p-2 m-0">
            <TailwindPagination :data="dataBarang" class="bg-primary-content" @pagination-change-page="loadBarang">
            </TailwindPagination>
        </div>
    </div>
</template>

<script setup>
import { TailwindPagination } from 'laravel-vue-pagination';
import { onMounted, ref } from 'vue';
const emit = defineEmits(['pilih'])

const dataBarang = ref([])
const searchQuery = ref("")
const selectAllToggle = ref(false);
const from = ref(0);
const selected = ref([]);
const selectedWithData = ref([]);
const props = defineProps({
    barang: Object,
    dataSelected: Array
})


onMounted(() => {
    loadBarang()
})

const pilihSatu = (data) => {
    selectedWithData.value.push([data.id, data.nama, data.stok, data.harga])
    // selectedWithData.value = {[data.id,data.nama,data.stok,data.harga]}
    emit('pilih', selectedWithData.value)
}

const selectAll = () => {
    const selectedNew = dataBarang.value.data.map(d => d.id)
    if (selectAllToggle.value) {        
        selected.value = [...selected.value, ...selectedNew]

        if (selectedWithData.value.length == 0){

            selectedWithData.value = dataBarang.value.data.map(d => [d.id, d.nama, d.stok, d.harga])
        }else {
            const dataNew = dataBarang.value.data.map(d => [d.id, d.nama, d.stok, d.harga])
            selectedWithData.value = [...selectedWithData.value,...dataNew]
        }

    } else {
        const NewArray = selected.value 
        const NewArrayData = selectedWithData.value 
        selected.value = NewArray.filter(item =>!selectedNew.includes(item))
        
        selectedWithData.value= NewArrayData.filter(itm =>!selectedNew.includes(itm[0]))
    }
    emit('pilih', selectedWithData.value)
}


const loadBarang = async (page = 1) => {
    selectAllToggle.value = false
    if (searchQuery.value !== '') return await axios.post(route('barangSearch'), { page: page, key: searchQuery.value })
        .then(res => {
            dataBarang.value = res.data
            from.value = res.data.from
        })
    else return await axios.get(route('barangShow', 'page') + page)
        .then((res) => {
            dataBarang.value = res.data
            from.value = res.data.from
        })
}

</script>
