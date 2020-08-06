import { Middleware } from '@nuxt/types'

const guestMiddleware: Middleware = ({ redirect, store: { state } }) => {
  if (state.auth.uid) {
    return redirect('/admin')
  }
}

export default guestMiddleware
