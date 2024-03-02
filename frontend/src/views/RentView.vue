<template>
  <a-table :columns="columns" :data-source="dataSource" bordered class="mt-20">
    <template #bodyCell="{ column, text, record }">
      <template v-if="['days', 'image'].includes(column.dataIndex)">
        <div v-if="column.dataIndex === 'image'">
          <img :src="record[column.dataIndex]" alt="Car Image" style="width: 100px; height: auto;" />
        </div>
        <div v-else-if="column.dataIndex === 'total_price'">
          {{ calculateTotalPrice(record) }}
        </div>
        <div v-else>
          <a-input
            v-if="editableData[record.id] && editableData[record.id][column.dataIndex] !== undefined"
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
            <a @click="edit(record)">Edit</a>
            <a-popconfirm
              v-if="dataSource.length"
              title="Sure to delete?"
              @confirm="onDelete(record.id)"
              class="ml-5"
            >
              <a>Delete</a>
            </a-popconfirm>
          </span>
        </div>
      </template>
    </template>
  </a-table>
</template>

<script setup>
import { cloneDeep } from 'lodash-es';
import { ref, onMounted, reactive } from 'vue';
import { message } from 'ant-design-vue';
import axios from 'axios';
import { generateCarImageUrl } from '../utils';;
import { useRoute } from 'vue-router';

const columns = [
  { title: 'Image', dataIndex: 'image', width: '15%' },
  { title: 'User Name', dataIndex: 'user_name', width: '20%' },
  { title: 'Car Name', dataIndex: 'car_name', width: '20%' },
  { title: 'Days', dataIndex: 'days', width: '10%' },
  { title: 'Total Price', dataIndex: 'total_price', width: '15%' },
  { title: 'Operation', dataIndex: 'operation', scopedSlots: { customRender: 'operation' } },
];

const calculateTotalPrice = (record) => {
  return record.pricePerDay * record.days;
};

const dataSource = ref([]);
const editableData = reactive({});
const route = useRoute();

onMounted(async () => {
  try {
    const userName = route.params.name;
    console.log(userName);

    const response = await axios.get(`http://127.0.0.1:8000/api/rent?user=${userName}`);
    response.data.forEach(item => {
      item.image = generateCarImageUrl({ brand_name: item.brand_name, name: item.car_name, year: item.year });
    });
    dataSource.value = response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
    message.error('Failed to fetch data.');
  }
});

const edit = (record) => {
  editableData[record.id] = cloneDeep(record);
};

const save = async (key) => {
  try {
    const editedRecord = editableData[key];
    editedRecord.total_price = calculateTotalPrice(editedRecord);
    const response = await axios.put(`http://127.0.0.1:8000/api/rent/${key}`, editedRecord);
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
    await axios.delete(`http://127.0.0.1:8000/api/rent/${key}`);
    dataSource.value = dataSource.value.filter(item => item.id !== key);
    message.success('Record deleted successfully.');
  } catch (error) {
    console.error('Error deleting record:', error);
    message.error('Failed to delete record.');
  }
};
</script>
