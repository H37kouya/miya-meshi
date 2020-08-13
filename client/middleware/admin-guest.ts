import { Middleware } from '@nuxt/types'

const adminMiddleware: Middleware = ({ redirect, $fireAuth }) => {
  // firebaseで認証情報を取得
  $fireAuth.onAuthStateChanged((user) => {
    if (user) {
      return redirect('/admin')
    }
  })
}

export default adminMiddleware
