<template>
  <div class="col-span-full xl:col-span-6 bg-white shadow-lg rounded-sm border border-gray-200">
    <header class="px-5 py-4 border-b border-gray-100">
      <h2 class="font-semibold text-gray-800">Top Mambers</h2>
    </header>
    <div class="p-3">

      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="table-auto w-full">
          <!-- Table header -->
          <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
            <tr>
              <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">Name</div>
              </th>
              <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">Email</div>
              </th>
              <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">Spent</div>
              </th>
              <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-center">Phone</div>
              </th>
            </tr>
          </thead>
          <!-- Table body -->
          <tbody class="text-sm divide-y divide-gray-100">
            <tr
              v-for="customer in customers"
              :key="customer.id"
            >
              <td class="p-2 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                    <img class="rounded-full" :src="customer.image" width="40" height="40" :alt="customer.name" />
                  </div>
                  <div class="font-medium text-gray-800">{{customer.name}}</div>
                </div>
              </td>
              <td class="p-2 whitespace-nowrap">
                <div class="text-left">{{customer.email}}</div>
              </td>
              <td class="p-2 whitespace-nowrap">
                <div class="text-left font-medium text-green-500">{{customer.spent}}</div>
              </td>
              <td class="p-2 whitespace-nowrap">
                <div class="text-xs text-center">{{customer.phone}}</div>
              </td>
            </tr>
          </tbody>
        </table>

      </div>

    </div>
  </div>
</template>

<script>
import { ref } from 'vue'

import Image01 from '../../../../../img/user-36-05.jpg'
import Image02 from '../../../../../img/user-36-05.jpg'
import Image03 from '../../../../../img/user-36-07.jpg'
import Image04 from '../../../../../img/user-36-08.jpg'
import Image05 from '../../../../../img/user-36-09.jpg'

export default {
  name: 'DashboardCard10',
  setup() {
    const customers = ref([
      {
        id: '0',
        image: Image01,
        name: 'Alex Shatov',
        email: 'alexshatov@gmail.com',
        phone: '0790999876',
        spent: 'Ksh. 20,890.66',
      },
      {
        id: '1',
        image: Image02,
        name: 'Philip Harbach',
        email: 'philip.h@gmail.com',
        phone: '0787533227',
        spent: 'Ksh. 20,767.04',
      },
      {
        id: '2',
        image: Image03,
        name: 'Mirko Fisuk',
        email: 'mirkofisuk@gmail.com',
        phone: '0712543678',
        spent: 'Ksh. 20,996.00',
      },
      {
        id: '3',
        image: Image04,
        name: 'Olga Semklo',
        email: 'olga.s@cool.design',
        phone: '0757663556',
        spent: 'Ksh. 10,220.66',
      },
      {
        id: '4',
        image: Image05,
        name: 'Burak Long',
        email: 'longburak@gmail.com',
        phone: '0700534784',
        spent: 'Ksh. 10,890.66',
      },      
    ])

    return {
      customers,
    }    
  }
}
</script>