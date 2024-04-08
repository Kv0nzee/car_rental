<template>
<main>
    <CustomButton
        title="Add Cars"
        containerStyles="bg-gray-800 text-black text-white rounded-full mt-20 ml-5"
        @click="openModal"
  />
  <a-table :columns="columns" :data-source="dataSource" bordered class="mt-10">
    <template #bodyCell="{ column, text, record }">
      <template v-if="Object.keys(record).includes(column.dataIndex)">
        <div v-if="column.dataIndex === 'image'">
          <img :src="record[column.dataIndex]" alt="Car Image" style="width: 100px; height: auto;" />
        </div>
        <div v-else>
          <!-- brand -->
          <a-select 
          ref="select"
          v-if="editableData[record.id] && editableData[record.id][column.dataIndex] !== undefined && column.dataIndex === 'brand_name'"
          v-model:value="editableData[record.id][column.dataIndex]"
          style="width: 100%"
          @change="handleChange"
          >
          <a-select-option v-for="brand in allBrand" :value="brand.id" :key="brand.id">
              {{ brand.name }}
          </a-select-option>
          </a-select>

          <!-- Category -->
           <a-select 
          ref="select"
          v-if="editableData[record.id] && editableData[record.id][column.dataIndex] !== undefined && column.dataIndex === 'category_name'"
          v-model:value="editableData[record.id][column.dataIndex]"
          style="width: 100%"
          @change="handleChange"
          >
          <a-select-option v-for="cat in allCat" :value="cat.id" :key="cat.id">
              {{ cat.name }}
          </a-select-option>
          </a-select>

          <a-input
            v-if="editableData[record.id] && editableData[record.id][column.dataIndex] !== undefined && column.dataIndex !== 'brand_name' && column.dataIndex !== 'category_name'"
            v-model:value="editableData[record.id][column.dataIndex]"
            style="margin: -5px 0"
          />
          <template v-else>
            {{ text }}
          </template>
        </div>
      </template>
      <template v-else-if="column.dataIndex === 'operation'">
        <div class="editable-row-operations">
          <span v-if="editableData[record.id]">
            <a-typography-link @click="save(record.id)">Save</a-typography-link>
            <a-popconfirm title="Sure to cancel?" @confirm="cancel(record.id)">
              <a>Cancel</a>
            </a-popconfirm>
          </span>
          <span v-else>
            <a class=" text-emerald-600 hover:text-emerald-900" @click="edit(record)">Edit</a>
            <a-popconfirm
              v-if="dataSource.length"
              title="Sure to delete?"
              @confirm="onDelete(record.id)"
              class="ml-5 text-red-600 hover:text-red-900"
            >
              <a>Delete</a>
            </a-popconfirm>
          </span>
        </div>
      </template>
    </template>
  </a-table>
  <CreateCarModalVue :isOpen="isOpen" @closeModal="closeModal" :brands="allBrand" :categories="allCat"/>
</main>
</template>

<script setup>
import { cloneDeep } from 'lodash-es';
import { ref, onMounted, reactive } from 'vue';
import { message } from 'ant-design-vue';
import axios from 'axios';
import { generateCarImageUrl } from '../utils';;
import { useRoute } from 'vue-router';
import CustomButton from '../components/CustomButton.vue';
import CreateCarModalVue from '../components/modals/CreateCarModal.vue';

const columns = [
  { title: 'Image', dataIndex: 'image', width: '15%' },
  { title: 'Name', dataIndex: 'name', width: '10%' },
  { title: 'Brand Name', dataIndex: 'brand_name', width: '10%' },
  { title: 'Category', dataIndex: 'category_name', width: '20%' },
  { title: 'Year', dataIndex: 'year', width: '10%' },
  { title: 'City MPG', dataIndex: 'city_mpg', width: '5%' },
  { title: 'Highway MPG', dataIndex: 'highway_mpg', width: '5%' },
  { title: 'Com MPG', dataIndex: 'combination_mpg', width: '5%' },
  { title: 'Cylinders', dataIndex: 'cylinders', width: '5%' },
  { title: 'Displac', dataIndex: 'displacement', width: '5%' },
  { title: 'Drive', dataIndex: 'drive', width: '5%' },
  { title: 'Fuel Type', dataIndex: 'fuel_type', width: '5%' },
  { title: 'Operation', dataIndex: 'operation', scopedSlots: { customRender: 'operation' } },
];


const calculateTotalPrice = (record) => {
  return record.pricePerDay * record.days;
};

const dataSource = ref([]);
const editableData = reactive({});
const route = useRoute();
const allBrand = ref([]);
const allCat = ref([]);
const isOpen = ref(false);

onMounted(async () => {
  try {
    const userName = route.params.name;
    console.log(userName);

    const response = await axios.get(`http://127.0.0.1:8000/api/cars`);
    const allbrandsres = await axios.get(`http://127.0.0.1:8000/api/brands`);
    const allcategsres = await axios.get(`http://127.0.0.1:8000/api/categories`);
    allBrand.value = allbrandsres.data;
    allCat.value = allcategsres.data;
    response.data.forEach(item => {
      const paintIds = ["pspc0150", "pspc0028", "pspc0317", "pspc0076", "pspc0064", "pspc0109"];
      // Randomly select a paintId from the array
      const randomPaintId = paintIds[Math.floor(Math.random() * paintIds.length)];
      item.image = generateCarImageUrl({ brand_name: item.brand_name, name: item.name, year: item.year }, null, randomPaintId);
    });
    dataSource.value = response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
    message.error('Failed to fetch data.');
  }
});

 const openModal = () => {
      isOpen.value = true;
    };

    const closeModal = () => {
      isOpen.value = false;
    };
const edit = (record) => {
  editableData[record.id] = cloneDeep(record);
};

const save = async (key) => {
  try {
    const editedRecord = editableData[key];
    const response = await axios.put(`http://127.0.0.1:8000/api/cars/${editedRecord.id}/edit`, editedRecord);
    const updatedRecordIndex = dataSource.value.findIndex((item) => item.id === key);
    if (updatedRecordIndex !== -1) {
      Object.assign(dataSource.value[updatedRecordIndex], response.data.rental);
    }
    delete editableData[key];
    message.success('Record saved successfully.');
  } catch (error) {
    console.error('Error saving record:', error);
    message.error('Failed to save record.');
  }
};

const cancel = (key) => {
  delete editableData[key];
};

const onDelete = async (key) => {
  try {
    await axios.delete(`http://127.0.0.1:8000/api/cars/${key}`);
    dataSource.value = dataSource.value.filter(item => item.id !== key);
    message.success('Record deleted successfully.');
  } catch (error) {
    console.error('Error deleting record:', error);
    message.error('Failed to delete record.');
  }
};

const handleChange = (value) => {
      console.log(`selected ${value}`);
    };
</script>
