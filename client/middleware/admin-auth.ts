import { Middleware } from '@nuxt/types'

const authMiddleware: Middleware = ({ redirect, store: { state } }) => {
  if (!state.auth.uid) {
    return redirect('/admin/signin')
  }
}

export default authMiddleware
