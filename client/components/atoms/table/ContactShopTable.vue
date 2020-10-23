<template>
  <table class="contact-table">
    <template v-for="(data, key) in tableData">
      <tr :key="`table-${key}`">
        <th class="table-heading text-center">
          {{ data.heading }}
        </th>
        <td class="table-value text-center text-md-left pl-md-4">
          <template v-if="data.valueType === 'array'">
            <p v-for="(str, lkey) in data.value" :key="`array-${lkey}`" class="mb-0">
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
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@nuxtjs/composition-api'
import { Shop } from '@/lib'
import { Shop as ShopJa } from '@/lang/ja/Shop'

type TableData = {
  heading: string,
  valueType?: 'array'
  value: string|number|string[]
}
const convertToTableData = (shop: Shop): TableData[] => {
  const tableData = [] as TableData[]

  if (shop.nameKana) {
    tableData.push({
      heading: '店舗よみ',
      value: shop.nameKana
    } as TableData)
  }

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

  if (shop.access) {
    tableData.push({
      heading: '交通アクセス',
      value: shop.access
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

  if (shop.canReservation === true || shop.canReservation === false) {
    tableData.push({
      heading: '予約可否',
      value: shop.canReservation ? '予約可能' : '予約不可能'
    })
  }

  if (shop.reservervationMaxNumber) {
    tableData.push({
      heading: '予約最大人数',
      value: `${shop.reservervationMaxNumber}人`
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

  if (shop.creditCard) {
    tableData.push({
      heading: 'クレジットカード',
      value: shop.creditCard
    })
  }

  if (shop.aboutSmoking) {
    tableData.push({
      heading: '禁煙・喫煙',
      value: shop.aboutSmoking
    })
  }

  if (shop.electronicMoney) {
    tableData.push({
      heading: '電子マネー',
      value: shop.electronicMoney
    })
  }

  if (shop.totalNumberOfSeats) {
    tableData.push({
      heading: '総席数',
      value: shop.totalNumberOfSeats
    })
  }

  if (shop.privateRoom) {
    tableData.push({
      heading: '個室',
      value: shop.privateRoom
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

    watchEffect(() => {
      state.shop = props.shop
    })

    return {
      tableData,
      state
    }
  }
})
</script>

<style lang="scss" scoped>
$border-color: $dark-gray;

.table-value {
  padding: 1rem 0.5rem;
  width: 220px;
  font-size: 0.9rem;
  border: {
    right: 1px $border-color solid;
    bottom: 1px $border-color solid;
  };

  @include mq(md) {
    width: auto;
  }
}

.table-heading {
  background-color: #fdf4d2;
  padding: 1rem 0.5rem;
  width: 80px;
  font-size: 0.9rem;
  border: {
    left: 1px $border-color solid;
    right: 1px $border-color solid;
    bottom: 1px $border-color solid;
  }

  @include mq(md) {
    width: 120px;
  }
}

.contact-table {
  border-spacing: 0;

  @include mq(md) {
    width: 100%;
  }

  tr:first-of-type {
    .table-heading {
      border-top: 1px $border-color solid;
    }

    .table-value {
      border-top: 1px $border-color solid;
    }
  }
}
</style>
