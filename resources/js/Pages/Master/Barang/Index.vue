<template>
    <Base>
    <DataTable :value="dataBarang" lazy paginator :first="first" :rows="10" v-model:filters="filters" ref="dt"
        dataKey="id" :totalRecords="totalRecords" :loading="loading" @page="onPage($event)" @sort="onSort($event)"
        @filter="onFilter($event)" filterDisplay="row" :globalFilterFields="['nama', 'stok', 'satuan']"
        v-model:selection="selectedBarang" :selectAll="selectAll" @select-all-change="onSelectAllChange"
        @row-select="onRowSelect" @row-unselect="onRowUnselect" tableStyle="min-width: 75rem">
        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>

        <Column field="nama" header="Nama" filterMatchMode="startsWith" sortable>
            <template #filter="{ filterModel, filterCallback }">
                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
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
    'nama': { value: '', matchMode: 'contains' },
    'satuan': { value: '', matchMode: 'contains' },
    'stok': { value: '', matchMode: 'contains' },
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
        rows: 10,
        sortField: null,
        sortOrder: null,
        filters: filters.value
    };
    loadLazyData();
});


const loadLazyData = (event) => {
    console.log('aaaa');
    loading.value = true;
    lazyParams.value = { ...lazyParams.value, first: event?.first || first.value };

    // CustomerService.getCustomers({ lazyEvent: JSON.stringify(lazyParams.value) }).then((data) => {
    //     //     customers.value = data.customers;
    //     totalRecords.value = data.totalRecords;
    //     console.log(data);
    // });
    axios.get(route('barang.showAll'), { params: lazyParams.value })
    .then((res) => {
        loading.value = false;
        console.log(res.data.data);
        dataBarang.value = res.data.data.data
            totalRecords.value = res.data.data.total;
            // from.value = res.data.from

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
    selectAll.value = selectedCustomers.value.length === totalRecords.value;
};
const onRowUnselect = () => {
    selectAll.value = false;
};

const onSelectAllChange = (event) => {
    selectAll.value = event.checked;

    if (selectAll) {
        // CustomerService.getCustomers().then(data => {
        //     selectAll.value = true;
        //     selectedCustomers.value = data.customers;
        // });
    }
    else {
        selectAll.value = false;
        selectedCustomers.value = [];
    }
};


</script>
