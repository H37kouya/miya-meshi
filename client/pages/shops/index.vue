<template>
  <div>
    <DefaultMainText>
      お店から探す
    </DefaultMainText>

    <SearchButtonGroup />

    <DefaultShopList :shops="state.shops" />
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { getShopList } from '@/src/infra/firestore/Shop'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      shops: [] as Shop[]
    })

    onMounted(async () => {
      state.shops = await getShopList(context.root.$fireStore)
    })

    return {
      state
    }
  }
})
</script>
