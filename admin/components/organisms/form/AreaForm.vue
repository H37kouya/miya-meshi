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

    <v-row>
      <v-col cols="12" sm="8">
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">住所</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(address, index) in state.area.addresses" :key="index">
                <td>{{ address }}</td>
                <td @click="onDelete(address)">
                  <span class="delete-text">削除</span>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-col>
    </v-row>
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

    const onDelete = (address: string) => context.emit('delete', address)

    return {
      state,
      onDelete,
      onSubmit
    }
  }
})
</script>

<style lang="scss" scoped>
.delete-text {
  caret-color: #f44336;
  color: #f44336;

  &:hover {
    opacity: 0.7;
  }
}
</style>
