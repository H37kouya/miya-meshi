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
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { PhoneNumber } from '@/src/types/PhoneNumber'
import { formatTel, isPhoneNumber } from '@/src/utils/PhoneNumber'

type Props = {
  tel?: number|string|PhoneNumber
}

export default defineComponent({
  props: {
    tel: {
      type: [Number, String],
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const telLink = computed(() => {
      if (!props.tel || isPhoneNumber(props.tel)) {
        return props.tel
      }

      return formatTel(props.tel)
    })

    const href = computed(() => {
      if (!telLink) {
        return undefined
      }

      return `tel:${telLink}`
    })

    return {
      href
    }
  }
})
</script>
