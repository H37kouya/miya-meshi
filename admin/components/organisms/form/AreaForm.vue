<template>
  <v-container>
    <v-form @submit.prevent="onSubmit">
      <v-row>
        <v-col cols="12" sm="8">
          <v-card outlined>
            <v-card-text>
              <AreaNameTextField
                v-model="state.area.name"
              />

              <div class="d-flex justify-end">
                <v-btn type="submit" color="primary" large>
                  追加
                </v-btn>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-form>
    <v-form @submit.prevent="onSubmit">
      <v-row>
        <v-col cols="12" sm="8">
          <v-card outlined>
            <v-card-text>
              <AddressNameTextField
                :addresses="state.area.addresses"
              />
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-form>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Area } from '@/lib'

type Props = {
  area?: Area
}

export default defineComponent({
  props: {
    area: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      area: {
        name: '' as Area['name'],
        addresses: [] as Area['addresses']
      }
    })

    watch(() => props.area, (newVal, _) => {
      state.area.name = newVal ? newVal.name : state.area.name
      state.area.addresses = newVal ? newVal.addresses : state.area.addresses
    })

    const onSubmit = () => context.emit('submit', state.area)

    return {
      state,
      onSubmit
    }
  }
})
</script>
