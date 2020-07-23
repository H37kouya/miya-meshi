import { NextPage } from 'next'
import { createShop } from '@/src/utils/firebase/Shop'
import { useUser } from '@/src/utils/firebase/UseUser'

const Index: NextPage = () => {
  const { user, logout } = useUser()

  const items = []
  for (const v in user) {
      items.push(
          <div>
              <p className="item">{v}: {user[v]}</p>
          </div>
      )
  }

  return (
    <div>
      <h1>Shop Page</h1>

        <p>{user ? user.email : 'なし'}</p>
        {user && items}

      <button onClick={createShop}>
        CreateShop
      </button>
    </div>
  )
}

export default Index