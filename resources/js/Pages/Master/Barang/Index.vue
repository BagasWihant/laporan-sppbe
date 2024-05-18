<template>
    <Base>
    <Button label="Check" icon="pi pi-plus" class="p-button-success mr-2" @click="cekSelected()" />
    <DataTable :value="dataBarang" lazy paginator :first="first" :rows="20" :rowsPerPageOptions="[5, 10, 20, 50]"
        v-model:filters="filters" ref="dt" dataKey="id" :totalRecords="totalRecords" :loading="loading"
        @page="onPage($event)" @sort="onSort($event)" @filter="onFilter($event)" filterDisplay="row"
        :globalFilterFields="['nama', 'stok', 'satuan']" v-model:selection="selectedBarang" :selectAll="selectAll"
        @select-all-change="onSelectAllChange" @row-select="onRowSelect" @row-unselect="onRowUnselect"
        tableStyle="min-width: 75rem">
        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>

        <Column field="nama" header="Nama" filterMatchMode="startsWith" sortable>
            <template #filter="{ filterModel, filterCallback }">
                <InputText type="text" v-model="filterModel.value" @keydown.self="searchDebounce(filterCallback)"
                    class="p-column-filter" placeholder="Search" />
            </template>
        </Column>

        <Column field="stok" header="Stok" filterMatchMode="contains" sortable />
        <Column field="satuan" header="Satuan" filterMatchMode="contains" sortable />

    </DataTable>
    </Base>
</template>

<script setup>
import Base from '@/Layouts/Base.vue';
import debounce from 'lodash.debounce';
import Button from 'primevue/button';
import Column from 'primevue/column';
import DataTable from 'primevue/datatable';
import InputText from 'primevue/inputtext';
import { onMounted, ref } from 'vue';


const dt = ref();
const loading = ref(false);
const totalRecords = ref(0);
const dataBarang = ref();
const selectedBarang = ref();
const selectAll = ref(false);
const first = ref(0);
const filters = ref({
    'nama': { value: '', matchMode: 'contains' }
});
const lazyParams = ref({});
const columns = ref([
    { field: 'nama', header: 'Name' },
    { field: 'stok', header: 'Stok' },
    { field: 'stuan', header: 'Satuan' },
]);

onMounted(() => {
    loading.value = true;
    lazyParams.value = {
        first: 0,
        rows: 20,
        sortField: null,
        sortOrder: null,
        filters: filters.value
    };
    loadLazyData();
});

const searchDebounce = debounce((bypassFunction) => {
    bypassFunction()
}, 1200)


const loadLazyData = (event) => {
    loading.value = true;
    lazyParams.value = { ...lazyParams.value, first: event?.first || first.value };

    axios.get(route('barang.showAll'), { params: lazyParams.value })
        .then((res) => {
            console.log(res.data.data);
            loading.value = false
            dataBarang.value = res.data.data
            totalRecords.value = res.data.totalRecords;
        })
};

const onPage = (event) => {
    lazyParams.value = event;
    loadLazyData(event);
};
const onSort = (event) => {
    lazyParams.value = event;
    loadLazyData(event);
};
const onFilter = (event) => {
    lazyParams.value.filters = filters.value;
    loadLazyData(event);
};

const onRowSelect = () => {
    selectAll.value = selectedBarang.value.length === totalRecords.value;
};
const onRowUnselect = () => {
    selectAll.value = false;
};

const cekSelected = () => {
    console.log(selectedBarang.value.map(x => x.id));
}
const onSelectAllChange = (event) => {
    selectAll.value = event.checked;

    if (selectAll) {
        axios.get(route('barang.showAll'))
            .then((res) => {
                loading.value = false
                selectAll.value = true;
                selectedBarang.value = res.data.data
            })
    }
    else {
        selectAll.value = false;
        selectedCustomers.value = [];
    }
};


</script>
