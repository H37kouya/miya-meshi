<template>
  <v-container class="max-width-480 mb-16">
    <AdminMainText>
      ログイン
    </AdminMainText>

    <v-row justify="center">
      <v-col cols="12">
        <v-card width="480px">
          <v-card-subtitle v-if="state.errorMessage" class="red--text">
            {{ state.errorMessage }}
          </v-card-subtitle>
          <v-card-text>
            <v-form @submit.prevent="emailLogin">
              <v-text-field
                v-model="state.email"
                label="メールアドレス"
              />

              <PasswordTextField
                v-model="state.password"
              />

              <div class="d-flex justify-end">
                <v-btn type="submit" color="primary">
                  ログイン
                </v-btn>
              </div>
            </v-form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext } from '@vue/composition-api'
import { MetaInfo } from 'vue-meta'

type State = {
  password: string,
  email: string,
  errorMessage?: string
}

export default defineComponent({
  middleware: 'admin-guest',

  setup (_: unknown, context: SetupContext) {
    const state = reactive<State>({
      email: '',
      password: '',
      errorMessage: undefined
    })

    const emailLogin = async () => {
      state.errorMessage = undefined
      try {
        await context.root.$fireAuth.signInWithEmailAndPassword(state.email, state.password)

        return await context.root.$router.push('/admin')
      } catch (e) {
        state.errorMessage = e.message
        console.error(e)
      }
    }

    return {
      state,
      emailLogin
    }
  },

  head: (): MetaInfo => ({
    title: 'ログイン',
    meta: [
      { property: 'og:type', content: 'article' }
    ]
  })
})
</script>
