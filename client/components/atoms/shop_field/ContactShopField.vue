<template>
  <div>
    <MainText :level="2">
      店舗情報
    </MainText>

    <div class="u-light-grey-background">
      <v-container>
        <v-row justify="center">
          <v-col cols="12" class="d-flex justify-center">
            <ContactShopTable :shop="shop" />
          </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { Shop } from '@h37kouya/miyameshi-lib'

type Props = {
  shop: Shop
}

export default defineComponent({
  props: {
    shop: {
      type: Object,
      default: undefined
    }
  }
})
</script>
