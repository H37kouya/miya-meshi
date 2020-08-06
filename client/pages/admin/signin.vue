<template>
  <v-container>
    <h1>ログイン</h1>

    <v-form @submit.prevent="emailLogin">
      <v-text-field
        v-model="state.email"
        label="email"
      />
      <v-text-field
        v-model="state.password"
        label="password"
      />
      <v-btn type="submit" color="primary">
        ログイン
      </v-btn>
    </v-form>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext } from '@vue/composition-api'
import { ActionTypes } from '@/store/auth'

type State = {
  password: string,
  email: string
}

export default defineComponent({
  middleware: 'admin-guest',

  setup (props: any, context: SetupContext) {
    const state = reactive<State>({
      email: 'sample@example.com',
      password: 'Hello!'
    })

    const emailLogin = async () => {
      try {
        await context.root.$store.dispatch(
          `auth/${ActionTypes.EMAIL_LOGIN}`, { email: state.email, password: state.password }
        )

        return await context.root.$router.push('/admin')
      } catch (e) {
        console.error(e)
      }
    }

    return {
      state,
      emailLogin
    }
  }
})
</script>
