<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        エリアと住所を紐づける
      </AdminMainText>

      <v-btn to="/admin/area" color="success">
        エリア一覧
      </v-btn>
    </v-row>

    <div class="mt-4">
      <v-row justify="space-between">
        <div>
          <v-btn-toggle>
            <v-btn v-for="(hira, key) in hiragana" :key="`hiragana-${key}`" @click="selectHiragana(hira.arg)">
              {{ hira.name }}
            </v-btn>
          </v-btn-toggle>
        </div>

        <div>
          <v-btn color="primary" x-large @click="complete">
            編集完了
          </v-btn>
        </div>
      </v-row>
    </div>

    <v-row class="mt-4">
      <v-col v-for="(address, key) in addresses" :key="key" cols="3">
        <p class="mb-0">
          <ruby>
            <rb>{{ address.obj.name }}</rb>
            <rp>（</rp>
            <rt>{{ address.obj.yomi }}</rt>
            <rp>）</rp>
          </ruby>
        </p>
        <v-select :items="select" :value="address.area.id" @input="pushArea($event, address.obj.name)" />
      </v-col>
    </v-row>

    <div class="d-flex justify-end">
      <v-btn color="primary" x-large @click="complete">
        編集完了
      </v-btn>
    </div>
  </v-container>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import AddressJson from '@/assets/json/Utsunomiya-tiku.json'
import { Area } from 'miyameshi-lib'
import { editArea, getAreaList } from 'miyameshi-lib/src/infra/firestore/Area'

const addressForView = (areas: Area[], hira: string[]) => {
  const array = AddressJson.data

  const filterArray = array.filter((obj: any) => hira.includes(obj.yomi.slice(0, 1)))

  return filterArray.map((obj) => {
    for (const area of areas) {
      if (area.addresses.includes(obj.name)) {
        return {
          area,
          obj
        }
      }
    }

    return {
      area: {} as Area,
      obj
    }
  })
}

const hiraganaObj = [
  {
    name: 'あ行',
    arg: ['あ', 'い', 'う', 'え', 'お']
  },
  {
    name: 'か行',
    arg: ['か', 'が', 'き', 'ぎ', 'く', 'ぐ', 'け', 'げ', 'こ', 'ご']
  },
  {
    name: 'さ行',
    arg: ['さ', 'ざ', 'し', 'じ', 'す', 'ず', 'せ', 'ぜ', 'そ', 'ぞ']
  },
  {
    name: 'た行',
    arg: ['た', 'だ', 'ち', 'ぢ', 'つ', 'づ', 'て', 'で', 'と', 'ど']
  },
  {
    name: 'な行',
    arg: ['な', 'に', 'ぬ', 'ね', 'の']
  },
  {
    name: 'は行',
    arg: ['は', 'ば', 'ぱ', 'ひ', 'び', 'ぴ', 'ふ', 'ぶ', 'ぷ', 'へ', 'べ', 'ぺ', 'ほ', 'ぼ', 'ぽ']
  },
  {
    name: 'ま行',
    arg: ['ま', 'み', 'む', 'め', 'も']
  },
  {
    name: 'や行',
    arg: ['や', 'ゆ', 'よ']
  },
  {
    name: 'ら行',
    arg: ['ら', 'り', 'る', 'れ', 'ろ']
  },
  {
    name: 'わ行',
    arg: ['わ', 'を']
  }
] as { name: string, arg: string[] }[]

export default defineComponent({
  middleware: 'admin-auth',



  setup (_, context: SetupContext) {
    const state = reactive({
      areas: [] as Area[],
      hira: ['あ', 'い', 'う', 'え', 'お'] as string[]
    })

    watchEffect(async () => {
      state.areas = await getAreaList(context.root.$fireStore)
    })

    const addresses = computed(() => addressForView(state.areas, state.hira))

    const select = computed(() => state.areas.map((area: Area) => ({
      value: area.id,
      text: area.name
    })))

    const pushArea = (event: string, name: string) => {
      for (const beforeArea of state.areas) {
        if (beforeArea.addresses.includes(name)) {
          beforeArea.addresses = beforeArea.addresses.filter((addressName: string) => addressName !== name)
          break
        }
      }
      const area = state.areas.find((area: Area) => area.id === event)
      area && area.addresses.push(name)
    }

    const selectHiragana = (arg: string[]) => state.hira = arg

    const hiragana = hiraganaObj

    const complete = async () => {
      const promise = []
      for (const area of state.areas) {
        promise.push(editArea(context.root.$fireStore, context.root.$fireStoreObj, area, area.id))
      }
      await Promise.all(promise)

      return await context.root.$router.push('/admin/area')
    }

    return {
      addresses,
      complete,
      pushArea,
      hiragana,
      select,
      selectHiragana,
      state
    }
  }
})
</script>
