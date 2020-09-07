<template>
  <table class="contact-table">
    <template v-for="(data, key) in tableData">
      <tr :key="key">
        <th class="table-heading text-center">
          {{ data.heading }}
        </th>
        <td class="table-value text-center">
          <template v-if="data.valueType === 'array'">
            <p v-for="(str, key) in data.value" :key="key" class="mb-0">
              {{ str }}
            </p>
          </template>

          <template v-else>
            <p class="mb-0">
              {{ data.value }}
            </p>
          </template>
        </td>
      </tr>
    </template>
  </table>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Shop } from '@/lib'
import { Shop as ShopJa } from '@/lang/ja/Shop'

type TableData = {
  heading: string,
  valueType?: 'array'
  value: string|number|string[]
}
const convertToTableData = (shop: Shop): TableData[] => {
  const tableData = [] as TableData[]

  if (shop.address) {
    const value = shop.buildingName ? `${shop.address}${shop.buildingName}` : shop.address
    tableData.push({
      heading: ShopJa.ADDRESS,
      value
    } as TableData)
  }

  if (shop.tel) {
    tableData.push({
      heading: ShopJa.TEL,
      value: shop.tel
    } as TableData)
  }

  if (shop.businessStartHour1 || shop.businessEndHour1 || shop.businessStartHour2 || shop.businessEndHour2) {
    if ((shop.businessStartHour1 || shop.businessEndHour1) && (shop.businessStartHour2 || shop.businessEndHour2)) {
      tableData.push({
        heading: ShopJa.BUSINESS_HOUR,
        valueType: 'array',
        value: [
          businessTimeToString(shop.businessStartHour1, shop.businessEndHour1, shop.businessLoHour1),
          businessTimeToString(shop.businessStartHour2, shop.businessEndHour2, shop.businessLoHour2)
        ]
      })
    } else if (shop.businessStartHour1 || shop.businessEndHour1) {
      tableData.push({
        heading: ShopJa.BUSINESS_HOUR,
        value: businessTimeToString(shop.businessStartHour1, shop.businessEndHour1, shop.businessLoHour1)
      })
    } else if (shop.businessStartHour2 || shop.businessEndHour2) {
      tableData.push({
        heading: ShopJa.BUSINESS_HOUR,
        value: businessTimeToString(shop.businessStartHour2, shop.businessEndHour2, shop.businessLoHour2)
      })
    }
  }

  if (shop.parkingLot) {
    tableData.push({
      heading: ShopJa.PARKING_LOT,
      value: shop.parkingLot
    })
  }

  if (shop.regularHoliday) {
    tableData.push({
      heading: ShopJa.REGULAR_HOLIDAY,
      value: shop.regularHoliday
    })
  }

  if (shop.seat) {
    tableData.push({
      heading: ShopJa.SEAT,
      value: shop.seat
    })
  }

  if (shop.priceRange) {
    tableData.push({
      heading: ShopJa.PRICE_RANGE,
      value: shop.priceRange
    })
  }

  return tableData
}

const businessTimeToString = (start?: string|Date, end?: string|Date, lo?: string|Date): string => {
  const base: string = start ? `${start}` : ''
  const plusEnd: string = end ? `${base} ~ ${end}` : base
  return lo ? `${plusEnd} (LO ${lo})` : plusEnd
}

type Props = {
  shop: Shop
}

export default defineComponent({
  props: {
    shop: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop
    })

    const tableData = computed(() => convertToTableData(state.shop))

    watch(() => props.shop, (newVal, _) => {
      state.shop = newVal
    })

    return {
      tableData,
      state
    }
  }
})
</script>

<style lang="scss" scoped>
.table-value {
  padding: 1rem 0.5rem;
  width: 220px;
  font-size: 0.9rem;
  border: {
    right: 1px #d2d2d2 solid;
    bottom: 1px #d2d2d2 solid;
  };
}

.table-heading {
  background-color: #fdf4d2;
  padding: 1rem 0.5rem;
  width: 80px;
  font-size: 0.9rem;
  border: {
    left: 1px #d2d2d2 solid;
    right: 1px #d2d2d2 solid;
    bottom: 1px #d2d2d2 solid;
  }
}

.contact-table {
  border-spacing: 0;

  tr:first-of-type {
    .table-heading {
      border-top: 1px #d2d2d2 solid;
    }

    .table-value {
      border-top: 1px #d2d2d2 solid;
    }
  }
}
</style>
