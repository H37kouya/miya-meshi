import { Middleware } from '@nuxt/types'
import { MutationTypes } from '~/store/auth'

const adminMiddleware: Middleware = ({ $fireAuth, store }) => {
  // firebaseで認証情報を取得
  $fireAuth.onAuthStateChanged((user) => {
    if (user) {
      store.commit(`auth/${MutationTypes.SET_USER}`, user)
    }
  })
}

export default adminMiddleware
