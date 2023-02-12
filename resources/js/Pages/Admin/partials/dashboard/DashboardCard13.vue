<template>
  <div class="col-span-full xl:col-span-6 bg-white shadow-lg rounded-sm border border-gray-200">
    <header class="px-5 py-4 border-b border-gray-100">
      <h2 class="font-semibold text-gray-800">Recent Transactions</h2>
    </header>
    <div class="p-3">

      <!-- Card content -->
      <!-- "Today" group -->
      <div>
        <header class="text-xs uppercase text-gray-400 bg-gray-50 rounded-sm font-semibold p-2">Today</header>
        <ul class="my-1">
          <!-- Item -->
          <li class="flex px-2">
            <div class="w-9 h-9 rounded-full shrink-0 bg-red-500 my-2 mr-3">
              <svg class="w-9 h-9 fill-current text-red-50" viewBox="0 0 36 36">
                <path d="M17.7 24.7l1.4-1.4-4.3-4.3H25v-2H14.8l4.3-4.3-1.4-1.4L11 18z" />
              </svg>
            </div>
            <div class="grow flex items-center border-b border-gray-100 text-sm py-2">
              <div class="grow flex justify-between">
                <div class="self-center">Loan Disbursement to Lovan Solomon</div>
                <div class="shrink-0 self-start ml-2">
                  <span class="font-medium text-gray-800">- Ksh. 490, 000.00</span>
                </div>
              </div>
            </div>
          </li>
          <!-- Item -->
          <li class="flex px-2">
            <div class="w-9 h-9 rounded-full shrink-0 bg-green-500 my-2 mr-3">
              <svg class="w-9 h-9 fill-current text-green-50" viewBox="0 0 36 36">
                <path d="M18.3 11.3l-1.4 1.4 4.3 4.3H11v2h10.2l-4.3 4.3 1.4 1.4L25 18z" />
              </svg>
            </div>
            <div class="grow flex items-center border-b border-gray-100 text-sm py-2">
              <div class="grow flex justify-between">
                <div class="self-center">Loan Repayment to account <span class="text-blue-500 font-bold">0eT5x-8fXXX</span></div>
                <div class="shrink-0 self-start ml-2">
                  <span class="font-medium text-green-500">+ Ksh. 5,980.00</span>
                </div>
              </div>
            </div>
          </li>
          <!-- Item -->
          <li class="flex px-2">
            <div class="w-9 h-9 rounded-full shrink-0 bg-green-500 my-2 mr-3">
              <svg class="w-9 h-9 fill-current text-green-50" viewBox="0 0 36 36">
                <path d="M18.3 11.3l-1.4 1.4 4.3 4.3H11v2h10.2l-4.3 4.3 1.4 1.4L25 18z" />
              </svg>
            </div>
            <div class="grow flex items-center border-b border-gray-100 text-sm py-2">
              <div class="grow flex justify-between">
                <div class="self-center">Loan Repayment to account <span class="text-blue-500 font-bold">0fr46-6eXXX</span></div>
                <div class="shrink-0 self-start ml-2">
                  <span class="font-medium text-green-500">+ Ksh. 3,980.00</span>
                </div>
              </div>
            </div>
          </li>
          <!-- Item -->
          <li class="flex px-2">
            <div class="w-9 h-9 rounded-full shrink-0 bg-green-500 my-2 mr-3">
              <svg class="w-9 h-9 fill-current text-green-50" viewBox="0 0 36 36">
                <path d="M18.3 11.3l-1.4 1.4 4.3 4.3H11v2h10.2l-4.3 4.3 1.4 1.4L25 18z" />
              </svg>
            </div>
            <div class="grow flex items-center border-b border-gray-100 text-sm py-2">
              <div class="grow flex justify-between">
                <div class="self-center">Deposit from Mark Ongolo to account <span class="text-blue-500 font-bold">0x4g-7uyXXX</span></div>
                <div class="shrink-0 self-start ml-2">
                  <span class="font-medium text-green-500">+ Ksh. 1,200.00</span>
                </div>
              </div>
            </div>
          </li>
          <!-- Item -->
          <li class="flex px-2">
            <div class="w-9 h-9 rounded-full shrink-0 bg-gray-200 my-2 mr-3">
              <svg class="w-9 h-9 fill-current text-gray-400" viewBox="0 0 36 36">
                <path d="M21.477 22.89l-8.368-8.367a6 6 0 008.367 8.367zm1.414-1.413a6 6 0 00-8.367-8.367l8.367 8.367zM18 26a8 8 0 110-16 8 8 0 010 16z" />
              </svg>
            </div>
            <div class="grow flex items-center border-b border-gray-100 text-sm py-2">
              <div class="grow flex justify-between">
                <div class="self-center">Cancelled Transaction for account <span class="text-blue-500 font-bold">eR67-54eXXX</span></div>
                <div class="shrink-0 self-start ml-2">
                  <span class="font-medium text-gray-800 line-through">+ Ksh. 10,099.00</span>
                </div>
              </div>
            </div>
          </li>
          <!-- Item -->
          <li class="flex px-2">
            <div class="w-9 h-9 rounded-full shrink-0 bg-red-500 my-2 mr-3">
              <svg class="w-9 h-9 fill-current text-red-50" viewBox="0 0 36 36">
                <path d="M17.7 24.7l1.4-1.4-4.3-4.3H25v-2H14.8l4.3-4.3-1.4-1.4L11 18z" />
              </svg>
            </div>
            <div class="grow flex items-center text-sm py-2">
              <div class="grow flex justify-between">
                <div class="self-center">Loan Disbursement to Kalai Manala</div>
                <div class="shrink-0 self-start ml-2">
                  <span class="font-medium text-gray-800">- Ksh. 100,000.00</span>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: 'DashboardCard13',
}
</script>