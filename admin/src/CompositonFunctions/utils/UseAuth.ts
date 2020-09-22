import { SetupContext } from '@vue/composition-api'

export const useAuth = ({ $fireAuth, $router }: SetupContext['root']) => {
  const logout = async () => {
    try {
      await $fireAuth.signOut()

      return await $router.push('/signin')
    } catch (e) {
      console.error(e)
    }
  }

  return {
    logout
  }
}
