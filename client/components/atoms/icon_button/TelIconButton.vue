<template>
  <v-btn
    v-if="$device.isMobile"
    v-bind="$attrs"
    :href="href"
    color="#329f17"
    fab
  >
    <v-icon color="white" large>
      mdi-phone-in-talk-outline
    </v-icon>
  </v-btn>
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { isSimplePhoneNumber } from '@/src/utils/PhoneNumber'

type Props = {
  tel?: number|string
}

export default defineComponent({
  props: {
    tel: {
      type: [Number, String],
      default: undefined
    }
  },

  setup (props: Props, _: SetupContext) {
    const href = computed(() => {
      if (!props.tel) {
        return undefined
      }

      return `tel:${props.tel}`
    })

    return {
      href
    }
  }
})
</script>
